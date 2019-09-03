<?php

/** @var yii\web\View $this */

use app\components\Util;
use app\models\databaseModels\Meetup;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/** @var yii\data\ActiveDataProvider $meetupsDataProvider */

$this->title = 'Meetups';
?>

<h1><?= Html::encode($this->title) ?></h1>

<a href="/meetups/create" class="btn btn-success">Submit a meetup</a>

<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' =>$meetupsDataProvider,
    'formatter' => [
        'class' => yii\i18n\Formatter::class,
        'nullDisplay' => '<i style="color: #999">-</i>',
    ],
    'layout' => '{items}{pager}',
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
                return Util::rateAverage(...$voteValues);
            }
        ],
        [
            'attribute' => 'rates',
            'label' => 'Rates',
            'value' => function($meetup) {
                /** @var Meetup $meetup */
                $votes = $meetup->votes;
                return 1;
            }
        ]
    ]
]); ?>

<?php Pjax::end(); ?>


