<?php
/**
 * Created by PhpStorm.
 * User: LBC
 * Date: 2017/11/5
 * Time: 16:38
 */
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'parent_id');
echo  \liyuze\ztree\ZTree::widget([
    'setting' => '{
    callback: {
		        onClick: function(event, treeId, treeNode){
		        console.dir(treeNode);
		        $("#goodscategory-parent_id").val(treeNode.id);
		        }
	     },
			data: {
				simpleData: {
					enable: true,
					idKey: "id",
			        pIdKey: "parent_id",
			        rootPId: 0
				}
			}
		}',
    'nodes' => $cates
]);
echo \yii\bootstrap\Html::submitButton('修改',['class'=>'btn btn-info']);
echo \yii\bootstrap\Html::a('返回',['index'] ,['class' => 'btn btn-warning']) ;

\yii\bootstrap\ActiveForm::end();