<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\Goods;
use backend\models\GoodsCategory;
use backend\models\GoodsDayCount;
use backend\models\GoodsGallery;
use backend\models\GoodsIntro;
use backend\models\GoodsSearchForm;
use flyok666\qiniu\Qiniu;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class GoodsController extends \yii\web\Controller
{
    public function actionIndex()
    {
//        $models = Goods::find()->all();

        $query = Goods::find();

        $request = \Yii::$app->request;
        $keyword = $request->get('keyword');
        $minPrice = $request->get('minPrice');
        $maxPrice = $request->get('maxPrice');

        if ($minPrice>0){
            //拼接条件
            $query->andWhere("shop_price >= {$minPrice}");
        }

        if ($maxPrice>0){
            $query->andWhere("shop_price <= {$maxPrice}");
        }
        if (isset($keyword)){
            $query->andWhere("name like '%{$keyword}%' or sn like '%{$keyword}%'");
        }

        $count=$query->count();
        $searchForm=new GoodsSearchForm();
        $pageSize = 5;
        $page = new Pagination(

            [
                'pageSize' => $pageSize,
                'totalCount' => $count
            ]
        );



        $models=$query->limit($page->limit)->offset($page->offset)->all();

        return $this->render('index',['models'=>$models,'page'=>$page,'searchForm'=>$searchForm]);
    }


    //添加功能
    public function actionCreate()
    {
        $model = new Goods();
        $intro = new GoodsIntro();
        $photo = new GoodsGallery();


        $b_cate = Brand::find()->all();
        $g_cate = GoodsCategory::find()->where(['depth'=>2])->all();

        $request = \Yii::$app->request;
        if ($request->isPost){
            if ($model->load($request->post())){
                $goodsCount=GoodsDayCount::findOne(['day' =>date("Ymd",time())]);
                if (empty($goodsCount)) {
                    $goodsCount=new GoodsDayCount();

//                    var_dump( $goodsCount);exit;
                    $goodsCount->day=date("Ymd",time());

                    $goodsCount->count= 1;
//                var_dump( $goodsCount->count);exit;
                    $goodsCount->save();
                }else{


//                    取出数据加一
                    $count = $goodsCount->count;
//                    var_dump($count);exit;
                    $goodsCount->count = $count+1;
                    $goodsCount->save();
                }
                $model->sn=date("Ymd",time()).(substr('00000'. $goodsCount->count,-5));

                $model->create_time=time();
                $model->save();

                if ($intro->load($request->post())){
                    $intro->goods_id = $model->id;
                    $intro->save();

                    if ($photo->load($request->post())){
//                        var_dump($photo);exit();
                        foreach ($photo->path as $imgfile){
                            $photo = new GoodsGallery();
                            $photo->goods_id=$model->id;
                            $photo->path=$imgfile;
                            $photo->save();
                        }
                        \Yii::$app->session->setFlash('success',['添加商品成功']);
                        return $this->redirect(['index']);


                    }
                }
            }


        }

        $options = [
            ArrayHelper::map($b_cate,'id','name'),
            ArrayHelper::map($g_cate,'id','name')
        ];
        $model->sort=100;
        $model->status=1;
        $model->is_on_sale=0;
        return $this->render('create',['model'=>$model,'intro'=>$intro,'photo'=>$photo,'options'=>$options]);

    }




    //修改功能
    public function actionUpdate($id,$goods_id)
    {
        $model = Goods::findOne($id);
        $intro = GoodsIntro::findOne($goods_id);
        $photo =new GoodsGallery();


        $b_cate = Brand::find()->all();
        $g_cate = GoodsCategory::find()->where(['depth'=>2])->all();

        $request = \Yii::$app->request;
        if ($request->isPost){
            if ($model->load($request->post())){
                $model->save();

                if ($intro->load($request->post())){
                    $intro->goods_id = $model->id;
                    $intro->save();

                    if ($photo->load($request->post())){
//                        var_dump($photo);exit();
                        $photos = $request->post()['GoodsGallery']['imgFile'];
                        foreach ($photos as $v){
                            $photo = new GoodsGallery();
                            $photo->goods_id=$model->id;
                            $photo->path=$v;
                            $photo->save();
                        }

                        \Yii::$app->session->setFlash('success',['修改商品成功']);
                        return $this->redirect(['index']);


                    }
                }
            }


        }

        $options = [
            ArrayHelper::map($b_cate,'id','name'),
            ArrayHelper::map($g_cate,'id','name')
        ];
        $path = GoodsGallery::find()->where(['goods_id'=>$id])->all();
//        var_dump($path);exit();
        foreach ($path as $v){
            $photo->imgFile[]=$v->path;
        }
        return $this->render('update',['model'=>$model,'intro'=>$intro,'photo'=>$photo,'options'=>$options]);

    }






    public function actionDelete($id)
    {
        $model = Goods::findOne($id);
        $intro = GoodsIntro::findOne($id);


        $model->delete();
        $intro->delete();
        GoodsGallery::deleteAll(['goods_id'=>$id]);
        \Yii::$app->session->setFlash("success",'删除成功');
        return $this->redirect(['index']);
    }




    //图片上传
    public function actionUpload(){
//       var_dump($_FILES['file']['tmp_name']);exit;
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

        $key = uniqid();
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


    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }

}
