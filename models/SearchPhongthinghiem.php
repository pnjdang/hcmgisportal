<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DschuyengiaSearch represents the model behind the search form about `app\models\VChuyengia`.
 */
class SearchPhongthinghiem extends PhongThiNghiem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dtpv_id', 'tien_si', 'thac_si', 'cu_nhan', 'ky_thuat', 'dien_tich', 'status', 'updated_by', 'created_by', 'taikhoan_id'], 'integer'],
            [['dactrung_hoatdong', 'dinh_huong', 'geom', 'ghichu_chungloai', 'ghichu_chatluong', 'ghichu_tieuchuan'], 'string'],
            [['xac_nhan'], 'boolean'],
            [['geo_x', 'geo_y'], 'number'],
            [['email'], 'email', 'message' => 'Email không đúng định dạng'],
            [['linhvucChecked', 'tieuchuanChecked', 'chatluongChecked', 'phanloaiChecked', 'hoivienChecked', 'chungloai','updated_at','created_at'], 'safe'],
            [['ten_tv', 'ten_ta', 'coquan_chuquan', 'dia_chi', 'email', 'website', 'phu_trach', 'dai_dien', 'ghi_chu', 'gia_tri_uoc_tinh'], 'string', 'max' => 100],
            [['dien_thoai', 'fax'], 'string', 'max' => 50],
            [['quan_huyen'], 'string', 'max' => 30],
            [['dtpv_id'], 'exist', 'skipOnError' => true, 'targetClass' => DoituongPhucvu::className(), 'targetAttribute' => ['dtpv_id' => 'id_dtpv']],
            [['taikhoan_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaiKhoan::className(), 'targetAttribute' => ['taikhoan_id' => 'id_taikhoan']],
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
    public function search($params, $user_id = null)
    {
        $query = PhongThiNghiem::find()
            ->with('phongthinghiemLinhvucs')
            ->with('phongthinghiemChungloais')
            ->where(['phong_thi_nghiem.status' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_ASC,
                ]
            ]
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
        ]);

        $query
            ->andFilterWhere(['like', 'upper(ten_tv)', mb_strtoupper($this->ten_tv)])
            ->andFilterWhere(['like', 'upper(ten_ta)', mb_strtoupper($this->ten_ta)])
            ->andFilterWhere(['like', 'upper(dai_dien)', mb_strtoupper($this->dai_dien)])
            ->andFilterWhere(['like', 'upper(coquan_chuquan)', mb_strtoupper($this->coquan_chuquan)])
            ->andFilterWhere(['like', 'upper(dien_thoai)', mb_strtoupper($this->dien_thoai)])
            ->andFilterWhere(['like', 'upper(email)', mb_strtoupper($this->email)]);
//        \app\services\DebugService::dumpdie($query->all());
        return $dataProvider;
    }
}
