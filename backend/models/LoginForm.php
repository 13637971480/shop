<?php
/**
 * Created by PhpStorm.
 * User: LBC
 * Date: 2017/11/9
 * Time: 11:53
 */

namespace backend\models;


use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;

    public $rememberMe = true ;


    public function rules()
    {

        return [
            [['username','password'],'required'],
            [['rememberMe'],'safe']

        ];
    }

    public function attributeLabels()
    {
        return [
          'username'=>'管理员账号',
            'password'=>'密码',
            'rememberMe'=>'记住密码'

        ];
    }

}