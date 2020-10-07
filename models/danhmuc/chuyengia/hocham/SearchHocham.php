<?php

namespace app\models\danhmuc\chuyengia\hocham;

use app\services\DebugService;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\debug\DebugAsset;

/**
 * HocHamSearch represents the model behind the search form about `app\models\HocHam`.
 */
class SearchHocham extends HocHam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_hh'], 'integer'],
            [['ten_hh', 'ghi_chu'], 'safe'],
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
        $query = HocHam::find();
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
            'id_hh' => $this->id_hh,
        ]);

        $query->andFilterWhere(['like', 'ten_hh', $this->ten_hh])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}
