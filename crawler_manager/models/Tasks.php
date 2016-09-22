<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $crawler
 * @property string $xpath1
 * @property string $xpath2
 * @property string $xpath3
 * @property string $xpath4
 * @property string $updated_at
 * @property string $created_at
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['updated_at', 'created_at'], 'safe'],
            [['name', 'crawler'], 'string', 'max' => 32],
            [['url'], 'string', 'max' => 128],
            [['xpath1', 'xpath2', 'xpath3', 'xpath4'], 'string', 'max' => 240],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
            'crawler' => 'Crawler',
            'xpath1' => 'Xpath1',
            'xpath2' => 'Xpath2',
            'xpath3' => 'Xpath3',
            'xpath4' => 'Xpath4',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
