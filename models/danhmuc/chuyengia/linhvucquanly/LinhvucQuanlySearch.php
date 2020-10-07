<?php

namespace app\models\danhmuc\chuyengia\linhvucquanly;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * LinhvucQuanlySearch represents the model behind the search form about `app\models\LinhvucQuanly`.
 */
class SearchLinhvucquanly extends LinhvucQuanly
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_lvql'], 'integer'],
            [['ten_lvql', 'ghi_chu'], 'safe'],
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
        $query = LinhvucQuanly::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_lvql' => $this->id_lvql,
        ]);

        $query->andFilterWhere(['like', 'ten_lvql', $this->ten_lvql])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}
