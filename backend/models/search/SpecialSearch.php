<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Special;

/**
 * SpecialSearch represents the model behind the search form of `common\models\Special`.
 */
class SpecialSearch extends Special
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'expert_id', 'praise_num', 'read_num', 'created_at', 'cate_id'], 'integer'],
            [['title', 'viewpoint', 'analysis', 'status'], 'safe'],
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
        $query = Special::find();

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
            'expert_id' => $this->expert_id,
            'praise_num' => $this->praise_num,
            'read_num' => $this->read_num,
            'created_at' => $this->created_at,
            'cate_id' => $this->cate_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'viewpoint', $this->viewpoint])
            ->andFilterWhere(['like', 'analysis', $this->analysis])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
