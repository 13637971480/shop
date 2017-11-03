<?php

use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Brand */
/* @var $form ActiveForm */
?>
<div class="brand-create">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'intro') ?>

        <?= $form->field($model, 'status')->radioList(\backend\models\Brand::$statusText) ?>
        <?= $form->field($model, 'sort') ?>
    <?= $form->field($model, 'imgFile')->fileInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('修改数据', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- brand-create -->
