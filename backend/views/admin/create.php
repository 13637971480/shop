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
    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model,'description')->checkboxList($roles)?>

    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- model-add -->