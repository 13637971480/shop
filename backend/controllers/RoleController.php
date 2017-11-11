<?php

namespace backend\controllers;

use backend\models\AuthItem;
use Symfony\Component\Console\Helper\Helper;
use yii\helpers\ArrayHelper;

class RoleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //实例化RBAC组件
        $authManager = \Yii::$app->authManager;
        //找到所有角色
        $roles = $authManager->getRoles();
//        var_dump($roles);exit();
        return $this->render('index',['roles'=>$roles]);
    }



    public function actionCreate()
    {
        $model = new AuthItem();
        $request = \Yii::$app->request;
        //实例化RBAC组件
        $authManager = \Yii::$app->authManager;

        if ($model->load($request->post()) && $model->validate()){
//            var_dump($model->permissions);exit();

            //创建角色
            $role = $authManager->createRole($model->name);
            //添加描述
            $role->description = $model->description;
            //添加角色
            if ($authManager->add($role)){
                //添加用户权限
                foreach ($model->permissions as $permission){
                    //把权限名称添加到对应角色对象
                    $authManager->addChild($role,$authManager->getPermission($permission));
                }

            }

            \Yii::$app->session->setFlash('success','添加'.$model->description.'角色成功');

            return $this->redirect(['index']);


        }

        //查询所有权限
        $permissions = $authManager->getPermissions();
        $permissions = ArrayHelper::map($permissions,'name','description');
//        var_dump($permissions);exit();


        return $this->render('create',['model'=>$model,'permissions'=>$permissions]);

    }


    public function actionUpdate($name)
    {
        $model = AuthItem::findOne($name);
//        $model->permissions = ['brand/index'];

        $request = \Yii::$app->request;

        //实例化RBAC组件
        $authManager = \Yii::$app->authManager;
        $rPermission = $authManager->getPermissionsByRole($name);
//        var_dump($rPermission);exit();
        //取出角色所有的权限取出来
        $model->permissions = array_keys($rPermission);

        if ($model->load($request->post()) && $model->validate()){


            //找到当前修改该对象
            $role = $authManager->getRole($model->name);
//            var_dump($role);exit();

            if ($role){

                //修改并添加描述
                $role->description = $model->description;

                //修改角色
                if ($authManager->update($model->name,$role)){
                    //要修改角色权限必须先删除所有权限再添加权限
                    $authManager->removeChildren($role);
                    //删除当前用户所有权限后，再添加用户权限
                    foreach ($model->permissions as $permission){
                        //把权限名称添加到对应角色对象
                        $authManager->addChild($role,$authManager->getPermission($permission));
                }

                \Yii::$app->session->setFlash('success','添加'.$model->description.'角色成功');

                return $this->redirect(['index']);

            }else{
                \Yii::$app->session->setFlash('danger','角色名称不能修改');
                return $this->refresh();

            }
        }
        }

        //查询所有权限
        $permissions = $authManager->getPermissions();
        $permissions = ArrayHelper::map($permissions,'name','description');
        return $this->render('create',['model'=>$model,'permissions'=>$permissions]);
    }


    public function actionDelete($name)
    {
        //实例化RBAC组件对象
        $authManager = \Yii::$app->authManager;
        //找到要删除的角色对象
        $role = $authManager->getRole($name);

        //1.删除当前角色所有权限
        $authManager->removeChildren($role);
        //2.删除当前角色
        if ($authManager->remove($role)){
            \Yii::$app->session->setFlash('success','角色'.$name.'删除成功');
            return $this->redirect(['index']);
        }

    }

}
