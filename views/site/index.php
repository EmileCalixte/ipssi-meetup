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

<form method="get">
    <div id="search-container" class="input-group col-sm-12 col-md-6" style="margin-bottom: 10px;">
        <input type="text" name="search" class="form-control" placeholder="Search for a meetup title" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
        <div class="input-group-btn">
            <button type="submit" class="btn btn-success"><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>

<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' => $meetupsDataProvider,
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
                return '<a data-pjax=0 href="/meetups/view/' . $meetup->id . '">' . Html::encode($meetup->title) . '</a>';
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




