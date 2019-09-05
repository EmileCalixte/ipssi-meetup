<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Meetups';
?>

<h1><?= Html::encode($this->title) ?></h1>

<ul>
    <li><a href="/meetups/rated">Meetups I have rated</a></li>
    <li><a href="/meetups/not-rated">Meetups I have not rated</a></li>
</ul>