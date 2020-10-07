<?php

namespace app\models\danhmuc\phongthinghiem\congnhanchatluong;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CongnhanChatluongSearch represents the model behind the search form about `app\models\CongnhanChatluong`.
 */
class SearchCongnhanchatluong extends CongnhanChatluong
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cncl'], 'integer'],
            [['tieu_chuan', 'ghi_chu'], 'safe'],
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
        $query = CongnhanChatluong::find();

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
            'id_cncl' => $this->id_cncl,
        ]);

        $query->andFilterWhere(['like', 'tieu_chuan', $this->tieu_chuan])
            ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}
