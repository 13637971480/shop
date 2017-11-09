<?php
/**
 * Created by PhpStorm.
 * Email: wenmang2015@qq.com
 * Date: 2017/11/8
 * Time: 14:35
 * Company: 源码时代重庆校区
 */

namespace backend\models;


use yii\base\Model;

class GoodsSearchForm extends Model
{
    public $keyword;
    public $minPrice;
    public $maxPrice;

    public function rules()
    {
        return [
            [['minPrice','maxPrice'],'number'],
            ['keyword','safe']


        ]; // TODO: Change the autogenerated stub
    }
}