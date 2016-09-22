<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "items".
 *
 * @property integer $id
 * @property string $name
 * @property string $adress
 * @property string $phone
 * @property string $description
 * @property string $item_url
 * @property string $list_url
 * @property string $category
 * @property string $crawler
 * @property string $updated_at
 * @property string $created_at
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['updated_at', 'created_at'], 'safe'],
            [['name', 'category'], 'string', 'max' => 64],
            [['adress', 'item_url', 'list_url'], 'string', 'max' => 128],
            [['phone', 'crawler'], 'string', 'max' => 32],
            [['description'], 'string', 'max' => 240],
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
            'adress' => 'Adress',
            'phone' => 'Phone',
            'description' => 'Description',
            'item_url' => 'Item Url',
            'list_url' => 'List Url',
            'category' => 'Category',
            'crawler' => 'Crawler',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
