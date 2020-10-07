<?php

namespace app\models\chuyengia;

use app\services\DebugService;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VChuyengia;

/**
 * DschuyengiaSearch represents the model behind the search form about `app\models\VChuyengia`.
 */
class SearchChuyengiaNgoaingu extends ChuyengiaNgoaingu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chuyengia_id', 'ngoaingu_id'], 'integer'],
            [['nghe', 'noi', 'doc', 'viet'], 'string', 'max' => 20],
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
    public function search($params,$id)
    {
        $query = ChuyengiaNgoaingu::find()->with('ngoaingu')->where(['chuyengia_id' => $id]);

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
            'ngoaingu_id' => $this->ngoaingu_id,
        ]);

        $query
            ->andFilterWhere(['like', 'upper(nghe)', mb_strtoupper($this->nghe)])
            ->andFilterWhere(['like', 'upper(noi)', mb_strtoupper($this->noi)])
            ->andFilterWhere(['like', 'upper(doc)', mb_strtoupper($this->doc)])
            ->andFilterWhere(['like', 'upper(viet)', mb_strtoupper($this->viet)]);
        return $dataProvider;
    }
}
