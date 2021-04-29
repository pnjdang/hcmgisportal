<?php

namespace app\modules\quanly\models\can;

use app\modules\danhmuc\models\loainha\Loainha;
use app\models\RanhPhuong;
use app\modules\quanly\models\ho\ThongTinHo;
use app\modules\quanly\models\hopdong\GiaHan;
use app\modules\quanly\models\hopdong\Hopdong;
use app\services\DebugService;
use app\services\UtilityService;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "thong_tin_can".
 *
 * @property integer $id_can
 * @property integer $stt_can
 * @property string $so_nha
 * @property string $ten_duong
 * @property integer $id_loainha
 * @property string $dien_tich_khuon_vien
 * @property string $ghi_chu
 * @property string $ma_phuong
 * @property string $geom
 * @property string $so_to_bd
 * @property string $so_thua
 * @property string $hien_trang
 * @property string $dien_tich_su_dung
 * @property integer $gia_ban
 * @property string $thoigian_di
 * @property string $chu_ho
 * @property integer $delete
 * @property integer $da_trinh
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $ghichu_can
 * @property integer $stt_phuong
 * @property boolean $co_the_ban
 * @property boolean $da_ban
 * @property boolean $thanh_ly
 * @property string $ngay_thanhly
 * @property string $ngay_ban
 * @property string $ngay_chuyengiao
 * @property boolean $chuyen_giao
 * @property string $ghichu_ban
 * @property string $ghichu_chuyengiao
 * @property integer $dieukien_bannha99
 * @property string $so_thanhly
 * @property string $so_chuyengiao
 *
 * @property Loainha $idLoainha
 * @property ThongTinHo[] $thongTinHos
 */
