<?php

namespace app\modules\quanly\models\ho;

use app\services\DebugService;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "search_model".
 *
 * @property string $nguoi_thue
 * @property string $so_nha
 * @property string $ten_duong
 * @property string $ma_phuong
 * @property integer $id_loainha
 * @property integer $thoi_han_thue
 * @property string $thoigian_thanhly
 * @property string $thoigian_capnha
 *
 */
class SearchHo extends ThongTinHo
{
    public $so_nha;
    public $ten_duong;
    public $ma_phuong;
    public $id_loainha;
    public $thoigian_thanhly;
    public $thoigian_capnha;

    public function rules()
    {
        return [
            [['id_loainha'], 'integer'],
            [['so_nha','ten_duong', 'ma_phuong','thoigian_thanhly','thoigian_capnha'], 'string', 'max' => 200],
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
        $query = ThongTinHo::find()->joinWith('thongtincan')->joinWith('thongtincan.phuong')->where(['thong_tin_ho.thanh_ly' => 0,'thong_tin_ho.da_ban' => false]);
//        DebugService::dumpdie($query->count())

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
            'sort' => [
                'attributes' => [
                    'stt' => [
                        'asc' =>    [ 'ranh_phuong.stt' => SORT_ASC ],
                        'desc' =>   [ 'ranh_phuong.stt' => SORT_DESC ],
                        'label' => 'stt'
                    ],
                    'ma_phuong' => [
                        'asc' =>    [ 'thong_tin_can.ma_phuong' => SORT_ASC ],
                        'desc' =>   [ 'thong_tin_can.ma_phuong' => SORT_DESC ],
                        'label' => 'Mã phường'
                    ],
                    'so_nha' => [
                        'asc' =>    [ 'thong_tin_can.so_nha' => SORT_ASC ],
                        'desc' =>   [ 'thong_tin_can.so_nha' => SORT_DESC ],
                        'label' => 'Số nhà'
                    ],
                    'ten_duong' => [
                        'asc' =>    [ 'thong_tin_can.ten_duong' => SORT_ASC ],
                        'desc' =>   [ 'thong_tin_can.ten_duong' => SORT_DESC ],
                        'label' => 'Tên đường'
                    ],
                    'id_loainha' => [
                        'asc' =>    [ 'thong_tin_can.id_loainha' => SORT_ASC ],
                        'desc' =>   [ 'thong_tin_can.id_loainha' => SORT_DESC ],
                        'label' => 'Loại nhà'
                    ],
                    'stt_can' => [
                        'asc' =>    [ 'thong_tin_can.stt_can' => SORT_ASC ],
                        'desc' =>   [ 'thong_tin_can.stt_can' => SORT_DESC ],
                        'label' => 'Loại nhà'
                    ],
                    'dien_tich_su_dung',
                    'nguoi_thue',
                    'cap_nha',
                    'quyetdinh_capnha',
                    'ngay_capnha',
                ],
                'defaultOrder' => [
                    'stt' => SORT_ASC,
                    'id_loainha' => SORT_ASC,
                    'stt_can' => SORT_ASC,

                ]


            ],
        ]);

        $this->load($params);
//        DebugService::dumpdie($this);
//        DebugService::dumpdie($params);
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
            'thong_tin_can.ma_phuong' => $this->ma_phuong,
            'thong_tin_can.id_loainha' => $this->id_loainha,
        ]);

        $query->andFilterWhere(['like', 'upper(thong_tin_can.so_nha)', mb_strtoupper($this->so_nha)])
            ->andFilterWhere(['like', 'upper(thong_tin_can.ten_duong)', mb_strtoupper($this->ten_duong)]);
        if($this->thoigian_capnha != null){
            $tg_capnha = explode(' --- ',$this->thoigian_capnha);
            $from = date('Y-m-d',strtotime(str_replace('/','-',$tg_capnha[0])));
            $to = date('Y-m-d',strtotime(str_replace('/','-',$tg_capnha[1])));
            $query->andFilterWhere((['between', 'ngay_capnha', $from, $to]));
        }
        return $dataProvider;
    }
}
