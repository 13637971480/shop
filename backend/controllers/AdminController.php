<?php

namespace backend\controllers;

use backend\models\Admin;
use backend\models\LoginForm;
use yii\helpers\ArrayHelper;


class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models = Admin::find()->all();
        //实例化RBAC组件
        $authManager = \Yii::$app->authManager;
        //找到所有角色
        $roles = $authManager->getRoles();
        return $this->render('index',['models'=>$models]);
    }


    public function actionCreate()
    {
        $model = new Admin();
        $request = \Yii::$app->request;

        //找到角色对象
        $authManager = \Yii::$app->authManager;
        $roles = $authManager->getRoles();
//        $roles = ArrayHelper::map($roles,'name','description');

        if ($request->isPost){

            if ($model->load($request->post()) && $model->validate()){
//var_dump($request->post());exit();
                //给密码加密
                $model->password=\Yii::$app->security->generatePasswordHash($model->password);
                $model->token = \Yii::$app->security->generateRandomString();
                //追加添加时间
                $model->add_time = time();
                $model->token_create_time = time();


                $model->save();
                    $role =$authManager->getRole($model->description);
                    $authManager->assign($role,$model->id);

//                var_dump($model->getErrors());exit();

//                var_dump($model);exit();






                \Yii::$app->session->setFlash('success','添加管理员成功');
                return $this->redirect(['index']);

            }

        }

        $roles = ArrayHelper::map($roles,'name','description');
//        var_dump($roles);exit();

        return $this->render('create', ['model' => $model,'roles'=>$roles]);

    }

    public function actionUpdate($id,$name)
    {
        $model = Admin::findOne($id);

        $request = \Yii::$app->request;
        //找到角色对象
        $authManager = \Yii::$app->authManager;
        $roles = $authManager->getRoles();
        $modelRole =  $authManager->getPermissionsByRole($name);
        var_dump($modelRole);exit();

        if ($request->isPost){

            if ($model->load($request->post()) && $model->validate()){

                //给密码加密
                $model->password=\Yii::$app->security->generatePasswordHash($model->password);
                $model->token = \Yii::$app->security->generateRandomString();
                //追加添加时间
                $model->last_login_time=time();
                $model->last_login_ip=\Yii::$app->request->userIP;

                $model->save();
//                var_dump($model->getErrors());exit();
                \Yii::$app->session->setFlash('success','修改管理员成功');

                return $this->redirect(['index']);

            }
        }
        $roles = ArrayHelper::map($roles,'name','description');

        return $this->render('create', ['model' => $model,'roles'=>$roles]);


    }








    public function actionLogin()
    {

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $request = \Yii::$app->request;

        if ($request->isPost){

//            var_dump($request->post());exit();
            $model->load($request->post());
            if ($model->validate()){

                //根据登录信息到数据库匹配对应用户信息
                $admin = Admin::findOne(['username'=>$model->username]);

                if ($admin){
                    //用户名存在 验证密码是否正确


                    if (\Yii::$app->security->validatePassword($model->password,$admin->password)){

                        //执行登录操作
                        \Yii::$app->user->login($admin,$model->rememberMe?3600*24*7:0);
                        $admin->last_login_time=time();
                        $admin->last_login_ip=\Yii::$app->request->userIP;
                        $admin->save();
                        //跳转
                        return $this->redirect(['index']);


                    }else{
                        //密码不正确
                        $model->addError('password','用户密码错误');
                    }

                }else{
                    //用户名不存在
                    $model->addError('username','用户名不存在');
                }

            }


        }


        return $this->render('login', ['model' => $model]);

    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->redirect(['login']);

    }





}
