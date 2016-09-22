<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Items;

/**
 * ItemsSearch represents the model behind the search form about `app\models\Items`.
 */
class ItemsSearch extends Items
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'adress', 'phone', 'description', 'item_url', 'list_url', 'category', 'crawler', 'updated_at', 'created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Items::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'adress', $this->adress])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'item_url', $this->item_url])
            ->andFilterWhere(['like', 'list_url', $this->list_url])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'crawler', $this->crawler]);

        return $dataProvider;
    }
}
