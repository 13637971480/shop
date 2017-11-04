
<h1>文章管理</h1>
<?=\yii\bootstrap\Html::a('添加文章',['create'],['class'=>'btn btn-success'])?>
<table class="table table-hover">
    <tr>
        <th>ID</th>
        <th>文章标题</th>
        <th>简介</th>
        <th>分类</th>
        <th>状态</th>
        <th>排序</th>
        <th>添加时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr style="height: 60px">
            <td><?=$model->id?></td>
            <td><?=$model->name?></td>
            <td><?=$model->intro?></td>
            <td><?=$model->articleCategory->name?></td>
            <td><?=\backend\models\Article::$statusText[$model->status]?></td>
            <td><?=$model->sort?></td>
            <td><?=date('Y-m-d H:i:s',$model->create_time)?></td>

            <td>
                <?=\yii\bootstrap\Html::a('修改',['update','id'=>$model->id,'create_id'=>$model->id],['class'=>'btn btn-info'])?>
                <?=\yii\bootstrap\Html::a('删除',['delete','id'=>$model->id,'create_id'=>$model->id],['class'=>'btn btn-danger'])?>

            </td>
        </tr>
    <?php endforeach;?>

</table>

<?php
echo \yii\widgets\LinkPager::widget([
    'pagination' => $page
]);

?>