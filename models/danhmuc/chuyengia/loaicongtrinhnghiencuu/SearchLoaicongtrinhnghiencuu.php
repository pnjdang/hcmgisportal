<?php

namespace app\models\danhmuc\chuyengia\loaicongtrinhnghiencuu;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SearchLoaicongtrinhnghiencuu represents the model behind the search form about `app\models\LoaiCongtrinhnghiencuu`.
 */
class SearchLoaicongtrinhnghiencuu extends LoaiCongtrinhnghiencuu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ten_loaicongtrinh', 'ghichu_loaicongtrinh'], 'safe'],
            [['id_loaicongtrinh'], 'integer'],
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
        $query = LoaiCongtrinhnghiencuu::find();

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
            'id_loaicongtrinh' => $this->id_loaicongtrinh,
        ]);

        $query->andFilterWhere(['like', 'upper(ten_loaicongtrinh)', mb_strtoupper($this->ten_loaicongtrinh)])
            ->andFilterWhere(['like', 'upper(ghichu_loaicongtrinh)', mb_strtoupper($this->ghichu_loaicongtrinh)]);

        return $dataProvider;
    }
}
