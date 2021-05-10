<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 4/29/2021
 * Time: 11:46 PM
 */

namespace app\modules\gisposts\controllers;


use app\modules\gisposts\base\AbstractController;
use app\modules\gisposts\models\posts\GisPosts;
use app\services\DebugService;
use yii\db\Connection;
use Yii;

class SiteController extends AbstractController
{
    public function actionIndex()
    {

        return $this->render('index');
    }

    public function actionGetdata($c = null)
    {
        if($c == 'duchm'){
            GisPosts::deleteAll();

            $db = new Connection([
                'dsn' => 'mysql:host=localhost;port=3306;dbname=portal',
                'username' => 'root',
                'password' => '@hcmgis#',
                'charset' => 'utf8',
            ]);

            $db->open();
            $posts = $db->createCommand("SELECT * FROM gis_posts where post_status = '1' order by post_date desc")
                ->queryAll();
            $db->close();

            foreach($posts as $i => $post){
                $newpost = new GisPosts();
                $newpost->post_title = $post['post_title'];
                $newpost->post_content = $post['post_content'];
                $newpost->post_author = $post['post_author'];
                $newpost->post_date = $post['post_date'];
                $newpost->post_date_gmt = $post['post_date_gmt'];
                $newpost->post_img = $post['post_img'];
                $newpost->post_status = $post['post_status'];
                $newpost->comment_status = $post['comment_status'];
                $newpost->ping_status = $post['ping_status'];
                $newpost->post_password = $post['post_password'];
                $newpost->post_name = $post['post_name'];
                $newpost->to_ping = $post['to_ping'];
                $newpost->pinged = $post['pinged'];
                $newpost->post_modified = $post['post_modified'];
                $newpost->post_modified_gmt = $post['post_modified_gmt'];
                $newpost->post_content_filtered = $post['post_content_filtered'];
                $newpost->post_parent = $post['post_parent'];
                $newpost->guid = $post['guid'];
                $newpost->menu_order = $post['menu_order'];
                $newpost->post_type = $post['post_type'];
                $newpost->post_mime_type = $post['post_mime_type'];
                $newpost->comment_count = $post['comment_count'];
                $newpost->save();
            }
            return 'done!';
        } else {
            return 'Not allowed!';
        }
    }
}