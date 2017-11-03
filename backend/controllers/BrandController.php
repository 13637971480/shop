<?php
/**
 * Created by PhpStorm.
 * User: LBC
 * Date: 2017/11/3
 * Time: 15:57
 */

namespace backend\controllers;


use backend\models\Brand;
use yii\web\Controller;
use yii\web\UploadedFile;

class BrandController extends Controller
{

    public function actionIndex()
    {
        $brands = Brand::find()->all();

        return $this->render('index',['brands'=>$brands]);
    }

    /**
     * 数据添加
     * @return string
     */
    public function actionCreate()
    {
        $model = new Brand();
        $request = \Yii::$app->request;

        if ($model->load($request->post())){

            $model->imgFile=UploadedFile::getInstance($model,'imgFile');



            if ($model->validate()){

                $imgFilePath = "images/brand/".uniqid().".".$model->imgFile->extension;
//                 var_dump($imgFilePath);exit();
                $model->imgFile->saveAs($imgFilePath,false);
                $model->logo=$imgFilePath;

                if ($model->save()){
                    return $this->redirect(['index']);
                }
            }


        }

        $model->status=1;
        return $this->render('create',[ 'model' => $model ]);
        
    }


    /**
     * 数据修改
     * @return string
     */
    public function actionUpdate($id)
    {
        $model = Brand::findOne($id);
        $request = \Yii::$app->request;

        if ($model->load($request->post())){

            $model->imgFile=UploadedFile::getInstance($model,'imgFile');



            if ($model->validate()){

                $imgFilePath = "images/brand/".uniqid().".".$model->imgFile->extension;
//                 var_dump($imgFilePath);exit();
                $model->imgFile->saveAs($imgFilePath,false);
                $model->logo=$imgFilePath;

                if ($model->save()){
                    return $this->redirect(['index']);
                }
            }


        }

//        $model->status=1;
        return $this->render('update',[ 'model' => $model ]);

    }

    public function actionDelete($id)
    {
        $model = Brand::findOne($id);
        $model->delete();
        return $this->redirect(['index']);

    }




}