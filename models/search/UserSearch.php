<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'expires_in', 'sex', 'created_at', 'updated_at'], 'integer'],
            [['access_token', 'open_id', 'refresh_token', 'union_id', 'nickname', 'province', 'city', 'country', 'img_url'], 'safe'],
            [['donation_money'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = User::find();

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
            'expires_in' => $this->expires_in,
            'donation_money' => $this->donation_money,
            'sex' => $this->sex,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'access_token', $this->access_token])
            ->andFilterWhere(['like', 'open_id', $this->open_id])
            ->andFilterWhere(['like', 'refresh_token', $this->refresh_token])
            ->andFilterWhere(['like', 'union_id', $this->union_id])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'img_url', $this->img_url]);

        return $dataProvider;
    }
}
