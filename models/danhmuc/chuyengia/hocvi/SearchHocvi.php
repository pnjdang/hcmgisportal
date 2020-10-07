<?php

namespace app\models\danhmuc\chuyengia\hocvi;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * HocViSearch represents the model behind the search form about `app\models\HocVi`.
 */
class SearchHocvi extends HocVi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_hv'], 'integer'],
            [['ten_hv', 'ghi_chu'], 'safe'],
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
        $query = HocVi::find();

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
            'id_hv' => $this->id_hv,
        ]);

        $query->andFilterWhere(['like', 'ten_hv', $this->ten_hv])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}
