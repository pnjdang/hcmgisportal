<?php

namespace app\models\danhmuc\phongthinghiem\thietbi;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ThietBiSearch represents the model behind the search form about `app\models\ThietBi`.
 */
class SearchThietbi extends ThietBi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tb'], 'integer'],
            [['hang_sx', 'dac_tinh', 'tinh_trang', 'ghi_chu', 'ten_tb'], 'safe'],
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
        $query = ThietBi::find();

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
            'id_tb' => $this->id_tb,
        ]);

        $query->andFilterWhere(['like', 'hang_sx', $this->hang_sx])
            ->andFilterWhere(['like', 'dac_tinh', $this->dac_tinh])
            ->andFilterWhere(['like', 'tinh_trang', $this->tinh_trang])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu])
            ->andFilterWhere(['like', 'ten_tb', $this->ten_tb]);

        return $dataProvider;
    }
}
