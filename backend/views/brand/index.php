<h1>品牌管理</h1>
<?=\yii\bootstrap\Html::a('添加品牌',['create'],['class'=>'btn btn-success'])?>
<table class="table table-hover">
    <tr>
        <th>ID</th>
        <th>品牌名称</th>
        <th>品牌图片</th>
        <th>状态</th>
        <th>排序</th>
        <th>操作</th>
    </tr>
    <?php foreach ($brands as $brand):?>
    <tr style="height: 60px">
        <td><?=$brand->id?></td>
        <td><?=$brand->name?></td>
        <td><?=\yii\bootstrap\Html::img($brand->nameText,['height'=>50,'width'=>100])?></td>
        <td><?=\backend\models\Brand::$statusText[$brand->status]?></td>
        <td><?=$brand->sort?></td>
        <td>
            <?=\yii\bootstrap\Html::a('修改',['update','id'=>$brand->id],['class'=>'btn btn-info'])?>
            <?=\yii\bootstrap\Html::a('删除',['delete','id'=>$brand->id],['class'=>'btn btn-danger'])?>

        </td>
    </tr>
    <?php endforeach;?>

</table>
<?php
echo \yii\widgets\LinkPager::widget([

    'pagination' => $page
]);
?>