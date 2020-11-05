<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gis_posts".
 *
 * @property int $ID
 * @property int $post_author
 * @property string|null $post_date
 * @property string|null $post_date_gmt
 * @property string $post_content
 * @property string $post_title
 * @property string $post_img
 * @property string $post_status
 * @property string $comment_status
 * @property string $ping_status
 * @property string $post_password
 * @property string $post_name
 * @property string $to_ping
 * @property string $pinged
 * @property string|null $post_modified
 * @property string|null $post_modified_gmt
 * @property string $post_content_filtered
 * @property int $post_parent
 * @property string $guid
 * @property int $menu_order
 * @property string $post_type
 * @property string $post_mime_type
 * @property int $comment_count
 */
class GisPosts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gis_posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_author', 'post_parent', 'menu_order', 'comment_count'], 'integer'],
            [['post_date', 'post_date_gmt', 'post_modified', 'post_modified_gmt'], 'safe'],
            //[['post_content', 'post_title', 'post_img', 'to_ping', 'pinged', 'post_content_filtered'], 'required'],
            [['post_content', 'post_title', 'post_img', 'to_ping', 'pinged', 'post_content_filtered'], 'string'],
            [['post_status', 'comment_status', 'ping_status', 'post_type'], 'string', 'max' => 20],
            [['post_password', 'guid'], 'string', 'max' => 255],
            [['post_name'], 'string', 'max' => 200],
            [['post_mime_type'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'post_author' => 'Tác giả',
            'post_date' => 'Thời gian đăng bài',
            'post_date_gmt' => 'Thời gian đăng Gmt',
            'post_content' => 'Nội dung',
            'post_title' => 'Tiêu đề',
            'post_img' => 'Hình ảnh',
            'post_status' => 'Trạng thái',
            'comment_status' => 'Comment Status',
            'ping_status' => 'Hình ảnh trong bài viết',
            'post_password' => 'Post Password',
            'post_name' => 'Alias',
            'to_ping' => 'To Ping',
            'pinged' => 'Pinged',
            'post_modified' => 'Thời gian chỉnh sửa',
            'post_modified_gmt' => 'Thời gian chỉnh sửa Gmt',
            'post_content_filtered' => 'Nội dung rút gọn',
            'post_parent' => 'Post Parent',
            'guid' => 'Link bài viết',
            'menu_order' => 'Thứ tự',
            'post_type' => 'Danh mục',
            'post_mime_type' => 'Post Mime Type',
            'comment_count' => 'Comment Count',
        ];
    }
}
