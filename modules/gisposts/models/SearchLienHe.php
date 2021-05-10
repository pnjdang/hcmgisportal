<?php

namespace app\modules\gisposts\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\gisposts\models\LienHe;

/**
 * SearchLienHe represents the model behind the search form about `app\modules\gisposts\models\LienHe`.
 */
class SearchLienHe extends LienHe
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['hoten', 'email', 'dienthoai', 'chude', 'noidung', 'created_at'], 'safe'],
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
            'id' => $this->id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'upper(hoten)', mb_strtoupper($this->hoten)])
            ->andFilterWhere(['like', 'upper(email)', mb_strtoupper($this->email)])
            ->andFilterWhere(['like', 'upper(dienthoai)', mb_strtoupper($this->dienthoai)])
            ->andFilterWhere(['like', 'upper(chude)', mb_strtoupper($this->chude)])
            ->andFilterWhere(['like', 'upper(noidung)', mb_strtoupper($this->noidung)]);

        return $dataProvider;
    }

    public function getExportColumns()
    {
        return [
            [
                'class' => 'kartik\grid\SerialColumn',
            ],
            'id',
        'hoten',
        'email',
        'dienthoai',
        'chude',
        'noidung',
        'created_at',        ];
    }
}
