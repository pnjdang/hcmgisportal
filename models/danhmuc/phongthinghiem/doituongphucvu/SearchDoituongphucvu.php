<?php

namespace app\models\danhmuc\phongthinghiem\doituongphucvu;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DoituongPhucvuSearch represents the model behind the search form about `app\models\DoituongPhucvu`.
 */
class SearchDoituongphucvu extends DoituongPhucvu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_dtpv'], 'integer'],
            [['ten_dtpv', 'ghi_chu'], 'safe'],
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
        $query = DoituongPhucvu::find();

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
            'id_dtpv' => $this->id_dtpv,
        ]);

        $query->andFilterWhere(['like', 'ten_dtpv', $this->ten_dtpv])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}
