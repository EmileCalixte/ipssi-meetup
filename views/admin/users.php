<?php

/** @var $this yii\web\View */

use app\models\databaseModels\Meetup;
use app\models\User;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/** @var yii\data\ActiveDataProvider $usersDataProvider */

$this->title = 'Admin panel - users';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' => $usersDataProvider,
    'formatter' => [
        'class' => yii\i18n\Formatter::class,
        'nullDisplay' => '<i style="color: #999">-</i>',
    ],
    'layout' => '{items}{pager}',
    'columns' => [
        [
            'attribute' => 'name',
            'label' => 'Name',
            'format' => 'raw',
            'value' => function ($user) {
                /** @var User $user */
                return '<a data-pjax=0 href="/admin/users/' . $user->id . '">' . Html::encode($user->firstname) . ' ' . Html::encode($user->lastname) . '</a>';
            }
        ],
        [
            'attribute' => 'rates',
            'label' => 'Meetups rated',
            'value' => function ($user) {
                /** @var Meetup $meetup */
                $votes = $user->votes;
                return count($votes);
            }
        ]
    ]
]); ?>

<?php Pjax::end(); ?>