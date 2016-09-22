<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CrawlerLog */

$this->title = 'Create Crawler Log';
$this->params['breadcrumbs'][] = ['label' => 'Crawler Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="crawler-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
