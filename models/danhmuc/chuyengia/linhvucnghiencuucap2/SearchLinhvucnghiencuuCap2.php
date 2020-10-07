<?php

namespace app\models\danhmuc\chuyengia\linhvucnghiencuucap2;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SearchLinhvucnghiencuuCap2 represents the model behind the search form about `app\models\LinhvucnghiencuuCap2`.
 */
class SearchLinhvucnghiencuuCap2 extends LinhvucnghiencuuCap2
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cap2', 'status', 'created_by', 'updated_by', 'id_cap1'], 'integer'],
            [['ten_cap2', 'ma_cap2', 'ghichu_cap2', 'created_at', 'updated_at'], 'safe'],
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
        $query = LinhvucnghiencuuCap2::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_cap2' => $this->id_cap2,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'id_cap1' => $this->id_cap1,
        ]);

        $query->andFilterWhere(['like', 'ten_cap2', $this->ten_cap2])
            ->andFilterWhere(['like', 'ma_cap2', $this->ma_cap2])
            ->andFilterWhere(['like', 'ghichu_cap2', $this->ghichu_cap2]);

        return $dataProvider;
    }
}
