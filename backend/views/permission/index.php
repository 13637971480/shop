

<h1>权限管理</h1>

<?php echo  \yii\bootstrap\Html::a('添加权限',['create'],['class'=>'btn btn-warning'])?>
<table class="table table-hover">
    <tr>
        <th>权限</th>
        <th>权限描述</th>
        <th>操作</th>
    </tr>

    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->name?></td>
            <td><?=$model->description?></td>
            <td>
                <?= \yii\bootstrap\Html::a('修改',['update','name'=>$model->name],['class'=>'btn btn-info'])?>
                <?= \yii\bootstrap\Html::a('删除',['delete','name'=>$model->name],['class'=>'btn btn-danger'])?>

            </td>
        </tr>



    <?php endforeach;?>


</table>
