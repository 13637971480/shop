<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property integer $article_category_id
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 */
class Article extends \yii\db\ActiveRecord
{
    public static $statusText = ['0'=>'隐藏','1'=>'显示'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'article_category_id'], 'required'],
            [['intro'], 'string'],
            [['article_category_id', 'status', 'sort', 'create_time'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '文章名',
            'intro' => '文章简介',
            'article_category_id' => '文章分类',
            'status' => '状态',
            'sort' => '文章排序',
            'create_time' => '文章录入时间',
        ];
    }

    public function getArticleCategory()
    {
        return $this->hasOne(ArticleCategory::className(),['id'=>'article_category_id']);

    }

    public function getArticleDetail()
    {
        return  $this->hasOne(ArticleDetail::className(),['article_id'=>'id']);
    }
}
