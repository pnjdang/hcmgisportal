<?php

namespace app\models\danhmuc\phongthinghiem\sohuutritue;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ketquashtt;

/**
 * KetquashttSearch represents the model behind the search form about `app\models\Ketquashtt`.
 */
class KetquashttSearch extends Ketquashtt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ketquashtt', 'status', 'created_by', 'updated_by'], 'integer'],
            [['ten_ketquashtt', 'ghi_chu', 'created_at', 'updated_at'], 'safe'],
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
        $query = Ketquashtt::find();

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
            'id_ketquashtt' => $this->id_ketquashtt,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'ten_ketquashtt', $this->ten_ketquashtt])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}
