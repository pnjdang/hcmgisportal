<?php

namespace app\models\phongthinghiem;

use app\models\danhmuc\phongthinghiem\sohuutritue\KetquaShtt;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DschuyengiaSearch represents the model behind the search form about `app\models\VChuyengia`.
 */
class SearchPhongthinghiemSohuutritue extends PhongthinghiemSohuutritue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ptn_id', 'ketquashtt_id', 'nam', 'so_luong'], 'integer'],
            [['ghi_chu'], 'string', 'max' => 500],
            [['ketquashtt_id'], 'exist', 'skipOnError' => true, 'targetClass' => KetquaShtt::className(), 'targetAttribute' => ['ketquashtt_id' => 'id_ketquashtt']],
            [['ptn_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhongThiNghiem::className(), 'targetAttribute' => ['ptn_id' => 'id_ptn']],
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
    public function search($params, $ptn_id)
    {
        $query = PhongthinghiemSohuutritue::find()
            ->with('ketquashtt')
            ->where(['ptn_id' => $ptn_id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'nam' => SORT_ASC,
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
            'ptn_id' => $this->ptn_id,
            'ketquashtt_id' => $this->ketquashtt_id,
        ]);

        $query
            ->andFilterWhere(['like', 'upper(so_luong)', mb_strtoupper($this->so_luong)])
            ->andFilterWhere(['like', 'upper(nam)', mb_strtoupper($this->nam)])
            ->andFilterWhere(['like', 'upper(ghi_chu)', mb_strtoupper($this->ghi_chu)]);
        return $dataProvider;
    }
}
