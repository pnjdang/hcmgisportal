<?php

namespace app\modules\quanly\models\hopdong;

use app\services\DebugService;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


class ThongbaoHopdongSaphethan extends VThongbaoSaphethan
{

    public $so_nha;
    public $ten_duong;
    public $ma_phuong;
    public $loainha;

    public function rules()
    {
        return [
            [['id_hopdong', 'thoi_han_thue', 'id_ho', 'id_can', 'stt'], 'integer'],
            [['ngay_het_han'], 'safe'],
            [['fulldiachi'], 'string'],
            [['so_hop_dong', 'nguoi_thue', 'so_nha', 'ten_duong'], 'string', 'max' => 100],
            [['ma_phuong'], 'string', 'max' => 50],
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
        $query = VThongbaoSaphethan::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
            'sort' => [
                'attributes' => [
                    'ngay_het_han',
                    'stt',
                    'so_nha'
                ],
                'defaultOrder' => [
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
            'thoi_han_thue' => $this->thoi_han_thue,
        ]);

        $query->andFilterWhere(['like', 'upper(fulldiachi)', mb_strtoupper($this->fulldiachi)])
            ->andFilterWhere(['like', 'upper(so_hop_dong)', mb_strtoupper($this->so_hop_dong)])
            ->andFilterWhere(['like', 'upper(nguoi_thue)', mb_strtoupper($this->nguoi_thue)]);


        return $dataProvider;
    }

    public function getExportColumns()
    {
        return [
            [
                'class' => 'kartik\grid\SerialColumn',
            ],
            'fulldiachi',
            'so_hop_dong',
            'nguoi_thue',
            [
                'attribute' => 'thoi_han_thue',
                'value' => function($model){
                    return $model->thoi_han_thue . ' tháng';
                }
            ],
            'ngay_het_han',
        ];
    }
}
