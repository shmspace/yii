<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CrawlerLog;

/**
 * CrawlerLogSearch represents the model behind the search form about `app\models\CrawlerLog`.
 */
class CrawlerLogSearch extends CrawlerLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tasks_id', 'items_id'], 'integer'],
            [['crawler', 'item_url', 'task_url', 'logs', 'updated_at', 'created_at'], 'safe'],
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
        $query = CrawlerLog::find();

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
            'tasks_id' => $this->tasks_id,
            'items_id' => $this->items_id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'crawler', $this->crawler])
            ->andFilterWhere(['like', 'item_url', $this->item_url])
            ->andFilterWhere(['like', 'task_url', $this->task_url])
            ->andFilterWhere(['like', 'logs', $this->logs]);

        return $dataProvider;
    }
}
