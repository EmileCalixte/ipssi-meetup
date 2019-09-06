<?php

/** @var yii\web\View $this */

$this->title = 'Admin panel';

use yii\helpers\Html;

?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="col-sm-12 col-md-9 col-lg-6 no-padding">
    <ul class="menu-list">
        <li><a href="/admin/meetups"><i class="fas fa-bullhorn"></i> Manage meetups</a></li>
        <li><a href="/admin/meetups/create"><i class="fas fa-plus"></i> Create a new meetup</a></li>
        <li><a href="/admin/users"><i class="fas fa-user-friends"></i> Manage users</a></li>
    </ul>
</div>
