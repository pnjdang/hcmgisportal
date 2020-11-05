<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LienHe;

/**
 * LienHeSearch represents the model behind the search form about `app\models\LienHe`.
 */
class LienHeSearch extends LienHe
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_lienhe'], 'integer'],
            [['ho_ten', 'email', 'dien_thoai', 'noi_dung', 'created_at', 'reply', 'replied_at', 'created_by', 'replied_by', 'noi_dung_reply'], 'safe'],
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
        $query = LienHe::find();

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
            'id_lienhe' => $this->id_lienhe,
            'created_at' => $this->created_at,
            'replied_at' => $this->replied_at,
        ]);

        $query->andFilterWhere(['like', 'upper(ho_ten)', mb_strtoupper($this->ho_ten)])
            ->andFilterWhere(['like', 'upper(email)', mb_strtoupper($this->email)])
            ->andFilterWhere(['like', 'upper(dien_thoai)', mb_strtoupper($this->dien_thoai)])
            ->andFilterWhere(['like', 'upper(noi_dung)', mb_strtoupper($this->noi_dung)])
            ->andFilterWhere(['like', 'upper(reply)', mb_strtoupper($this->reply)])
            ->andFilterWhere(['like', 'upper(created_by)', mb_strtoupper($this->created_by)])
            ->andFilterWhere(['like', 'upper(replied_by)', mb_strtoupper($this->replied_by)])
            ->andFilterWhere(['like', 'upper(noi_dung_reply)', mb_strtoupper($this->noi_dung_reply)]);

        return $dataProvider;
    }

    public function getExportColumns()
    {
        return [
            [
                'class' => 'kartik\grid\SerialColumn',
            ],
            'id_lienhe',
        'ho_ten',
        'email',
        'dien_thoai',
        'noi_dung',
        'created_at',
        'reply',
        'replied_at',
        'created_by',
        'replied_by',
        'noi_dung_reply',        ];
    }
}
