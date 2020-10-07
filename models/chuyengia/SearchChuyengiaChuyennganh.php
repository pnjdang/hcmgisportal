<?php

namespace app\models\chuyengia;

use app\services\DebugService;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VChuyengia;

/**
 * DschuyengiaSearch represents the model behind the search form about `app\models\VChuyengia`.
 */
class SearchChuyengiaChuyennganh extends Chuyengia
{
    public $ten_donvi;
    public $ten_hh;
    public $ten_hv;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gioi_tinh', 'nam_sinh', 'hocham_id', 'nam_hocham', 'hocvi_id', 'nam_hocvi', 'chuyennganh_id', 'donvi_id', 'congbothongtin', 'status', 'created_by', 'updated_by', 'lvql_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['dinhhuong_hoatdong', 'dinhhuong_daotao','ten_donvi','ten_hh','ten_hv'], 'string'],
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
    public function search($params,$id)
    {
        $query = Chuyengia::find()->joinWith(['chuyengiaChuyennganhs','donvi','hocham','hocvi'])->where(['cap3_id' => $id,'chuyengia.status' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
            'sort' => [
                'attributes' => [
                    'ho_ten',
                    'nam_sinh',
                    'gioi_tinh',
                    'diachi_nharieng',
                    'ten_donvi' => [
                        'asc' =>    [ 'don_vi.ten_donvi' => SORT_ASC ],
                        'desc' =>   [ 'don_vi.ten_donvi' => SORT_DESC ],
                        'label' => 'ten_donvi'
                    ],
                    'ten_hh' => [
                        'asc' =>    [ 'hoc_ham.ten_hh' => SORT_ASC ],
                        'desc' =>   [ 'hoc_ham.ten_hh' => SORT_DESC ],
                        'label' => 'ten_hh'
                    ],
                    'ten_hv' => [
                        'asc' =>    [ 'hoc_vi.ten_hv' => SORT_ASC ],
                        'desc' =>   [ 'hoc_vi.ten_hv' => SORT_DESC ],
                        'label' => 'ten_hv'
                    ],
                ],
                'defaultOrder' => [
                    'ho_ten' => SORT_ASC,
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
            'id_chuyengia' => $this->id_chuyengia,
            'lvql_id' => $this->lvql_id,
            'nam_sinh' => $this->nam_sinh,
            'gioi_tinh' => $this->gioi_tinh,
        ]);

        $query
            ->andFilterWhere(['like', 'upper(ho_ten)', mb_strtoupper($this->ho_ten)])
            ->andFilterWhere(['like', 'upper(don_vi.ten_donvi)', mb_strtoupper($this->ten_donvi)])
            ->andFilterWhere(['like', 'upper(hoc_ham.ten_hh)', mb_strtoupper($this->ten_hh)])
            ->andFilterWhere(['like', 'upper(hoc_vi.ten_hv)', mb_strtoupper($this->ten_hv)])
            ->andFilterWhere(['like', 'upper(dien_thoai)', mb_strtoupper($this->dien_thoai)])
            ->andFilterWhere(['like', 'upper(email)', mb_strtoupper($this->email)]);
        //\app\services\DebugService::dumpdie($dataProvider);
        return $dataProvider;
    }
}
