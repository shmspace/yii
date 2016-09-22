<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CrawlerLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Crawler Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="crawler-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Crawler Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'crawler',
            'tasks_id',
            'items_id',
            'item_url:url',
            // 'task_url:url',
            // 'logs',
            // 'updated_at',
            // 'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
