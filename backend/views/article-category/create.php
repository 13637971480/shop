<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticleCategory */
/* @var $form ActiveForm */
?>
<div class="articlecategory-create">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'intro')->textarea() ?>
    <?= $form->field($model, 'status')->radioList(\backend\models\ArticleCategory::$statusText) ?>
    <?= $form->field($model, 'sort') ?>
    <?= $form->field($model, 'is_help')->radioList(\backend\models\ArticleCategory::$is_helpText) ?>

    <div class="form-group">
        <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
        <?= \yii\bootstrap\Html::a('返回',['index'] ,['class' => 'btn btn-warning']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- articlecategory-create -->