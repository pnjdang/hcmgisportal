<?php

namespace app\models\danhmuc\chuyengia\nhomdonvi;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * NhomdonviSearch represents the model behind the search form about `app\models\Nhomdonvi`.
 */
class SearchNhomdonvi extends Nhomdonvi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_nhomdonvi', 'status', 'created_by', 'updated_by'], 'integer'],
            [['ten_nhomdonvi', 'created_at', 'updated_at', 'ghi_chu'], 'safe'],
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
        $query = Nhomdonvi::find();

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
            'id_nhomdonvi' => $this->id_nhomdonvi,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'ten_nhomdonvi', $this->ten_nhomdonvi])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}
