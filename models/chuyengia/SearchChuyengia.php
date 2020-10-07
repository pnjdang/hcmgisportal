<?php

namespace app\models\chuyengia;

use app\services\DebugService;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DschuyengiaSearch represents the model behind the search form about `app\models\VChuyengia`.
 */
class SearchChuyengia extends Chuyengia
{
    public $linh_vuc;
    public $chuyen_nganh;
    public $hoc_ham;
    public $hoc_vi;
    public $ten_congtrinh;
    public $loai_congtrinh;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loai_congtrinh', 'gioi_tinh', 'nam_sinh', 'hocham_id', 'hoc_ham', 'hoc_vi', 'nam_hocham', 'hocvi_id', 'nam_hocvi', 'chuyennganh_id', 'donvi_id', 'congbothongtin', 'status', 'created_by', 'updated_by', 'lvql_id', 'linh_vuc', 'chuyen_nganh'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['dinhhuong_hoatdong', 'dinhhuong_daotao', 'ten_congtrinh'], 'string'],
            [['ho_ten', 'ten_khongdau', 'congviec_hiennay', 'chucvu_hientai', 'diachi_nharieng', 'ghichu_chuyengia'], 'string', 'max' => 200],
            [['dien_thoai'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 100],
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

        $this->load($params);
        if($this->ten_congtrinh != null || $this->loai_congtrinh != null){
            $congtrinh = ChuyengiaCongtrinh::find()->select('chuyengia_congtrinh.chuyengia_id')->where(['like', 'upper(ten_congtrinh)', mb_strtoupper($this->ten_congtrinh)])->andWhere(($this->loai_congtrinh == null) ? '1=1' : 'loaicongtrinh_id = '.$this->loai_congtrinh)->groupBy('chuyengia_congtrinh.chuyengia_id');
            $query = $congtrinh->joinWith('chuyengia')
                ->joinWith('chuyengia.chuyengiaChuyennganhs')
                ->joinWith('chuyengia.chuyengiaLinhvucs')
                ->joinWith('chuyengia.hocvi')
                ->joinWith('chuyengia.hocham')
                ->joinWith('chuyengia.donvi');
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort' => [
//                    'defaultOrder' => [
//                        'ho_ten' => SORT_ASC,
//                    ]
                ]
            ]);


            if (!$this->validate()) {
                // uncomment the following line if you do not want to return any records when validation fails
                // $query->where('0=1');
                return $dataProvider;
            }

            $query->andFilterWhere([
                'chuyengia.id_chuyengia' => $this->id_chuyengia,
                'chuyengia.lvql_id' => $this->lvql_id,
                'chuyengia.donvi_id' => $this->donvi_id,
                'chuyengia.hocham_id' => $this->hoc_ham,
                'chuyengia.hocvi_id' => $this->hoc_vi,
                'chuyengia.nam_sinh' => $this->nam_sinh,
                'chuyengia.gioi_tinh' => $this->gioi_tinh,
                'chuyengia_linhvuc.cap1_id' => $this->linh_vuc,
                'chuyengia_chuyennganh.cap3_id' => $this->chuyen_nganh,
                'loaicongtrinh_id' => $this->loai_congtrinh,
            ]);

            $query
                ->andFilterWhere(['like', 'upper(ten_congtrinh)', mb_strtoupper($this->ten_congtrinh)])
                ->andFilterWhere(['like', 'upper(chuyengia.ho_ten)', mb_strtoupper($this->ho_ten)])
                ->andFilterWhere(['like', 'upper(chuyengia.ten_khongdau)', mb_strtoupper($this->ho_ten)])
                ->andFilterWhere(['like', 'upper(chuyengia.dien_thoai)', mb_strtoupper($this->dien_thoai)])
                ->andFilterWhere(['like', 'upper(chuyengia.email)', mb_strtoupper($this->email)]);
//        \app\services\DebugService::dumpdie($query->all());
            return $dataProvider;
        } else {
            $query = Chuyengia::find()
                ->joinWith('chuyengiaChuyennganhs')
                ->joinWith('chuyengiaLinhvucs')
                ->joinWith('donvi')
                ->joinWith('hocham')
                ->joinWith('hocvi')
                ->where(['chuyengia.status' => 1]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort' => [
                    'defaultOrder' => [
                        'ho_ten' => SORT_ASC,
                    ]
                ]
            ]);

            if (!$this->validate()) {
                // uncomment the following line if you do not want to return any records when validation fails
                // $query->where('0=1');
                return $dataProvider;
            }

            $query->andFilterWhere([
                'id_chuyengia' => $this->id_chuyengia,
                'lvql_id' => $this->lvql_id,
                'donvi_id' => $this->donvi_id,
                'hocham_id' => $this->hoc_ham,
                'hocvi_id' => $this->hoc_vi,
                'nam_sinh' => $this->nam_sinh,
                'gioi_tinh' => $this->gioi_tinh,
                'chuyengia_linhvuc.cap1_id' => $this->linh_vuc,
                'chuyengia_chuyennganh.cap3_id' => $this->chuyen_nganh,
//            'chuyengiaCongtrinhs.loaicongtrinh_id' => $this->loai_congtrinh,
            ]);

            $query
                ->andFilterWhere(['like', 'upper(ho_ten)', mb_strtoupper($this->ho_ten)])
                ->orFilterWhere(['like', 'upper(ten_khongdau)', mb_strtoupper($this->ho_ten)])
                ->andFilterWhere(['like', 'upper(dien_thoai)', mb_strtoupper($this->dien_thoai)])
                ->andFilterWhere(['like', 'upper(email)', mb_strtoupper($this->email)]);
//        \app\services\DebugService::dumpdie($query->all());
            return $dataProvider;
        }




    }
}