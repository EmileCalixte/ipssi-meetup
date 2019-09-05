<?php

/** @var yii\web\View $this */

$this->title = 'Admin panel';

use yii\helpers\Html;

?>

<h1><?= Html::encode($this->title) ?></h1>

<ul>
    <li><a href="/admin/meetups">Manage meetups</a></li>
    <li><a href="/admin/meetups/create">Create a new meetup</a></li>
    <li><a href="/admin/users">Manage users</a></li>
</ul>