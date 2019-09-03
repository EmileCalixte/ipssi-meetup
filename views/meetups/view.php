<?php

/* @var $this yii\web\View */
/* @var Meetup $meetup */
/* @var float|null $rating */

use app\models\databaseModels\Meetup;
use yii\helpers\Html;

$this->title = $meetup->title;
?>

<h1><?= Html::encode($this->title) ?></h1>
<span><?= Html::encode($meetup->description) ?></span>

<p>Rating: <?= is_null($rating) ? '<i>Nobody rated this meetup</i>' : $rating . ' (' . count($meetup->votes) . ' rated)' ?></p>
