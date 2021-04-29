<?php

namespace app\modules\quanly\models\hopdong;

use app\services\DebugService;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


class SearchHopdongThanhly extends HopDong
{

    public $so_nha;
    public $ten_duong;
    public $ma_phuong;
    public $loainha;

    public function rules()
    {
        return [
            [['so_hop_dong','ten_duong', 'ma_phuong','so_nha','nguoi_thue'], 'string', 'max' => 200],
            [['thoi_han_thue','loainha'], 'integer'],
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
        $query = HopDong::find()->joinWith('thongtinho')->joinWith('thongtinho.thongtincan')->joinWith('thongtinho.thongtincan.phuong')->where(['hop_dong.thanh_ly' => 1,'hop_dong.status' => 1]);
//        DebugService::dumpdie($query->one());

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
            'sort' => [
                'attributes' => [
                    'ngay_het_han',
                    'stt' => [
                        'asc' =>    [ 'ranh_phuong.stt' => SORT_ASC ],
                        'desc' =>   [ 'ranh_phuong.stt' => SORT_DESC ],
                        'label' => 'stt'
                    ],
                    'stt_can' => [
                        'asc' =>    [ 'thong_tin_can.stt_can' => SORT_ASC ],
                        'desc' =>   [ 'thong_tin_can.stt_can' => SORT_DESC ],
                        'label' => 'stt'
                    ],
                    'so_nha' => [
                        'asc' =>    [ 'thong_tin_can.so_nha' => SORT_ASC ],
                        'desc' =>   [ 'thong_tin_can.so_nha' => SORT_DESC ],
                        'label' => 'stt'
                    ],
                ],
                'defaultOrder' => [
                    'stt' => SORT_ASC,
                    'stt_can' => SORT_ASC,
                    'so_nha' => SORT_ASC,
                    'ngay_het_han' => SORT_ASC,
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
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'thoi_han_thue' => $this->thoi_han_thue,
            'thong_tin_can.id_loainha' => $this->loainha,
        ]);

        $query->andFilterWhere(['like', 'upper(so_nha)', mb_strtoupper($this->so_nha)])
            ->andFilterWhere(['like', 'upper(so_hop_dong)', mb_strtoupper($this->so_hop_dong)])
            ->andFilterWhere(['like', 'upper(hop_dong.nguoi_thue)', mb_strtoupper($this->nguoi_thue)])
            ->andFilterWhere(['like', 'ma_phuong', mb_strtoupper($this->ma_phuong)])
            ->andFilterWhere(['like', 'upper(ten_duong)', mb_strtoupper($this->ten_duong)]);


        $search['total']['hethan'] = VHopdonghethan::find()->where(['status' => 1,'thanh_ly' => 1])
        ->andWhere(($this->ma_phuong != null) ? "ma_phuong = '" .$this->ma_phuong."'" : '1=1')
        ->andWhere(($this->so_nha != null) ? "upper(so_nha) = '" .mb_strtoupper($this->so_nha)."'" : '1=1')
        ->andWhere(($this->so_hop_dong != null) ? "upper(so_hop_dong) like '%" .mb_strtoupper($this->so_hop_dong)."%'" : '1=1')
        ->andWhere(($this->nguoi_thue != null) ? "upper(nguoi_thue) like '%" .mb_strtoupper($this->nguoi_thue)."%'" : '1=1')
        ->andWhere(($this->ten_duong != null) ? "upper(ten_duong) = '" .mb_strtoupper($this->ten_duong)."'" : '1=1')
        ->count();
        $search['total']['saphethan'] = VHopdongsaphethan::find()->where(['status' => 1,'thanh_ly' => 1])
            ->andWhere(($this->ma_phuong != null) ? "ma_phuong = '" .$this->ma_phuong."'" : '1=1')
            ->andWhere(($this->so_nha != null) ? "upper(so_nha) = '" .mb_strtoupper($this->so_nha)."'" : '1=1')
            ->andWhere(($this->so_hop_dong != null) ? "upper(so_hop_dong) like '%" .mb_strtoupper($this->so_hop_dong)."%'" : '1=1')
            ->andWhere(($this->nguoi_thue != null) ? "upper(nguoi_thue) like '%" .mb_strtoupper($this->nguoi_thue)."%'" : '1=1')
            ->andWhere(($this->ten_duong != null) ? "upper(ten_duong) = '" .mb_strtoupper($this->ten_duong)."'" : '1=1')
            ->count();
        $search['total']['khongco'] = VHopdongkhongco::find()->where(['status' => 1,'thanh_ly' => 1])
            ->andWhere(($this->ma_phuong != null) ? "ma_phuong = '" .$this->ma_phuong."'" : '1=1')
            ->andWhere(($this->so_nha != null) ? "upper(so_nha) = '" .mb_strtoupper($this->so_nha)."'" : '1=1')
            ->andWhere(($this->so_hop_dong != null) ? "upper(so_hop_dong) like '%" .mb_strtoupper($this->so_hop_dong)."%'" : '1=1')
            ->andWhere(($this->nguoi_thue != null) ? "upper(nguoi_thue) like '%" .mb_strtoupper($this->nguoi_thue)."%'" : '1=1')
            ->andWhere(($this->ten_duong != null) ? "upper(ten_duong) = '" .mb_strtoupper($this->ten_duong)."'" : '1=1')
            ->count();
        $search['total']['chuanhap'] = VHopdongchuanhap::find()->where(['status' => 1,'thanh_ly' => 1])
            ->andWhere(($this->ma_phuong != null) ? "ma_phuong = '" .$this->ma_phuong."'" : '1=1')
            ->andWhere(($this->so_nha != null) ? "upper(so_nha) = '" .mb_strtoupper($this->so_nha)."'" : '1=1')
            ->andWhere(($this->so_hop_dong != null) ? "upper(so_hop_dong) like '%" .mb_strtoupper($this->so_hop_dong)."%'" : '1=1')
            ->andWhere(($this->nguoi_thue != null) ? "upper(nguoi_thue) like '%" .mb_strtoupper($this->nguoi_thue)."%'" : '1=1')
            ->andWhere(($this->ten_duong != null) ? "upper(ten_duong) = '" .mb_strtoupper($this->ten_duong)."'" : '1=1')
            ->count();
        $search['total']['conhan'] = VHopdongconhan::find()->where(['status' => 1,'thanh_ly' => 1])
            ->andWhere(($this->ma_phuong != null) ? "ma_phuong = '" .$this->ma_phuong."'" : '1=1')
            ->andWhere(($this->so_nha != null) ? "upper(so_nha) = '" .mb_strtoupper($this->so_nha)."'" : '1=1')
            ->andWhere(($this->so_hop_dong != null) ? "upper(so_hop_dong) like '%" .mb_strtoupper($this->so_hop_dong)."%'" : '1=1')
            ->andWhere(($this->nguoi_thue != null) ? "upper(nguoi_thue) like '%" .mb_strtoupper($this->nguoi_thue)."%'" : '1=1')
            ->andWhere(($this->ten_duong != null) ? "upper(ten_duong) = '" .mb_strtoupper($this->ten_duong)."'" : '1=1')
            ->count();

        $search['dataProvider'] = $dataProvider;
        return $search;
    }
}
