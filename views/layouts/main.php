<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\User;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

AppAsset::register($this);

/** @var User $identity */
$identity = Yii::$app->user->identity;

$navItems = [
    ['label' => 'Meetups', 'url' => ['/meetups']]
];

if (Yii::$app->user->isGuest) {
    $navItems[] = ['label' => 'Login', 'url' => ['/login']];
    $navItems[] = ['label' => 'Register', 'url' => ['/register']];
} else {
    if ($identity->is_admin) {
        $navItems[] = ['label' => 'Admin', 'url' => ['/admin']];
    }
    $navItems[] =
        '<li>'
        . Html::beginForm(['/logout'], 'post')
        . Html::submitButton(
            'Logout (' . $identity->firstname . ' ' . $identity->lastname . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>';
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/starrr/starrr.css">
    <script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $navItems,
    ]);

    NavBar::end();
    ?>

    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">Meetup Manager - <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
