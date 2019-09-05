<?php
/** @var yii\web\View $this */

use app\components\Util;
use app\models\databaseModels\Meetup;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/** @var yii\data\ActiveDataProvider $meetupsDataProvider */

$this->title = 'Admin panel - Meetups';?>

<h1><?= Html::encode($this->title) ?></h1>

<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' =>$meetupsDataProvider,
    'formatter' => [
        'class' => yii\i18n\Formatter::class,
        'nullDisplay' => '<i style="color: #999">-</i>',
    ],
    'layout' => '{items}{pager}',
    'emptyText' => 'There is currently no meetups.',
    'columns' => [
        [
            'attribute' => 'title',
            'label' => 'Title',
            'format' => 'raw',
            'value' => function ($meetup) {
                /** @var Meetup $meetup */
                return '<a data-pjax=0 href="/admin/meetups/' . $meetup->id . '">' . Html::encode($meetup->title) . '</a>';
            }
        ],
        [
            'attribute' => 'rating',
            'label' => 'Rating',
            'value' => function ($meetup) {
                /** @var Meetup $meetup */
                $votes = $meetup->votes;
                if (count($votes) === 0) {
                    return null;
                }

                $voteValues = [];
                foreach ($votes as $vote) {
                    $voteValues[] = $vote->value;
                }
                return Util::rateAverage(...$voteValues) . '/5';
            }
        ],
        [
            'attribute' => 'rates',
            'label' => 'Rates',
            'value' => function ($meetup) {
                /** @var Meetup $meetup */
                $votes = $meetup->votes;
                return count($votes);
            }
        ]
    ]
]); ?>

<?php Pjax::end(); ?>