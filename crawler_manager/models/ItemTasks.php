<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_tasks".
 *
 * @property integer $id
 * @property integer $tasks_id
 * @property string $url
 * @property integer $status
 * @property string $crawler
 * @property string $updated_at
 * @property string $created_at
 */
class ItemTasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tasks_id', 'status', 'page'], 'integer'],
            [['updated_at', 'created_at'], 'required'],
            [['updated_at', 'created_at'], 'safe'],
            [['crawler'], 'string', 'max' => 32],
            [['url', 'page_url'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tasks_id' => 'Tasks ID',
            'url' => 'Url',
            'page_url' => 'Page Url',
            'status' => 'Status',
            'crawler' => 'Crawler',
            'page' => 'Page',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
