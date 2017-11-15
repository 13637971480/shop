<?php

namespace backend\controllers;

use backend\models\GoodsCategory;
use yii\data\Pagination;
use yii\helpers\Json;

class GoodsCategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
//        //1.总条数
//        $count = GoodsCategory::find()->count();
//
//        //2.每页显示条数
//        $pageSize = 10;
//
//        //创建分页对象
//        $page = new Pagination(
//
//            [
//                'pageSize' => $pageSize,
//                'totalCount' => $count
//            ]
//        );
//        ->limit($page->limit)->offset($page->offset)

        $models = GoodsCategory::find()->orderBy('tree,lft')->all();

        return $this->render('index',['models'=>$models]);
    }


    public function actionCreate()
    {
        $model =new GoodsCategory();

        $requset = \Yii::$app->request;

        if ($requset->isPost){

            $model->load($requset->post());

            if ($model->validate()){

                if ($model->parent_id==0){

                    $model->makeRoot();
                    \Yii::$app->session->setFlash('success','添加一级目录成功');
                    return $this->redirect(['index']);

                }else{

                    $cateParent = GoodsCategory::findOne(['id'=>$model->parent_id]);
                    $model->appendTo($cateParent);

                }

                \Yii::$app->session->setFlash('success','添加分类成功');
                return $this->redirect(['index']);
            }

        }

        $cates=GoodsCategory::find()->asArray()->all();
        $cates[]=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
        $cates=Json::encode($cates);


        return $this->render('create',['model'=>$model,'cates'=>$cates]);

    }

    public function actionUpdate($id)
    {
        $model =GoodsCategory::findOne($id);

        $requset = \Yii::$app->request;

        if ($requset->isPost){

            $model->load($requset->post());

            if ($model->validate()){

                if ($model->parent_id==0){

                    $model->save();
                    \Yii::$app->session->setFlash('success','修改成功');
                    return $this->redirect(['index']);

                }else{

                    $cateParent = GoodsCategory::findOne(['id'=>$model->parent_id]);
                    $model->appendTo($cateParent);

                }

                \Yii::$app->session->setFlash('success','修改分类成功');
                return $this->redirect(['index']);
            }

        }

        $cates=GoodsCategory::find()->asArray()->all();
        $cates[]=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
        $cates=Json::encode($cates);


        return $this->render('update',['model'=>$model,'cates'=>$cates]);

    }

    public function actionDelete($id)
    {
        $model =GoodsCategory::findOne($id);

        $model->deleteWithChildren();

        return $this->redirect(['index']);

    }


    public function actionTest()
    {
        $cate = new GoodsCategory();
        $cate->name="数码产品";
        $cate->parent_id=0;
        $cate->makeRoot();
//        var_dump($cate->getErrors());
    }

    public function actionTestChild()
    {
        $cate = new GoodsCategory();
        $cate->name="手机";
        $cate->parent_id=1;
        $cateParent = GoodsCategory::findOne(['id'=>$cate->parent_id]);
        $cate->appendTo($cateParent);
    }


}
