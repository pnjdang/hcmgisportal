<?php

namespace app\models\danhmuc\chuyengia\ngoaingu;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SearchNgoaingu represents the model behind the search form about `app\models\Ngoaingu`.
 */
class SearchNgoaingu extends Ngoaingu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ngoaingu'], 'integer'],
            [['ten_ngoaingu', 'ghichu_ngoaingu'], 'safe'],
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
        $query = Ngoaingu::find();

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
            'id_ngoaingu' => $this->id_ngoaingu,
        ]);

        $query->andFilterWhere(['like', 'upper(ten_ngoaingu)', mb_strtoupper($this->ten_ngoaingu)])
            ->andFilterWhere(['like', 'upper(ghichu_ngoaingu)', mb_strtoupper($this->ghichu_ngoaingu)]);

        return $dataProvider;
    }
}
