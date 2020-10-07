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
class SearchChuyengiaDaotao extends ChuyengiaDaotao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chuyengia_id', 'nam_totnghiep'], 'integer'],
            [['noi_daotao', 'trinhdo_daotao', 'chuyennganh_daotao'], 'string', 'max' => 200],
            [['chuyengia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chuyengia::className(), 'targetAttribute' => ['chuyengia_id' => 'id_chuyengia']],
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
        $query = ChuyengiaDaotao::find()->where(['chuyengia_id' => $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
            'sort' => [
                'defaultOrder' => [
                    'nam_totnghiep' => SORT_ASC,
                ]


            ],
        ]);

        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'nam_batdau' => $this->nam_totnghiep,
        ]);

        $query
            ->andFilterWhere(['like', 'upper(noi_daotao)', mb_strtoupper($this->noi_daotao)])
            ->andFilterWhere(['like', 'upper(chuyennganh_daotao)', mb_strtoupper($this->chuyennganh_daotao)])
            ->andFilterWhere(['like', 'upper(trinhdo_daotao)', mb_strtoupper($this->trinhdo_daotao)]);
        return $dataProvider;
    }
}
