<?php

namespace app\modules\quanly\models\can;


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
 *
 */
class SearchCan extends ThongTinCan
{

    public function rules()
    {
        return [
            [['id_loainha'], 'integer'],
            [['so_nha', 'ten_duong', 'ma_phuong'], 'string', 'max' => 200],
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
        $query = ThongTinCan::find()->joinWith('phuong')->where(['thong_tin_can.status' => 1])
            ->andWhere(['thong_tin_can.da_ban' => false])
            ->andWhere(['thong_tin_can.chuyen_giao' => false]);

        $search['dataProvider'] = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],

            'sort' => [
                'attributes' => [
                    'stt' => [
                        'asc' => ['ranh_phuong.stt' => SORT_ASC],
                        'desc' => ['ranh_phuong.stt' => SORT_DESC],
                        'label' => 'stt'
                    ],
                    'ma_phuong',
                    'id_loainha',
                    'so_nha',
                    'ten_duong',
                    'dien_tich_khuon_vien',
                    'stt_can'
                ],
                'defaultOrder' => [
                    'stt' => SORT_ASC,
                    'id_loainha' => SORT_ASC,
                    'stt_can' => SORT_ASC,

                ]


            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $search['dataProvider'];
        }

        $query->andFilterWhere([
            'status' => $this->status,
            'id_loainha' => $this->id_loainha,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'ma_phuong' => $this->ma_phuong,
        ]);

        $query->andFilterWhere(['like', 'upper(so_nha)', mb_strtoupper($this->so_nha)])
            ->andFilterWhere(['like', 'upper(ten_duong)', mb_strtoupper($this->ten_duong)]);

        if ($this->id_loainha == null) {
            $search['total'][1] = $this->countNha(ThongTinCan::find()->joinWith('phuong')->orderBy('stt')->where(['thong_tin_can.status' => 1]), 1);
            $search['total'][2] = $this->countNha(ThongTinCan::find()->joinWith('phuong')->orderBy('stt')->where(['thong_tin_can.status' => 1]), 2);
            $search['total'][3] = $this->countNha(ThongTinCan::find()->joinWith('phuong')->orderBy('stt')->where(['thong_tin_can.status' => 1]), 3);
            $search['total'][4] = $this->countNha(ThongTinCan::find()->joinWith('phuong')->orderBy('stt')->where(['thong_tin_can.status' => 1]), 4);
            $search['total'][5] = $this->countNha(ThongTinCan::find()->joinWith('phuong')->orderBy('stt')->where(['thong_tin_can.status' => 1]), 5);
        } else {
            $search['total'][$this->id_loainha] = $this->countNha(ThongTinCan::find()->joinWith('phuong')->orderBy('stt')->where(['thong_tin_can.status' => 1]), $this->id_loainha);
        }
        return $search;
    }

    public function countNha($query, $id_loainha)
    {

        $query->andFilterWhere(['like', 'upper(so_nha)', mb_strtoupper($this->so_nha)])
            ->andFilterWhere(['like', 'upper(ten_duong)', mb_strtoupper($this->ten_duong)]);
        $query->andWhere(['thong_tin_can.da_ban' => false])
            ->andWhere(['thong_tin_can.chuyen_giao' => false]);
        $query->andFilterWhere([
            'status' => $this->status,
            'id_loainha' => $id_loainha,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'ma_phuong' => $this->ma_phuong,
        ]);
        return $query->count();

    }

    public function getExportColumns()
    {
        return [
            [
                'class' => 'kartik\grid\SerialColumn',
            ],
            'id',
            'question',];
    }
}
