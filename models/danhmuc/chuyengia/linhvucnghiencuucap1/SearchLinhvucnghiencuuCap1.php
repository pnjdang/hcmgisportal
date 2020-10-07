<?php

namespace app\models\danhmuc\chuyengia\linhvucnghiencuucap1;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SearchLinhvucnghiencuuCap1 represents the model behind the search form about `app\models\LinhvucnghiencuuCap1`.
 */
class SearchLinhvucnghiencuuCap1 extends LinhvucnghiencuuCap1
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cap1', 'status', 'created_by', 'updated_by'], 'integer'],
            [['ten_cap1', 'ma_cap1', 'ghichu_cap1', 'created_at', 'updated_at'], 'safe'],
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
        $query = LinhvucnghiencuuCap1::find()->where(['status' => 1])->orderBy('id_cap1');

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
            'id_cap1' => $this->id_cap1,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'ten_cap1', $this->ten_cap1])
            ->andFilterWhere(['like', 'ma_cap1', $this->ma_cap1])
            ->andFilterWhere(['like', 'ghichu_cap1', $this->ghichu_cap1]);

        return $dataProvider;
    }
}
