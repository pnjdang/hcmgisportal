<?php

namespace app\modules\gisposts\models\media;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\gisposts\models\media\MainBanner;

/**
 * SearchMainBanner represents the model behind the search form about `app\modules\gisposts\models\media\MainBanner`.
 */
class SearchMainBanner extends MainBanner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['file_path', 'file_name', 'file_caption', 'file_description', 'uploaded_at', 'banner_position'], 'safe'],
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
        $query = MainBanner::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'uploaded_at' => $this->uploaded_at,
        ]);

        $query->andFilterWhere(['like', 'upper(file_path)', mb_strtoupper($this->file_path)])
            ->andFilterWhere(['like', 'upper(file_name)', mb_strtoupper($this->file_name)])
            ->andFilterWhere(['like', 'upper(file_caption)', mb_strtoupper($this->file_caption)])
            ->andFilterWhere(['like', 'upper(file_description)', mb_strtoupper($this->file_description)])
            ->andFilterWhere(['like', 'upper(banner_position)', mb_strtoupper($this->banner_position)]);

        return $dataProvider;
    }

    public function getExportColumns()
    {
        return [
            [
                'class' => 'kartik\grid\SerialColumn',
            ],
            'id',
        'file_path',
        'file_name',
        'file_caption',
        'file_description',
        'uploaded_at',
        'banner_position',        ];
    }
}
