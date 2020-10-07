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
class SearchChuyengiaCongtac extends ChuyengiaCongtac
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chuyengia_id', 'nam_batdau', 'nam_ketthuc', 'so_thang'], 'integer'],
            [['noi_congtac'], 'string', 'max' => 500],
            [['vitri_congtac', 'linhvuc_congtac'], 'string', 'max' => 200],
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
        $query = ChuyengiaCongtac::find()->where(['chuyengia_id' => $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
            'sort' => [
                'defaultOrder' => [
                    'nam_batdau' => SORT_DESC,
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
            'nam_batdau' => $this->nam_batdau,
            'nam_ketthuc' => $this->nam_ketthuc,
            'so_thang' => $this->so_thang,
        ]);

        $query
            ->andFilterWhere(['like', 'upper(noi_congtac)', mb_strtoupper($this->noi_congtac)])
            ->andFilterWhere(['like', 'upper(vitri_congtac)', mb_strtoupper($this->vitri_congtac)])
            ->andFilterWhere(['like', 'upper(linhvuc_congtac)', mb_strtoupper($this->linhvuc_congtac)]);
        return $dataProvider;
    }
}
