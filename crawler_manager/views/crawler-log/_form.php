<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CrawlerLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="crawler-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'crawler')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tasks_id')->textInput() ?>

    <?= $form->field($model, 'items_id')->textInput() ?>

    <?= $form->field($model, 'item_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'task_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'logs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
