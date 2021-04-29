<?php

namespace app\modules\quanly\models\hopdong;

use app\services\DebugService;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


class SearchHopdonghethan extends VHopdonghethan
{

    public $thoigian;

    public static function searchModelName()
    {
        return 'SearchHopdonghethan';
    }

    public function rules()
    {
        return [
            [['id_ho', 'id_can', 'stt_ho', 'id_loainha', 'stt', 'stt_can', 'id_hopdong', 'gia_thue', 'gia_giam', 'gia_phai_tra', 'thoi_han_thue', 'ngung_thu', 'trang_thai', 'thanh_ly', 'status'], 'integer'],
            [['dien_tich_su_dung', 'dien_tich_khuon_vien'], 'number'],
            [['ngay_hop_dong', 'ngay_bat_dau', 'ngay_giao_nhan', 'ngay_ki', 'ngay_cap', 'ngay_het_han'], 'safe'],
            [['geom','thoigian'], 'string'],
            [['cap_nha', 'tenquan', 'cmnd', 'dien_thoai'], 'string', 'max' => 20],
            [['hop_dong_hien_tai', 'vi_tri', 'so_nha', 'ten_duong', 'so_hop_dong', 'nguoi_thue', 'noi_cap'], 'string', 'max' => 100],
            [['thoi_han'], 'string', 'max' => 10],
            [['ma_phuong', 'tenphuong'], 'string', 'max' => 50],
            [['ten_loainha', 'thuong_tru', 'dia_chi_lien_he'], 'string', 'max' => 200],
            [['ly_do_giam', 'ghi_chu'], 'string', 'max' => 500],
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
        $query = VHopdonghethan::find()->where(['status' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
            'sort' => [
                'defaultOrder' => [
                    'ngay_het_han' => SORT_ASC
                ],
//                'attributes' => [
//                    'thoigian' => [
//
//                    ]
//                ]
            ]

        ]);
        $this->load($params);
//        DebugService::dumpdie($this);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'status' => $this->status,
            'thoi_han_thue' => $this->thoi_han_thue,
            'id_loainha' => $this->id_loainha,
        ]);

        $query->andFilterWhere(['like', 'upper(so_nha)', mb_strtoupper($this->so_nha)])
            ->andFilterWhere(['like', 'upper(so_hop_dong)', mb_strtoupper($this->so_hop_dong)])
            ->andFilterWhere(['like', 'upper(nguoi_thue)', mb_strtoupper($this->nguoi_thue)])
            ->andFilterWhere(['like', 'ma_phuong', mb_strtoupper($this->ma_phuong)])
            ->andFilterWhere(['like', 'upper(ten_duong)', mb_strtoupper($this->ten_duong)]);

        if($this->thoigian != null) {
            list($start_date, $end_date) = explode(' - ', $this->thoigian);
            $query->andFilterWhere(['between', 'ngay_het_han', ($start_date), ($end_date)]);
        }

        return $dataProvider;
    }
}
