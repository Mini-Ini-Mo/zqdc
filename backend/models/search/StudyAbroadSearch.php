<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StudyAbroad;

/**
 * StudyAbroadSearch represents the model behind the search form of `common\models\StudyAbroad`.
 */
class StudyAbroadSearch extends StudyAbroad
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'begin_time'], 'integer'],
            [['destination', 'cost', 'status', 'intro', 'content'], 'safe'],
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
        $query = StudyAbroad::find();

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
            'begin_time' => $this->begin_time,
        ]);

        $query->andFilterWhere(['like', 'destination', $this->destination])
            ->andFilterWhere(['like', 'cost', $this->cost])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
