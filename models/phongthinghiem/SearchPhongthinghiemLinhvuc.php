<?php

namespace app\models\phongthinghiem;

use app\services\DebugService;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * PhongthinghiemSearch represents the model behind the search form about `app\models\PhongThiNghiem`.
 */
class SearchPhongthinghiemLinhvuc extends PhongThiNghiem {

    /**
     * @inheritdoc
     */
    public $thietbi_id;
    public $pl_id;
    public $lvtn_id;
    public function rules() {
        return [
            [['id_ptn','pl_id','lvtn_id','thietbi_id', 'dtpv_id', 'dien_thoai', 'fax', 'tien_si', 'thac_si', 'cu_nhan', 'ky_thuat', 'dien_tich'], 'integer'],
            [['ten_tv', 'ten_ta', 'coquan_chuquan', 'dia_chi', 'email', 'website', 'phu_trach', 'dai_dien', 'dactrung_hoatdong', 'dinh_huong', 'ghi_chu', 'gia_tri_uoc_tinh', 'geom'], 'safe'],
            [['xac_nhan'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params,$id) {

        $query = PhongthinghiemLinhvuc::find()->joinWith('ptn')->where(['phong_thi_nghiem.status' => 1,'phongthinghiem_linhvuc.lv_id' => $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'ten_tv' => [
                        'asc' =>    [ 'phong_thi_nghiem.ten_tv' => SORT_ASC ],
                        'desc' =>   [ 'phong_thi_nghiem.ten_tv' => SORT_DESC ],
                        'label' => 'ten_tv'
                    ],
                    'ten_ta' => [
                        'asc' =>    [ 'phong_thi_nghiem.ten_ta' => SORT_ASC ],
                        'desc' =>   [ 'phong_thi_nghiem.ten_ta' => SORT_DESC ],
                        'label' => 'ten_ta'
                    ],
                    'coquan_chuquan' => [
                        'asc' =>    [ 'phong_thi_nghiem.coquan_chuquan' => SORT_ASC ],
                        'desc' =>   [ 'phong_thi_nghiem.coquan_chuquan' => SORT_DESC ],
                        'label' => 'coquan_chuquan'
                    ],
                    'dia_chi' => [
                        'asc' =>    [ 'phong_thi_nghiem.dia_chi' => SORT_ASC ],
                        'desc' =>   [ 'phong_thi_nghiem.dia_chi' => SORT_DESC ],
                        'label' => 'dia_chi'
                    ],
                    'dai_dien' => [
                        'asc' =>    [ 'phong_thi_nghiem.dai_dien' => SORT_ASC ],
                        'desc' =>   [ 'phong_thi_nghiem.dai_dien' => SORT_DESC ],
                        'label' => 'dai_dien'
                    ],
                ],
                'defaultOrder' => [
                    'ten_tv' => SORT_ASC,
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
            'id_ptn' => $this->id_ptn,
            'dtpv_id' => $this->dtpv_id,
            'dien_thoai' => $this->dien_thoai,
            'fax' => $this->fax,
            'tien_si' => $this->tien_si,
            'thac_si' => $this->thac_si,
            'cu_nhan' => $this->cu_nhan,
            'ky_thuat' => $this->ky_thuat,
            'dien_tich' => $this->dien_tich,
            'gia_tri_uoc_tinh' => $this->gia_tri_uoc_tinh,
            'xac_nhan' => $this->xac_nhan,
        ]);

        $query->andFilterWhere(['like', 'upper(ten_tv)', mb_strtoupper($this->ten_tv)])
                ->andFilterWhere(['like', 'upper(ten_ta)', mb_strtoupper($this->ten_ta)])
                ->andFilterWhere(['like', 'upper(coquan_chuquan)', mb_strtoupper($this->coquan_chuquan)])
                ->andFilterWhere(['like', 'upper(dia_chi)', mb_strtoupper($this->dia_chi)])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'website', $this->website])
                ->andFilterWhere(['like', 'phu_trach', $this->phu_trach])
                ->andFilterWhere(['like', 'upper(dai_dien)', mb_strtoupper($this->dai_dien)])
                ->andFilterWhere(['like', 'gia_tri', $this->gia_tri_uoc_tinh])
                ->andFilterWhere(['like', 'dactrung_hoatdong', $this->dactrung_hoatdong])
                ->andFilterWhere(['like', 'dinh_huong', $this->dinh_huong])
                ->andFilterWhere(['like', 'ghi_chu', $this->ghi_chu])
                ->andFilterWhere(['like', 'geom', $this->geom]);

        return $dataProvider;
    }

}
