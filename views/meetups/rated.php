<?php

/** @var yii\web\View $this */

use app\components\Util;
use app\models\databaseModels\Meetup;
use app\models\databaseModels\Vote;
use app\models\User;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/** @var yii\data\ActiveDataProvider $ratedMeetupsDataProvider */

$this->title = 'Rated meetups';

/** @var User $user */
$user = Yii::$app->user->identity;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' => $ratedMeetupsDataProvider,
    'formatter' => [
        'class' => yii\i18n\Formatter::class,
        'nullDisplay' => '<i style="color: #999">-</i>',
    ],
    'layout' => '{items}{pager}',
    'emptyText' => 'You haven\'t rated any meetup.',
    'columns' => [
        [
            'attribute' => 'title',
            'label' => 'Title',
            'format' => 'raw',
            'value' => function($meetup) {
                /** @var Meetup $meetup */
                return '<a data-pjax=0 href="/meetups/view/' . $meetup->id . '">' . Html::encode($meetup->title) . '</a>';
            }
        ],
        [
            'attribute' => 'rating',
            'label' => 'Rating',
            'value' => function($meetup) {
                /** @var Meetup $meetup */
                $votes = $meetup->votes;
                if(count($votes) === 0) return null;

                $voteValues = [];
                foreach($votes as $vote) {
                    $voteValues[] = $vote->value;
                }
                return Util::rateAverage(...$voteValues) . '/5';
            }
        ],
        [
            'attribute' => 'rates',
            'label' => 'Rates',
            'value' => function($meetup) {
                /** @var Meetup $meetup */
                $votes = $meetup->votes;
                return count($votes);
            }
        ],
        [
            'label' => 'Your rate',
            'value' => function($meetup) use ($user) {
                /** @var Meetup $meetup */
                $vote = Vote::findOne([
                    'meetup_id' => $meetup->id,
                    'voter_id' => $user->id,
                ]);
                return $vote->value . '/5';
            }
        ]
    ]
]); ?>

<?php Pjax::end(); ?>




