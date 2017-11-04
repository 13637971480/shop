
<h1>文章分类</h1>
<?=\yii\bootstrap\Html::a('添加文章分类',['create'],['class'=>'btn btn-success'])?>
<table class="table table-hover">
    <tr>
        <th>ID</th>
        <th>文章分类名</th>
        <th>分类简介</th>
        <th>状态</th>
        <th>排序</th>
        <th>是否是帮助类</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr style="height: 60px">
            <td><?=$model->id?></td>
            <td><?=$model->name?></td>
            <td><?=$model->intro?></td>
            <td><?=\backend\models\ArticleCategory::$statusText[$model->status]?></td>
            <td><?=$model->sort?></td>
            <td><?=\backend\models\ArticleCategory::$is_helpText[$model->is_help]?></td>
            <td>
                <?=\yii\bootstrap\Html::a('修改',['update','id'=>$model->id],['class'=>'btn btn-info'])?>
                <?=\yii\bootstrap\Html::a('删除',['delete','id'=>$model->id],['class'=>'btn btn-danger'])?>

            </td>
        </tr>
    <?php endforeach;?>

</table>

<?php
echo \yii\widgets\LinkPager::widget([
        'pagination'=>$page
]);
?>