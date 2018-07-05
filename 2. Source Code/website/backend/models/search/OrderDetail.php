<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\OrderDetail as OrderDetailModel;

/**
 * OrderDetail represents the model behind the search form of `backend\models\OrderDetail`.
 */
class OrderDetail extends OrderDetailModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'productid', 'price', 'discount', 'orderid'], 'integer'],
            [['discounrRatio'], 'number'],
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
        $query = OrderDetailModel::find();

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
            'productid' => $this->productid,
            'price' => $this->price,
            'discount' => $this->discount,
            'discounrRatio' => $this->discounrRatio,
            'orderid' => $this->orderid,
        ]);

        return $dataProvider;
    }
}
