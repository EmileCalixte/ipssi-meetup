<?php

/* @var $this yii\web\View */
/* @var $model app\models\forms\CreateMeetupForm */

$this->title = 'Create a meetup';

use yii\helpers\Html;
use yii\bootstrap\ActiveForm; ?>

<div class="meetup-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to submit a new meetup:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'create-meetup-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['style' => 'resize: vertical']) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Create', ['class' => 'btn btn-success', 'name' => 'submit-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>