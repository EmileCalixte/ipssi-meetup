<?php

/** @var $this yii\web\View */

use app\components\Util;
use app\models\databaseModels\Meetup;
use app\models\databaseModels\Vote;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/** @var yii\data\ActiveDataProvider $ratesDataProvider */

$this->title = 'Admin panel - ' . $user->firstname . ' ' . $user->lastname;

?>

<h1><?= Html::encode($this->title) ?></h1>
<span>Register date: <?= Html::encode($user->register_date) ?></span>
<?php
if ($user->is_admin) {
    ?>
    <br>
    <span><strong>Admin</strong></span>

    <form method="post" action="/admin/revoke-admin" onsubmit="return confirm('Are you sure you want to revoke admin rights to this user ?')">
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>">
        <input type="hidden" name="userId" value="<?= $user->id ?>">
        <button type="submit" class="btn btn-warning">Revoke admin rights</button>
    </form>
    <?php
} else {
        ?>
    <form method="post" action="/admin/grant-admin" onsubmit="return confirm('Are you sure you want to grant admin rights to this user ?')">
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>">
        <input type="hidden" name="userId" value="<?= $user->id ?>">
        <button type="submit" class="btn btn-success">Grant admin rights</button>
    </form>
    <?php
    }
?>

<form method="post" action="/admin/delete-user" onsubmit="return confirm('Are you sure you want to delete this user ?')">
    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>">
    <input type="hidden" name="userId" value="<?= $user->id ?>">
    <button type="submit" class="btn btn-danger">Delete user</button>
</form>

<h2>Meetups rated</h2>

<?= GridView::widget([
    'dataProvider' => $ratesDataProvider,
    'formatter' => [
        'class' => yii\i18n\Formatter::class,
        'nullDisplay' => '<i style="color: #999">-</i>',
    ],
    'layout' => '{items}{pager}',
    'emptyText' => 'This user didn\'t rated any meetup.',
    'columns' => [
        [
            'attribute' => 'title',
            'label' => 'Title',
            'format' => 'raw',
            'value' => function ($vote) {
                /** @var Vote $vote */
                return '<a data-pjax=0 href="/admin/meetups/' . $vote->meetup->id . '">' . Html::encode($vote->meetup->title) . '</a>';
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