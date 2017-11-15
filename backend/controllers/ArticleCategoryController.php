<?php
/**
 * Created by PhpStorm.
 * User: LBC
 * Date: 2017/11/4
 * Time: 11:48
 */

namespace backend\controllers;


use backend\models\Article;
use backend\models\ArticleCategory;
use yii\data\Pagination;
use yii\web\Controller;

class ArticleCategoryController extends Controller
{
    public function actionIndex()
    {
        $count = ArticleCategory::find()->count();
        $pageSize = 5 ;
        $page = new Pagination([
            'pageSize'=>$pageSize,
            'totalCount'=>$count
        ]);
        $models = ArticleCategory::find()->limit($page->limit)->offset($page->offset)->all();

        return $this->render('index',['models' => $models,'page'=>$page]);

    }

    public function actionCreate()
    {
        $model = new ArticleCategory();
        $request = \Yii::$app->request;

        if ($model->load($request->post())){

            if ($model->validate()){

                $model->save();
                return $this->redirect(['index']);
            }

        }


        $model->status=1;
        $model->is_help=0;
        return $this->render('create', ['model' => $model]);

    }

    public function actionUpdate($id)
    {
        $model = ArticleCategory::findOne($id);
        $request = \Yii::$app->request;

        if ($model->load($request->post())){

            if ($model->validate()){

                $model->save();
                return $this->redirect(['index']);
            }

        }

        return $this->render('update', ['model' => $model]);

    }

    public function actionDelete($id)
    {
        $model = ArticleCategory::findOne($id);
        if (Article::find()->where(['article_category_id'=>$id])->all()){
            \Yii::$app->session->setFlash('danger','该分类下有关联的文章，请先删除与之关联的文章');
        }else{
            \Yii::$app->session->setFlash('success','删除文章分类成功');
            $model->delete();
        }

        return $this->redirect(['index']);
    }

}