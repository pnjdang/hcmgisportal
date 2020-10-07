<?php

namespace app\models\danhmuc\chuyengia\donvi;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SearchDonvi represents the model behind the search form about `app\models\Donvi`.
 */
class SearchDonvi extends Donvi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_donvi', 'status', 'nhomdonvi_id', 'updated_by', 'created_by'], 'integer'],
            [['ten_donvi', 'dia_chi', 'created_at', 'updated_at', 'nguoidungdau', 'dien_thoai', 'fax', 'website'], 'safe'],
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
        $query = Donvi::find()->joinWith('nhomdonvi')->where(['don_vi.status' => 1]);

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
            'id_donvi' => $this->id_donvi,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'nhomdonvi_id' => $this->nhomdonvi_id,
            'updated_by' => $this->updated_by,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'upper(ten_donvi)', mb_strtoupper($this->ten_donvi)])
            ->andFilterWhere(['like', 'upper(dia_chi)', mb_strtoupper($this->dia_chi)])
            ->andFilterWhere(['like', 'upper(nguoidungdau)', mb_strtoupper($this->nguoidungdau)])
            ->andFilterWhere(['like', 'upper(dien_thoai)', mb_strtoupper($this->dien_thoai)])
            ->andFilterWhere(['like', 'upper(fax)', mb_strtoupper($this->fax)])
            ->andFilterWhere(['like', 'upper(website)', mb_strtoupper($this->website)]);

        return $dataProvider;
    }
}
