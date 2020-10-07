<?php

namespace app\models\chuyengia;

use app\models\danhmuc\chuyengia\loaicongtrinhnghiencuu\LoaiCongtrinhnghiencuu;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DschuyengiaSearch represents the model behind the search form about `app\models\VChuyengia`.
 */
class SearchChuyengiaCongtrinh extends ChuyengiaCongtrinh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chuyengia_id', 'loaicongtrinh_id', 'nam'], 'integer'],
            [['ten_congtrinh'], 'string'],
            [['tac_gia', 'ghichu_chuyengiacongtrinh'], 'string', 'max' => 200],
            [['noi_congbo'], 'string', 'max' => 1000],
            [['chuyengia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chuyengia::className(), 'targetAttribute' => ['chuyengia_id' => 'id_chuyengia']],
            [['loaicongtrinh_id'], 'exist', 'skipOnError' => true, 'targetClass' => LoaiCongtrinhnghiencuu::className(), 'targetAttribute' => ['loaicongtrinh_id' => 'id_loaicongtrinh']],
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
        $query = ChuyengiaCongtrinh::find()->with('loaicongtrinh')->where(['chuyengia_id' => $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
            'sort' => [
                'defaultOrder' => [
                    'nam' => SORT_DESC,
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
            'loaicongtrinh_id' => $this->loaicongtrinh_id,
            'nam' => $this->nam,
        ]);

        $query
            ->andFilterWhere(['like', 'upper(ten_congtrinh)', mb_strtoupper($this->ten_congtrinh)])
            ->andFilterWhere(['like', 'upper(noi_congbo)', mb_strtoupper($this->noi_congbo)])
            ->andFilterWhere(['like', 'upper(tac_gia)', mb_strtoupper($this->tac_gia)]);
        return $dataProvider;
    }
}
