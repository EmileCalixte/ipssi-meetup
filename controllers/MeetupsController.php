<?php


namespace app\controllers;


use app\components\Util;
use app\models\databaseModels\Meetup;
use app\models\forms\CreateMeetupForm;
use app\models\User;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class MeetupsController extends _MainController
{
    public function actionIndex()
    {
        $meetupsDataProvider = new ActiveDataProvider([
            'query' => Meetup::find()
                ->select("
                    meetup.id as id,
                    meetup.title as title,
                    meetup.description as description,
                    meetup.creator_id as creator_id,
                    avg(vote.value) as rating
                    count(vote.value) as rates")
                ->leftJoin('vote', 'meetup.id = vote.meetup_id')
                ->groupBy('meetup.id'),
            'pagination' => [
                'pageSize' => 10,
                'defaultPageSize' => 10
            ],
            'sort' => [
                'attributes' => ['title', 'rating', 'rates'],
                'defaultOrder' => ['rating' => SORT_DESC],
            ],
        ]);

        return $this->render('index', [
            'meetupsDataProvider' => $meetupsDataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new CreateMeetupForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            /** @var User $user */
            $user = Yii::$app->user->identity;

            $meetup = new Meetup();
            $meetup->title = $model->title;
            $meetup->description = $model->description;
            $meetup->creator_id = $user->id;

            if(!$meetup->save()) {
                throw new InternalErrorException();
            }

            return $this->redirect('/meetups');
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionView($id = null)
    {
        if(is_null($id)) {
            throw new NotFoundHttpException('Page not found');
        }
        $meetup = Meetup::findOne(['id' => $id]);
        if(is_null($meetup)) {
            throw new NotFoundHttpException('Meetup not found');
        }

        $votes = $meetup->votes;
        if(count($votes) > 0) {
            $voteValues = [];
            foreach($votes as $vote) {
                $voteValues[] = $vote->value;
            }
            $rating = Util::rateAverage(...$voteValues);
        } else {
            $rating = null;
        }

        return $this->render('view', [
            'meetup' => $meetup,
            'rating' => $rating,
        ]);
    }
}