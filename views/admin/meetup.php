<?php

/** @var $this yii\web\View */


use app\models\databaseModels\Meetup;
use app\models\databaseModels\Vote;
use yii\grid\GridView;
use yii\helpers\Html;

/** @var Meetup $meetup */
/** @var yii\data\ActiveDataProvider $ratesDataProvider */

$this->title = 'Admin panel - ' . $meetup->title;

?>
<a href="/admin/meetups">Back to meetups</a>
<h1><?= Html::encode($this->title) ?></h1>
<span><?= Html::encode($meetup->description) ?></span>

<form method="post" action="/admin/delete-meetup" onsubmit="return confirm('Are you sure you want to delete this meetup ?')">
    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>">
    <input type="hidden" name="meetupId" value="<?= $meetup->id ?>">
    <button type="submit" class="btn btn-danger">Delete meetup</button>
</form>

<h2>Rates</h2>

<?= GridView::widget([
    'dataProvider' => $ratesDataProvider,
    'formatter' => [
        'class' => yii\i18n\Formatter::class,
        'nullDisplay' => '<i style="color: #999">-</i>',
    ],
    'layout' => '{items}{pager}',
    'emptyText' => 'This meetup has not been rated.',
    'columns' => [
        [
            'attribute' => 'name',
            'label' => 'Name',
            'format' => 'raw',
            'value' => function ($vote) {
                /** @var Vote $vote */
                return '<a data-pjax=0 href="/admin/users/' . $vote->voter->id . '">' . Html::encode($vote->voter->firstname) . '</a>';
            }
        ],
        [
            'attribute' => 'value',
            'label' => 'Rate',
            'format' => 'raw',
            'value' => function ($vote) {
                /** @var Vote $vote */
                return '<div class="starrr" data-rate="' . $vote->value . '"></div><noscript>' . $vote->value . '</noscript>';
            }
        ]
    ]
]); ?>

<script type="text/javascript" src="/starrr/starrr.js"></script>
<script>
    rateDivs = $('.starrr');
    rateDivs.each(function() {
        rate = $(this).attr('data-rate');
        $(this).starrr({
            rating: rate,
            max: 5,
            emptyClass: 'far fa-star starrr-readonly',
            fullClass: 'fas fa-star starrr-readonly',
            readOnly: true,
        });
    });
</script>

