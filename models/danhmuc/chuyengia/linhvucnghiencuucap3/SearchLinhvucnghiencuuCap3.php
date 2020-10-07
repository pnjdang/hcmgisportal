<?php

namespace app\models\danhmuc\chuyengia\linhvucnghiencuucap3;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SearchLinhvucnghiencuuCap3 represents the model behind the search form about `app\models\LinhvucnghiencuuCap3`.
 */
class SearchLinhvucnghiencuuCap3 extends LinhvucnghiencuuCap3
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cap3', 'status', 'created_by', 'updated_by', 'id_cap2'], 'integer'],
            [['ten_cap3', 'ma_cap3', 'ghichu_cap3', 'created_at', 'updated_at'], 'safe'],
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
        $query = LinhvucnghiencuuCap3::find()->orderBy('id_cap3');

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
            'id_cap3' => $this->id_cap3,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'id_cap2' => $this->id_cap2,
        ]);

        $query->andFilterWhere(['like', 'ten_cap3', $this->ten_cap3])
            ->andFilterWhere(['like', 'ma_cap3', $this->ma_cap3])
            ->andFilterWhere(['like', 'ghichu_cap3', $this->ghichu_cap3]);

        return $dataProvider;
    }
}
