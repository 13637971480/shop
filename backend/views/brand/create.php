<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \yii\web\JsExpression;
use xj\uploadify\Uploadify;



/* @var $this yii\web\View */
/* @var $model backend\models\Brand */
/* @var $form ActiveForm */
?>
<div class="brand-add">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'status')->radioList(
              \backend\models\Brand::$statusText
        ) ?>
        <?=$form->field($model,'logo')->widget('manks\FileInput', []); ?>


        <?= $form->field($model, 'sort') ?>
        <?= $form->field($model, 'intro') ?>
    
        <div class="form-group">
            <?= Html::submitButton('添加', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- model-add -->
