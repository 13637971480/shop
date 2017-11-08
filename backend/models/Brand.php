<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property string $logo
 * @property integer $status
 * @property integer $sort
 */
class Brand extends \yii\db\ActiveRecord
{

    public static $statusText = ['0'=>'隐藏','1'=>'显示'];

    public $imgFile;

    public $code;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['intro'], 'string'],
            [['status','name'], 'required'],
            [['status', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['logo'], 'string', 'max' => 100],
//            [['imgFile'],'file','extensions'=>['jpg','png','gif'],'skipOnEmpty'=>true],
            [['code'],'captcha','captchaAction' => 'brand/captcha','on'=>'brand'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '品牌',
            'intro' => '简介',
            'logo' => '图片',
            'status' => '状态',
            'sort' => '排序',
            'imgFile'=>'上传图片',
        ];
    }

    public function getNameText()
    {
        if(substr($this->logo,0,7)=='http://'){
            return $this->logo;
        }else{
            return "@web/".$this->logo;
        }
    }

}
