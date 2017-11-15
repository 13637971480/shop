<h1>商品管理</h1>


<div class="row">
    <div class="col-md-2"><?=\yii\bootstrap\Html::a('添加商品',['create'],['class'=>'btn btn-success'])?></div>
    <div class="col-md-10">
          <form class="form-inline pull-right">


            <input type="text" class="form-control" id="minPrice" name="minPrice" size="8" placeholder="最低价" value="<?=Yii::$app->request->get('minPrice')?>"> -
            <input type="text" class="form-control" id="maxPrice" name="maxPrice"  size="8" placeholder="最高价" value="<?=Yii::$app->request->get('maxPrice')?>">
                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="请输入商品名称或货号" value="<?=Yii::$app->request->get('keyword')?>">




            <button type="submit" class="btn btn-primary glyphicon glyphicon-search"></button>
        </form>
    </div>
</div>
<table class="table table-hover">
    <tr>
        <th>ID</th>
        <th>商品名称</th>
        <th>货号</th>
        <th>商品图片</th>
        <th>商品分类</th>
        <th>品牌分类</th>
        <th>市场价格</th>
        <th>本店价格</th>
        <th>库存</th>
        <th>是否上架</th>
        <th>状态</th>
        <th>排序</th>
        <th>添加商品时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr style="height: 60px" >
            <td><?=$model->id?></td>
            <td><?=mb_substr($model->name,0,5)?>...</td>
            <td><?=$model->sn?></td>
            <td><?=\yii\bootstrap\Html::img($model->logo,['height'=>50,'width'=>50])?></td>
            <td><?=$model->goodsCategory->name?></td>
            <td><?=$model->brand->name?></td>
            <td><?=$model->market_price?></td>
            <td><?=$model->shop_price?></td>
            <td><?=$model->stock?></td>
            <td><?=\backend\models\Goods::$onSaleText[$model->is_on_sale]?></td>
            <td><?=\backend\models\Goods::$statusText[$model->status]?></td>
            <td><?=$model->sort?></td>
            <td><?=date('Y-m-d H:i:s',$model->create_time)?></td>
            <td>
                <?=\yii\bootstrap\Html::a('',['update','id'=>$model->id,'goods_id'=>$model->id],['class'=>'btn btn-info glyphicon glyphicon-pencil'])?>
                <?=\yii\bootstrap\Html::a('',['delete','id'=>$model->id,'goods_id'=>$model->id],['class'=>'btn btn-danger glyphicon glyphicon-trash'])?>

            </td>
        </tr>
    <?php endforeach;?>

</table>

<?php
echo \yii\widgets\LinkPager::widget([

    'pagination' => $page
]);
?>