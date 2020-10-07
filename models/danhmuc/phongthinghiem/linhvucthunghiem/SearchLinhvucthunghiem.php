<?php

namespace app\models\danhmuc\phongthinghiem\linhvucthunghiem;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * LinhvucThunghiemSearch represents the model behind the search form about `app\models\LinhvucThunghiem`.
 */
class SearchLinhvucthunghiem extends LinhvucThunghiem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_lv'], 'integer'],
            [['ten_lv', 'ghi_chu'], 'safe'],
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
        $query = LinhvucThunghiem::find()->orderBy('id_lv');

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
            'id_lv' => $this->id_lv,
        ]);

        $query->andFilterWhere(['like', 'ten_lv', $this->ten_lv])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}
