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
class SearchChuyengiaDetai extends ChuyengiaDetai
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chuyengia_id', 'nam_batdau', 'nam_ketthuc', 'tinh_trang', 'vai_tro'], 'integer'],
            [['ten_detai', 'chuong_trinh', 'noi_dung'], 'string', 'max' => 500],
            [['xep_loai'], 'string', 'max' => 100],
            [['chuyengia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chuyengia::className(), 'targetAttribute' => ['chuyengia_id' => 'id_chuyengia']],
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
        $query = ChuyengiaDetai::find()->where(['chuyengia_id' => $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
//            'sort' => [
//
//
//
//            ],
        ]);

        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'nam_batdau' => $this->nam_batdau,
            'nam_ketthuc' => $this->nam_ketthuc,
            'tinh_trang' => $this->tinh_trang,
            'vai_tro' => $this->vai_tro,
        ]);

        $query
            ->andFilterWhere(['like', 'upper(ten_detai)', mb_strtoupper($this->ten_detai)])
            ->andFilterWhere(['like', 'upper(chuong_trinh)', mb_strtoupper($this->chuong_trinh)])
            ->andFilterWhere(['like', 'upper(xep_loai)', mb_strtoupper($this->xep_loai)])
            ->andFilterWhere(['like', 'upper(noi_dung)', mb_strtoupper($this->noi_dung)]);
        return $dataProvider;
    }
}
