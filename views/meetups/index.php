<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

/** @var int $notRatedMeetupsNumber */

$this->title = 'Meetups';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="col-sm-12 col-md-9 col-lg-6 no-padding">
    <ul class="menu-list">
        <li><a href="/meetups/rated"><i class="fas fa-check"></i> Meetups I have rated</a></li>
        <li><a href="/meetups/not-rated"><i class="fas fa-times"></i> Meetups I have not rated (<?= $notRatedMeetupsNumber ?>)</a></li>
    </ul>
</div>