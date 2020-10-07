<?php

namespace app\models\danhmuc\phongthinghiem\tieuchuan;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TieuChuanSearch represents the model behind the search form about `app\models\TieuChuan`.
 */
class SearchTieuchuan extends TieuChuan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tc'], 'integer'],
            [['ten_tc', 'ghi_chu'], 'safe'],
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
        $query = TieuChuan::find();

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
            'id_tc' => $this->id_tc,
        ]);

        $query->andFilterWhere(['like', 'ten_tc', $this->ten_tc])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}