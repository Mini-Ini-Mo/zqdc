<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ActLessons;

/**
 * ActLessonSearch represents the model behind the search form of `common\models\ActLessons`.
 */
class ActLessonSearch extends ActLessons
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'less_cate', 'expert_id', 'created_at'], 'integer'],
            [['topical', 'thumb', 'intro', 'content', 'act_begin_time', 'act_end_time', 'status', 'less_mode'], 'safe'],
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

        $query = ActLessons::find();

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
            'less_cate' => $this->less_cate,
            'expert_id' => $this->expert_id,
            'act_begin_time' => $this->act_begin_time,
            'act_end_time' => $this->act_end_time,
            'created_at' => $this->created_at,
            'less_mode' => $this->less_mode,
        ]);

        $query->andFilterWhere(['like', 'topical', $this->topical])
            ->andFilterWhere(['like', 'thumb', $this->thumb])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'less_mode', $this->less_mode]);

        return $dataProvider;
    }
}
