<?php

namespace app\modules\quanly\models\hopdong;

use app\services\DebugService;
use Yii;

/**
 * This is the model class for table "gia_han".
 *
 * @property integer $id_giahan
 * @property integer $id_hopdong
 * @property integer $thoi_han_thue
 * @property string $ngay_gia_han
 * @property string $ngay_bat_dau
 * @property integer $gia_thue
 * @property integer $gia_giam
 * @property integer $gia_tra
 * @property string $ghi_chu
 * @property string $nguoi_gia_han
 * @property string $cmnd
 */
class GiaHan extends \yii\db\ActiveRecord
{
    public $giathue;
    public $giagiam;
    public $giaphaitra;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gia_han';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_hopdong', 'thoi_han_thue', 'gia_thue', 'gia_giam', 'gia_tra'], 'integer'],
            [['ngay_gia_han', 'ngay_bat_dau', 'giathue', 'giagiam', 'giaphaitra'], 'safe'],
            [['ghi_chu'], 'string', 'max' => 200],
            [['nguoi_gia_han'], 'string', 'max' => 100],
            [['cmnd'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_giahan' => 'Id Giahan',
            'id_hopdong' => 'Id Hopdong',
            'thoi_han_thue' => 'Thoi Han Thue',
            'ngay_gia_han' => 'Ngay Gia Han',
            'ngay_bat_dau' => 'Ngay Bat Dau',
            'gia_thue' => 'Gia Thue',
            'gia_giam' => 'Gia Giam',
            'gia_tra' => 'Gia Tra',
            'ghi_chu' => 'Ghi Chu',
            'nguoi_gia_han' => 'Nguoi Gia Han',
            'cmnd' => 'Cmnd',
        ];
    }

    public function afterFind()
    {
        $this->giathue = $this->gia_thue;
        $this->giagiam = $this->gia_giam;
        $this->giaphaitra = $this->gia_tra;

        if ($this->ngay_gia_han != null) {
            $this->ngay_gia_han = date('d/m/Y', strtotime($this->ngay_gia_han));
        }
    }

    public function saveModel($hopdong)
    {
        $this->gia_thue = str_replace(',', '', $this->giathue);
        $this->gia_giam = str_replace(',', '', $this->giagiam);
        $this->gia_tra = str_replace(',', '', $this->giaphaitra);

        if ($this->ngay_gia_han != null) {
            $this->ngay_gia_han = date('Y-m-d', strtotime(str_replace('/', '-', $this->ngay_gia_han)));
        }

        if ($this->validate()) {
            if($this->isNewRecord){
                $this->save();
                $ngayhethan = date('Y-m-d',strtotime(str_replace('/','-',$hopdong->ngay_het_han)));
                $hopdong->ngay_het_han = date('Y-m-d', strtotime("+$this->thoi_han_thue months", strtotime($ngayhethan)));
                $hopdong->saveModel();
            } else {
                $thoihanthue_old = $this->oldAttributes['thoi_han_thue'];
                $ngayhethan = date('Y-m-d',strtotime(str_replace('/','-',$hopdong->ngay_het_han)));
                $hopdong->ngay_het_han = date('Y-m-d', strtotime("-$thoihanthue_old months", strtotime($ngayhethan)));
                $hopdong->ngay_het_han = date('Y-m-d', strtotime("+$this->thoi_han_thue months", strtotime($hopdong->ngay_het_han)));
                $hopdong->saveModel();
                $this->save();
            }

            return true;
        } else {
            DebugService::dumpdie($this->getErrors());
            return false;
        }
    }

    public function deleteModel($hopdong){
        $ngaybatdau = date('Y-m-d',strtotime(str_replace('/','-',$hopdong->ngay_bat_dau)));
        $hopdong->ngay_het_han = date('Y-m-d', strtotime("+$hopdong->thoi_han_thue months", strtotime($ngaybatdau)));
        $hopdong->saveModel();
        $this->delete();
    }
}
