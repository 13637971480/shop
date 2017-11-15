<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Goods */
/* @var $form ActiveForm */
?>
<div class="goods-create">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>

        <?= $form->field($model, 'logo')->widget('manks\FileInput', []); ?>
        <?= $form->field($model, 'goods_category_id')->dropDownList($options[1],['prompt'=>'请选择商品分类']) ?>
        <?= $form->field($model, 'brand_id')->dropDownList($options[0],['prompt'=>'请选择商品品牌']) ?>
        <?= $form->field($model, 'stock') ?>
        <?= $form->field($model, 'is_on_sale')->radioList(\backend\models\Goods::$onSaleText) ?>
        <?= $form->field($model, 'status')->radioList(\backend\models\Goods::$statusText) ?>
        <?= $form->field($model, 'sort') ?>
        <?= $form->field($model, 'market_price') ?>
        <?= $form->field($model, 'shop_price') ?>
        <?=$form->field($photo, 'path')->widget('manks\FileInput', [
            'clientOptions' => [
                'pick' => [
                    'multiple' => true,
                ]]])?>
        <?=$form->field($intro,'content')->widget('kucha\ueditor\UEditor',[]);?>
        <div class="form-group">
            <?= Html::submitButton('添加商品', ['class' => 'btn btn-success']) ?>
            <?= \yii\bootstrap\Html::a('返回',['index'] ,['class' => 'btn btn-warning']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- goods-create -->
