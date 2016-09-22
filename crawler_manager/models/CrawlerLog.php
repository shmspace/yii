<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "crawler_log".
 *
 * @property integer $id
 * @property string $crawler
 * @property integer $tasks_id
 * @property integer $items_id
 * @property string $item_url
 * @property string $task_url
 * @property string $logs
 * @property string $updated_at
 * @property string $created_at
 */
class CrawlerLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'crawler_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tasks_id', 'items_id'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['crawler'], 'string', 'max' => 32],
            [['item_url', 'task_url'], 'string', 'max' => 128],
            [['logs'], 'string', 'max' => 240],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'crawler' => 'Crawler',
            'tasks_id' => 'Tasks ID',
            'items_id' => 'Items ID',
            'item_url' => 'Item Url',
            'task_url' => 'Task Url',
            'logs' => 'Logs',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
