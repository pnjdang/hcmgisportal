<?php

namespace app\models\phongthinghiem;

use app\models\danhmuc\phongthinghiem\thietbi\ThietBi;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DschuyengiaSearch represents the model behind the search form about `app\models\VChuyengia`.
 */
class SearchPhongthinghiemThietbi extends PhongthinghiemThietbi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ptn_id', 'thietbi_id', 'so_luong'], 'integer'],
            [['so_hieu', 'tinh_trang'], 'string', 'max' => 200],
            [['ghi_chu'], 'string', 'max' => 500],
            [['ptn_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhongThiNghiem::className(), 'targetAttribute' => ['ptn_id' => 'id_ptn']],
            [['thietbi_id'], 'exist', 'skipOnError' => true, 'targetClass' => ThietBi::className(), 'targetAttribute' => ['thietbi_id' => 'id_tb']],
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
    public function search($params, $ptn_id)
    {
        $query = PhongthinghiemThietbi::find()
            ->with('thietbi')
            ->where(['ptn_id' => $ptn_id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
//            'sort' => [
//                'defaultOrder' => [
//                    'created_at' => SORT_ASC,
//                ]
//            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ptn_id' => $this->ptn_id,
            'thietbi_id' => $this->thietbi_id,
        ]);

        $query
            ->andFilterWhere(['like', 'upper(so_luong)', mb_strtoupper($this->so_luong)])
            ->andFilterWhere(['like', 'upper(so_hieu)', mb_strtoupper($this->so_hieu)])
            ->andFilterWhere(['like', 'upper(tinh_trang)', mb_strtoupper($this->tinh_trang)])
            ->andFilterWhere(['like', 'upper(ghi_chu)', mb_strtoupper($this->ghi_chu)]);
//        \app\services\DebugService::dumpdie($query->all());
        return $dataProvider;
    }
}
