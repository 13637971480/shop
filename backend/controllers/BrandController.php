<?php
/**
 * Created by PhpStorm.
 * User: LBC
 * Date: 2017/11/3
 * Time: 15:57
 */

namespace backend\controllers;

use common\components\Upload;
use flyok666\qiniu\Qiniu;
use yii\data\Pagination;
use backend\models\Brand;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\UploadedFile;

class BrandController extends Controller
{

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'minLength' => 4,//必需设置3或以上
                'maxLength' => 5
            ],

        ];
    }


    public function actionIndex()
    {

        //1.总条数
        $count = Brand::find()->count();

        //2.每页显示条数
        $pageSize = 5;

        //创建分页对象
        $page = new Pagination(
            [
                'pageSize' => $pageSize,
                'totalCount' => $count
            ]
        );

        $brands = Brand::find()->limit($page->limit)->offset($page->offset)->all();

        return $this->render('index',['brands'=>$brands,'page'=>$page]);
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

//            $model->imgFile=UploadedFile::getInstance($model,'imgFile');



            if ($model->validate()){

//                $imgFilePath = "images/brand/".uniqid().".".$model->imgFile->extension;
//                 var_dump($imgFilePath);exit();
//                $model->imgFile->saveAs($imgFilePath,false);
//                $model->logo=$imgFilePath;

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

//            $model->imgFile=UploadedFile::getInstance($model,'imgFile');



            if ($model->validate()){

//                $imgFilePath = "images/brand/".uniqid().".".$model->imgFile->extension;
//                 var_dump($imgFilePath);exit();
//                $model->imgFile->saveAs($imgFilePath,false);
//                $model->logo=$imgFilePath;

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

    //图片上传
    public function actionUpload(){
//        var_dump($_FILES['file']['tmp_name']);exit;
        //七牛云上传
        //配置
        $config = [
            'accessKey'=>'9ZRPZ4_Qy8OYeFhxV2ILHtPzr_2O061ZKKlGP7Jb',//ak
            'secretKey'=>'8XkGnsKBmrFCscQlLa81NIAPLAlPWVJVxiyuXtEn',//sk
            'domain'=>'http://oyvhzh5a2.bkt.clouddn.com',//域名
            'bucket'=>'shop',//空间名称
            'area'=>Qiniu::AREA_HUANAN //区域

        ];
        //实例化对象
        $qiniu = new Qiniu($config);
        $key = time();
        //调用上传方法
        $qiniu->uploadFile($_FILES['file']['tmp_name'],$key);
        $url = $qiniu->getLink($key);
//        var_dump($url);exit;
        $info=[
            'code'=>0,
            'url'=>$url,
            'attachment'=>$url
        ];

        exit(json_encode($info));
    }




}

