<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Article */
/* @var $form ActiveForm */
?>
<div class="article-create">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'article_category_id')->dropDownList($options) ?>
    <?= $form->field($model, 'intro') ?>
    <?= $form->field($model, 'status')->radioList(\backend\models\Article::$statusText) ?>
    <?= $form->field($model, 'sort') ?>
    <?= $form->field($detail, 'content')->textarea(['rows'=>5]); ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- article-create -->
