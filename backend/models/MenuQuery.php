<?php
/**
 * Created by PhpStorm.
 * User: LBC
 * Date: 2017/11/5
 * Time: 14:48
 */

namespace backend\models;


use yii\db\ActiveQuery;
use creocoder\nestedsets\NestedSetsQueryBehavior;

class MenuQuery extends ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }

}