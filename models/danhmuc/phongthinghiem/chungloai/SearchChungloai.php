<?php

namespace app\models\danhmuc\phongthinghiem\chungloai;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ChungLoaiSearch represents the model behind the search form about `app\models\ChungLoai`.
 */
class SearchChungloai extends ChungLoai
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cl'], 'integer'],
            [['ten_cl', 'ghi_chu'], 'safe'],
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
        $query = ChungLoai::find();

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
            'id_cl' => $this->id_cl,
        ]);

        $query->andFilterWhere(['like', 'ten_cl', $this->ten_cl])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}
