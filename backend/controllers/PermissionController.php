<?php

namespace backend\controllers;

use backend\models\AuthItem;

class PermissionController extends \yii\web\Controller
{
    public function actionIndex()
    {
//        $models = AuthItem::find()->where('type=2')->all();
        //实例化RBAC组件
        $authManager = \Yii::$app->authManager;
        //查询所有权限
        $models = $authManager->getPermissions();

        return $this->render('index',['models'=>$models]);

    }

    public function actionCreate()
    {
        $model = new AuthItem();
        $request = \Yii::$app->request;

        if ($model->load($request->post()) && $model->validate()){

            //实例化RBAC组件
            $authManager = \Yii::$app->authManager;
            //创建权限
            $permission = $authManager->createPermission($model->name);
            //添加描述
            $permission->description = $model->description;
            //添加权限
            $authManager->add($permission);

            \Yii::$app->session->setFlash('success','添加'.$model->description.'权限成功');

            return $this->redirect(['index']);


        }


        return $this->render('create',['model'=>$model]);

    }


    public function actionUpdate($name)
    {
        $model = AuthItem::findOne($name);
        $request = \Yii::$app->request;

        if ($model->load($request->post()) && $model->validate()){

            //实例化RBAC组件
            $authManager = \Yii::$app->authManager;
            //找到当前修改该对象
            $permission = $authManager->getPermission($model->name);
            if ($permission){
                //修改权限
                //修改并添加描述
                $permission->description = $model->description;
                //添加权限
                $authManager->update($model->name,$permission);

                \Yii::$app->session->setFlash('success','添加'.$model->description.'权限成功');

                return $this->redirect(['index']);

            }else{
                \Yii::$app->session->setFlash('danger','权限名称不能修改');
                return $this->refresh();

            }
        }
        return $this->render('create',['model'=>$model]);
    }


    public function actionDelete($name)
    {
        //实例化RBAC组件对象
        $authManager = \Yii::$app->authManager;
        //找到要删除的权限对象
        $permission = $authManager->getPermission($name);

        if ($authManager->remove($permission)){
            \Yii::$app->session->setFlash('success','删除'.$name.'权限成功');
            return $this->redirect(['index']);
        }

    }

}
