<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItemTasks;

/**
 * ItemTasksSearch represents the model behind the search form about `app\models\ItemTasks`.
 */
class ItemTasksSearch extends ItemTasks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tasks_id', 'page', 'status'], 'integer'],
            [['url', 'page_url', 'crawler', 'updated_at', 'created_at'], 'safe'],
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
        $query = ItemTasks::find();

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
            'url' => $this->url,
            'status' => $this->status,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'tasks_id', $this->tasks_id])
            ->andFilterWhere(['like', 'crawler', $this->crawler]);

        return $dataProvider;
    }
}
