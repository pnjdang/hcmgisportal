<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DschuyengiaSearch represents the model behind the search form about `app\models\VChuyengia`.
 */
class SearchLienhe extends LienHe
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['noi_dung'], 'string'],
            [['created_at', 'replied_at'], 'safe'],
            [['reply', 'created_by', 'replied_by'], 'integer'],
            [['ho_ten', 'email'], 'string', 'max' => 200],
            [['dien_thoai'], 'string', 'max' => 50],
            [['noi_dung_reply'], 'string', 'max' => 500],
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
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query
            ->andFilterWhere(['like', 'upper(ho_ten)', mb_strtoupper($this->ho_ten)])
            ->andFilterWhere(['like', 'upper(noi_dung)', mb_strtoupper($this->noi_dung)])
            ->andFilterWhere(['like', 'upper(email)', mb_strtoupper($this->email)]);
//        \app\services\DebugService::dumpdie($query->all());
        return $dataProvider;
    }
}
