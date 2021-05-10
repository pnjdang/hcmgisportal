<?php

namespace app\modules\gisposts\models\posts;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\gisposts\models\posts\GisPosts;

/**
 * SearchGisPosts represents the model behind the search form about `app\modules\gisposts\models\posts\GisPosts`.
 */
class SearchProducts extends GisPosts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'post_author', 'post_parent', 'menu_order', 'comment_count'], 'integer'],
            [['post_date', 'post_date_gmt', 'post_content', 'post_title', 'post_img', 'post_password', 'post_name', 'to_ping', 'pinged', 'post_modified', 'post_modified_gmt', 'post_content_filtered', 'guid', 'post_type', 'post_mime_type', 'post_status', 'comment_status', 'ping_status'], 'safe'],
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
        $query = GisPosts::find()->where(['post_type' => 'product']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'post_date' => SORT_DESC
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
            'id' => $this->id,
            'post_author' => $this->post_author,
            'post_date' => $this->post_date,
            'post_date_gmt' => $this->post_date_gmt,
            'post_modified' => $this->post_modified,
            'post_modified_gmt' => $this->post_modified_gmt,
            'post_parent' => $this->post_parent,
            'menu_order' => $this->menu_order,
            'comment_count' => $this->comment_count,
        ]);

        $query->andFilterWhere(['like', 'upper(post_content)', mb_strtoupper($this->post_content)])
            ->andFilterWhere(['like', 'upper(post_title)', mb_strtoupper($this->post_title)])
            ->andFilterWhere(['like', 'upper(post_img)', mb_strtoupper($this->post_img)])
            ->andFilterWhere(['like', 'upper(post_password)', mb_strtoupper($this->post_password)])
            ->andFilterWhere(['like', 'upper(post_name)', mb_strtoupper($this->post_name)])
            ->andFilterWhere(['like', 'upper(to_ping)', mb_strtoupper($this->to_ping)])
            ->andFilterWhere(['like', 'upper(pinged)', mb_strtoupper($this->pinged)])
            ->andFilterWhere(['like', 'upper(post_content_filtered)', mb_strtoupper($this->post_content_filtered)])
            ->andFilterWhere(['like', 'upper(guid)', mb_strtoupper($this->guid)])
            ->andFilterWhere(['like', 'upper(post_mime_type)', mb_strtoupper($this->post_mime_type)])
            ->andFilterWhere(['like', 'upper(post_status)', mb_strtoupper($this->post_status)])
            ->andFilterWhere(['like', 'upper(comment_status)', mb_strtoupper($this->comment_status)])
            ->andFilterWhere(['like', 'upper(ping_status)', mb_strtoupper($this->ping_status)]);

        return $dataProvider;
    }

    public function getExportColumns()
    {
        return [
            [
                'class' => 'kartik\grid\SerialColumn',
            ],
            'id',
        'post_author',
        'post_date',
        'post_date_gmt',
        'post_content',
        'post_title',
        'post_img',
        'post_password',
        'post_name',
        'to_ping',
        'pinged',
        'post_modified',
        'post_modified_gmt',
        'post_content_filtered',
        'post_parent',
        'guid',
        'menu_order',
        'post_type',
        'post_mime_type',
        'comment_count',
        'post_status',
        'comment_status',
        'ping_status',        ];
    }
}
