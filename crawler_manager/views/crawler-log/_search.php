<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CrawlerLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="crawler-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'crawler') ?>

    <?= $form->field($model, 'tasks_id') ?>

    <?= $form->field($model, 'items_id') ?>

    <?= $form->field($model, 'item_url') ?>

    <?php // echo $form->field($model, 'task_url') ?>

    <?php // echo $form->field($model, 'logs') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
