<?php

namespace app\models\danhmuc\phongthinghiem\phanloai;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SearchPhanloai represents the model behind the search form about `app\models\danhmuc\phongthinghiem\chungloai\PhanLoai`.
 */
class SearchPhanloai extends PhanLoai
{
    public $ten_cl;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pl', 'id_cl'], 'integer'],
            [['ten_pl','ten_cl', 'ghi_chu'], 'safe'],
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
        $query = PhanLoai::find()->joinWith('chungloai');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
            'sort' => [
                'attributes' => [
                    'ten_pl',
                    'ghi_chu',
                    'ten_cl' => [
                        'asc' => ['chung_loai.ten_cl' => SORT_ASC,],
                        'desc' => ['chung_loai.ten_cl' => SORT_DESC],
                        'label' => 'Tên chủng loại',
                    ],
                    'id_pl'
                ],
                'defaultOrder' => [
                    'id_pl' => SORT_ASC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_pl' => $this->id_pl,
            'id_cl' => $this->id_cl,
        ]);

        $query->andFilterWhere(['like', 'upper(ten_pl)', mb_strtoupper($this->ten_pl)])
            ->andFilterWhere(['like', 'upper(chung_loai.ten_cl)', mb_strtoupper($this->ten_cl)])
            ->andFilterWhere(['like', 'upper(ghi_chu)', mb_strtoupper($this->ghi_chu)]);

        return $dataProvider;
    }
}
