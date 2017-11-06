<h1>商品分类管理</h1>

<?= \yii\bootstrap\Html::a('添加商品分类',['create'],['class'=>'btn btn-success'])?>
<table class="table table-hover">
    <tr>
        <th>ID</th>
        <th>分类名称</th>
        <th>父ID</th>
        <th>操作</th>
    </tr>

    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->nameText?></td>
            <td><?=$model->parent_id?></td>
            <td>
                <?=\yii\bootstrap\Html::a('修改',['update','id'=>$model->id],['class'=>'btn btn-info'])?>
                <?=\yii\bootstrap\Html::a('删除',['delete','id'=>$model->id],['class'=>'btn btn-danger'])?>
            </td>
        </tr>


    <?php endforeach;?>

</table>