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
class SearchPhongthinghiem extends PhongThiNghiem {

    /**
     * @inheritdoc
     */
    public $thietbi_id;
    public $pl_id;
    public $lvtn_id;
    public function rules() {
        return [
            [['id_ptn','pl_id','lvtn_id','thietbi_id', 'dtpv_id', 'dien_thoai', 'fax', 'tien_si', 'thac_si', 'cu_nhan', 'ky_thuat', 'dien_tich'], 'integer'],
            [['ten_tv', 'ten_ta', 'ten_khongdau','coquan_chuquan', 'dia_chi', 'email', 'website', 'phu_trach', 'dai_dien', 'dactrung_hoatdong', 'dinh_huong', 'ghi_chu', 'gia_tri_uoc_tinh', 'geom'], 'safe'],
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
    public function search($params) {

        $query = PhongThiNghiem::find()->where(['phong_thi_nghiem.status' => 1]);

//        if($ptnsearch->thietbi_id != null && is_numeric($ptnsearch->thietbi_id)){
//            $query->joinWith('thietbithunghiems',true,'FULL JOIN')->andWhere('thietbithunghiem.thietbi_id = '.$ptnsearch->thietbi_id);
//        }
//        if($ptnsearch->lvtn_id != null && is_numeric($ptnsearch->lvtn_id)){
//            $query->joinWith('phongthinghiemLinhvucs',true,'FULL JOIN')->andWhere('phongthinghiem_linhvuc.lv_id = '.$ptnsearch->lvtn_id);
//        }
//        if($ptnsearch->pl_id != null && is_numeric($ptnsearch->pl_id)){
//            $query->joinWith('phongthinghiemChungloais',true,'FULL JOIN')->andWhere('phongthinghiem_chungloai.pl_id = '.$ptnsearch->pl_id);
//        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);
        $this->load($params);

        if($this->pl_id != null && is_numeric($this->pl_id)){
            $query->joinWith('phongthinghiemChungloais',true,'FULL JOIN')->andWhere('phongthinghiem_chungloai.pl_id = '.$this->pl_id);
        }
        if($this->lvtn_id != null && is_numeric($this->lvtn_id)){
            $query->joinWith('phongthinghiemLinhvucs',true,'FULL JOIN')->andWhere('phongthinghiem_linhvuc.lv_id = '.$this->lvtn_id);
        }
        if($this->thietbi_id != null && is_numeric($this->thietbi_id)){
            $query->joinWith('phongthinghiemThietbis',true,'FULL JOIN')->andWhere('phongthinghiem_thietbi.thietbi_id = '.$this->thietbi_id);
        }
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
//                ->orFilterWhere(['like', 'upper(ten_khongdau)', mb_strtoupper($this->ten_tv)])
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