class ThongTinCan extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'thong_tin_can';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stt_can', 'id_loainha', 'gia_ban', 'delete', 'da_trinh', 'status', 'created_by', 'updated_by', 'stt_phuong', 'dieukien_bannha99'], 'integer'],
            [['dien_tich_khuon_vien', 'dien_tich_su_dung'], 'number'],
            [['geom', 'hien_trang', 'ghichu_can'], 'string'],
            [['thoigian_di', 'created_at', 'updated_at', 'ngay_thanhly', 'ngay_ban', 'ngay_chuyengiao'], 'safe'],
            [['co_the_ban', 'da_ban', 'thanh_ly', 'chuyen_giao'], 'boolean'],
            [['so_nha', 'ten_duong', 'chu_ho', 'so_thanhly', 'so_chuyengiao'], 'string', 'max' => 100],
            [['ghi_chu'], 'string', 'max' => 200],
            [['ma_phuong'], 'string', 'max' => 50],
            [['so_to_bd', 'so_thua'], 'string', 'max' => 20],
            [['ghichu_ban', 'ghichu_chuyengiao'], 'string', 'max' => 1000],
            [['id_loainha'], 'exist', 'skipOnError' => true, 'targetClass' => Loainha::className(), 'targetAttribute' => ['id_loainha' => 'id_loainha']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_can' => 'Id Can',
            'stt_can' => 'Stt Can',
            'so_nha' => 'So Nha',
            'ten_duong' => 'Ten Duong',
            'id_loainha' => 'Id Loainha',
            'dien_tich_khuon_vien' => 'Dien Tich Khuon Vien',
            'ghi_chu' => 'Ghi Chu',
            'ma_phuong' => 'Ma Phuong',
            'geom' => 'Geom',
            'so_to_bd' => 'So To Bd',
            'so_thua' => 'So Thua',
            'hien_trang' => 'Hien Trang',
            'dien_tich_su_dung' => 'Dien Tich Su Dung',
            'gia_ban' => 'Gia Ban',
            'thoigian_di' => 'Thoigian Di',
            'chu_ho' => 'Chu Ho',
            'delete' => 'Delete',
            'da_trinh' => 'Da Trinh',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'ghichu_can' => 'Ghichu Can',
            'stt_phuong' => 'Stt Phuong',
            'co_the_ban' => 'Co The Ban',
            'da_ban' => 'Da Ban',
            'thanh_ly' => 'Thanh Ly',
            'ngay_thanhly' => 'Ngay Thanhly',
            'ngay_ban' => 'Ngay Ban',
            'ngay_chuyengiao' => 'Ngay Chuyengiao',
            'chuyen_giao' => 'Chuyen Giao',
            'ghichu_ban' => 'Ghichu Ban',
            'ghichu_chuyengiao' => 'Ghichu Chuyengiao',
            'dieukien_bannha99' => 'Dieukien Bannha99',
            'so_thanhly' => 'So Thanhly',
            'so_chuyengiao' => 'So Chuyengiao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoainha()
    {
        return $this->hasOne(Loainha::className(), ['id_loainha' => 'id_loainha']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThongTinHos()
    {
        return $this->hasMany(ThongTinHo::className(), ['id_can' => 'id_can'])->where(['thong_tin_ho.status' => 1,'thong_tin_ho.thanh_ly' => 1]);
    }

    public function getDanhsachho()
    {
        return $this->hasMany(ThongTinHo::className(), ['id_can' => 'id_can'])->where(['thong_tin_ho.status' => 1,'da_ban' => false]);
    }

    public function getPhuong()
    {
        return $this->hasOne(RanhPhuong::className(), ['maphuong' => 'ma_phuong']);
    }

    public function getFulldiachi()
    {
        return $this->so_nha . ' ' . $this->ten_duong . ', ' . $this->phuong->tenphuong;
    }

    public function getLatlng()
    {
        $a = (new \yii\db\Query())
            ->select('st_x(geom) as geo_x, st_y(geom) as geo_y')
            ->from(ThongTinCan::tableName())
            ->where(['id_can' => $this->id_can])
            ->one();
        return $a;
    }

    public function saveModel()
    {
        date_default_timezone_set('Asia/Ho_chi_minh');

        if($this->ngay_ban != null){
            $this->ngay_ban = date('Y-m-d', strtotime(str_replace('/','-', $this->ngay_ban)));
        }
        if($this->ngay_chuyengiao != null){
            $this->ngay_chuyengiao = date('Y-m-d', strtotime(str_replace('/','-', $this->ngay_chuyengiao)));
        }

        $this->status = 1;
        $this->created_by = Yii::$app->user->id;
        $this->created_at = date('Y-m-d H:i:s');

        if($this->validate()){
            $this->save();
            return true;
        } else {
            return false;
        }
    }

    public function deleteModel(){
        date_default_timezone_set('Asia/Ho_chi_minh');

        $this->status = 0;
        $this->updated_by = Yii::$app->user->id;
        $this->updated_at = date('Y-m-d H:i:s');

        if($this->validate()){
            $this->save();
            $hos = ThongTinHo::find()->where(['status' => 1, 'id_can' => $this->id_can])->all();
            if($hos != null){
                foreach ($hos as $i => $ho) {
                    $hopdong = Hopdong::find()->where(['status' => 1, 'id_ho' => $ho->id_ho])->one();
                    $hopdong->status = 0;
                    $hopdong->updated_by = Yii::$app->user->id;
                    $hopdong->updated_at = date('Y-m-d H:i:s');
                    $hopdong->save();

                    GiaHan::deleteAll(['id_hopdong' => $hopdong->id_hopdong]);
                    $ho->status = 0;
                    $ho->updated_by = Yii::$app->user->id;
                    $ho->updated_at = date('Y-m-d H:i:s');
                    $ho->save();
                    UtilityService::lichsu('Xóa căn <i>' . $this->so_nha . ' - ' . $this->ten_duong . '</i>');
                    UtilityService::alert('deleted');
                }
            }
            return true;
        } else {
            return false;
        }
    }

}
