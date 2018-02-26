<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Expert;

/**
 * ExpertSearch represents the model behind the search form of `common\models\Expert`.
 */
class ExpertSearch extends Expert
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'read_num', 'praise_num', 'created_at', 'post_num'], 'integer'],
            [['name', 'introduction', 'head_img'], 'safe'],
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
        $query = Expert::find();

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
            'read_num' => $this->read_num,
            'praise_num' => $this->praise_num,
            'created_at' => $this->created_at,
            'post_num' => $this->post_num,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'introduction', $this->introduction])
            ->andFilterWhere(['like', 'head_img', $this->head_img]);

        return $dataProvider;
    }
}
