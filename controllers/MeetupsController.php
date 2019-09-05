<?php


namespace app\controllers;

use app\components\Util;
use app\models\databaseModels\Meetup;
use app\models\databaseModels\Vote;
use app\models\forms\CreateMeetupForm;
use app\models\User;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\db\StaleObjectException;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class MeetupsController extends _MainController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundHttpException('Page not found.');
        }
        $meetup = Meetup::findOne(['id' => $id]);
        if (is_null($meetup)) {
            throw new NotFoundHttpException('Meetup not found');
        }

        $votes = $meetup->votes;
        if (count($votes) > 0) {
            $voteValues = [];
            foreach ($votes as $vote) {
                $voteValues[] = $vote->value;
            }
            $rating = Util::rateAverage(...$voteValues);
        } else {
            $rating = null;
        }

        /** @var User $user */
        $user = Yii::$app->user->identity;

        $userVote = Vote::findOne([
            'meetup_id' => $meetup->id,
            'voter_id' => $user->id,
        ]);

        return $this->render('view', [
            'meetup' => $meetup,
            'rating' => $rating,
            'vote' => $userVote,
        ]);
    }

    public function actionRated()
    {
        /** @var User $user */
        $user = Yii::$app->user->identity;

        $ratedMeetupsVotes = Vote::find()
            ->select("meetup_id")
            ->where(["voter_id" => $user->id])
            ->all();

        $ratedMeetupsIds = [];
        foreach ($ratedMeetupsVotes as $vote) {
            $ratedMeetupsIds[] = $vote->meetup_id;
        }

        $ratedMeetupsDataProvider = new ActiveDataProvider([
            'query' => Meetup::find()
                ->select("
                    meetup.id as id,
                    meetup.title as title,
                    avg(vote.value) as rating,
                    count(vote.value) as rates")
                ->leftJoin('vote', 'meetup.id = vote.meetup_id')
                ->where(['in', 'meetup.id', $ratedMeetupsIds])
                ->groupBy('meetup.id'),
            'pagination' => [
                'pageSize' => 10,
                'defaultPageSize' => 10
            ],
            'sort' => [
                'attributes' => ['title', 'rating', 'rates'],
                'defaultOrder' => ['title' => SORT_ASC],
            ],
        ]);

        return $this->render('rated', [
            'ratedMeetupsDataProvider' => $ratedMeetupsDataProvider,
        ]);
    }

    public function actionNotRated()
    {
        /** @var User $user */
        $user = Yii::$app->user->identity;

        $ratedMeetupsVotes = Vote::find()
            ->select("meetup_id")
            ->where(["voter_id" => $user->id])
            ->all();

        $ratedMeetupsIds = [];
        foreach ($ratedMeetupsVotes as $vote) {
            $ratedMeetupsIds[] = $vote->meetup_id;
        }

        $notRatedMeetupsDataProvider = new ActiveDataProvider([
            'query' => Meetup::find()
                ->select("
                    meetup.id as id,
                    meetup.title as title,
                    avg(vote.value) as rating,
                    count(vote.value) as rates")
                ->leftJoin('vote', 'meetup.id = vote.meetup_id')
                ->where(['not in', 'meetup.id', $ratedMeetupsIds])
                ->groupBy('meetup.id'),
            'pagination' => [
                'pageSize' => 10,
                'defaultPageSize' => 10
            ],
            'sort' => [
                'attributes' => ['title', 'rating', 'rates'],
                'defaultOrder' => ['title' => SORT_ASC],
            ],
        ]);

        return $this->render('not-rated', [
            'notRatedMeetupsDataProvider' => $notRatedMeetupsDataProvider,
        ]);
    }

    public function actionUpdateRating()
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException();
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        if (!isset($_POST['meetupId'])) {
            throw new BadRequestHttpException();
        }

        /** @var User $user */
        $user = Yii::$app->user->identity;

        $meetup = Meetup::findOne(['id' => $_POST['meetupId']]);

        if (is_null($meetup)) {
            throw new BadRequestHttpException();
        }

        if (!isset($_POST['value'])) {
            $this->deleteVote($meetup, $user);
        } else {
            $value = $_POST['value'];

            if (!ctype_digit($value)) {
                throw new BadRequestHttpException();
            }

            $value = intval($value);
            $value = min($value, 10); // max value = 10
            $value = max(1, $value); // min value = 1

            $this->updateVote($meetup, $user, $value);
        }

        $meetupVotes = $meetup->votes;
        $meetupRates = count($meetupVotes);

        if ($meetupRates === 0) {
            $meetupRating = null;
        } else {
            $meetupVoteValues = [];
            foreach ($meetupVotes as $vote) {
                $meetupVoteValues[] = $vote->value;
            }

            $meetupRating = Util::rateAverage(...$meetupVoteValues);
        }

        return [
            'newValue' => $value,
            'newRating' => $meetupRating,
            'newRates' => $meetupRates,
        ];
    }

    private function deleteVote($meetup, $user)
    {
        $vote = Vote::findOne([
            'meetup_id' => $meetup->id,
            'voter_id' => $user->id,
        ]);

        if (!is_null($vote)) {
            $vote->delete();
        }
    }

    private function updateVote($meetup, $user, $value)
    {
        $vote = Vote::findOne([
            'meetup_id' => $meetup->id,
            'voter_id' => $user->id,
        ]);

        if (is_null($vote)) {
            $vote = new Vote();
            $vote->meetup_id = $meetup->id;
            $vote->voter_id = $user->id;
        }
        $vote->value = $value;

        if (!$vote->save()) {
            throw new InternalErrorException();
        }
    }
}
