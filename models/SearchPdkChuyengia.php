<?php

namespace app\models;

use app\services\DebugService;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DschuyengiaSearch represents the model behind the search form about `app\models\VChuyengia`.
 */
class SearchPdkChuyengia extends Chuyengia
{
    public $linh_vuc;
    public $chuyen_nganh;
    public $hoc_ham;
    public $hoc_vi;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gioi_tinh', 'nam_sinh', 'hocham_id', 'hoc_ham', 'hoc_vi', 'nam_hocham', 'hocvi_id', 'nam_hocvi', 'chuyennganh_id', 'donvi_id', 'congbothongtin', 'status', 'created_by', 'updated_by', 'lvql_id', 'linh_vuc', 'chuyen_nganh'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['dinhhuong_hoatdong', 'dinhhuong_daotao'], 'string'],
            [['ho_ten', 'congviec_hiennay', 'chucvu_hientai', 'diachi_nharieng', 'ghichu_chuyengia'], 'string', 'max' => 200],
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
    public function search($params,$user_id = null)
    {
        $query = Chuyengia::find()
            ->joinWith('donvi')
            ->joinWith('hocham')
            ->joinWith('hocvi')
            ->joinWith('chuyengiaChuyennganhs')
            ->joinWith('chuyengiaLinhvucs')
            ->where(['chuyengia.status' => 2]);
        if($user_id != null){
            $query->andWhere(['chuyengia.created_by' => $user_id]);
        }
//        DebugService::dumpdie($query->all());

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'ho_ten' => SORT_ASC,
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
            'id_chuyengia' => $this->id_chuyengia,
            'lvql_id' => $this->lvql_id,
            'donvi_id' => $this->donvi_id,
            'hocham_id' => $this->hocham_id,
            'hocvi_id' => $this->hocvi_id,
            'nam_sinh' => $this->nam_sinh,
            'gioi_tinh' => $this->gioi_tinh,
            'chuyengia_linhvuc.cap1_id' => $this->linh_vuc,
            'chuyengia_chuyennganh.cap3_id' => $this->chuyen_nganh,
        ]);

        $query
            ->andFilterWhere(['like', 'upper(ho_ten)', mb_strtoupper($this->ho_ten)])
            ->andFilterWhere(['like', 'upper(dien_thoai)', mb_strtoupper($this->dien_thoai)])
            ->andFilterWhere(['like', 'upper(email)', mb_strtoupper($this->email)]);
//        \app\services\DebugService::dumpdie($query->all());
        return $dataProvider;
    }
}
