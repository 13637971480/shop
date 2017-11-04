<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 * @property integer $is_help
 */
class ArticleCategory extends \yii\db\ActiveRecord
{
    public static $statusText = ['0'=>'隐藏','1'=>'显示'];
    public static $is_helpText = ['0'=>'否','1'=>'是'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','sort'], 'required'],
            [['intro'], 'string'],
            [['status', 'sort', 'is_help'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '文章分类名',
            'intro' => '简介',
            'status' => '状态',
            'sort' => '排序',
            'is_help' => '是否是帮助分类',
        ];
    }

    public function getArticle()
    {
        return $this->hasMany(Article::className(),['article_category_id'=>'id']);

    }
}
