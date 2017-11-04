<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleCategory;
use backend\models\ArticleDetail;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $count = Article::find()->count();
        $pageSize = 5;
        $page = new Pagination(
            [
            'pageSize'=>$pageSize,
            'totalCount'=>$count
            ]
        );

       $models = Article::find()->limit($page->limit)->offset($page->offset)->all();

       return $this->render('index',['models' => $models,'page'=>$page]);
    }

    public function actionCreate()
    {
        //找到Article和ArticleDetail模型
        $model = new Article();
        $detail = new ArticleDetail();

        $cate = ArticleCategory::find()->all();

        $options = ArrayHelper::map($cate,'id','name');
        $request = \Yii::$app->request;

        if ($model->load($request->post())){
                $model->create_time=time();
                $model->save(false);
                if ($detail->load($request->post())){
                    $detail->article_id=$model->id;
                    $detail->save();
                    \Yii::$app->session->setFlash('success','添加文章成功');
                    return $this->redirect(['index']);
                }

        }

        $model->status=1;

        return $this->render('create', ['options' => $options, 'model' => $model,'detail'=>$detail]);

    }

    public function actionUpdate($id,$create_id)
    {
        $model = Article::findOne($id);
        $detail =ArticleDetail::findOne($create_id);
        $cate = ArticleCategory::find()->all();
        $options = ArrayHelper::map($cate,'id','name');
        $request = \Yii::$app->request;

        if ($model->load($request->post()) && $model->validate()){
//            var_dump($request->post());exit();
            $model->save(false);


            $detail->load($request->post());
            $detail->save();
            \Yii::$app->session->setFlash('success','修改文章成功');
            return $this->redirect(['index']);
        }
        return $this->render('update', ['options' => $options, 'model' => $model,'detail'=>$detail]);




    }

    public function actionDelete($id,$create_id)
    {
        $model = Article::findOne($id);
        $detail =ArticleDetail::findOne($create_id);
        $model->delete();
        $detail->delete();
        return $this->redirect(['index']);

    }

}
