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

        <tr data-lft="<?=$model->lft?>" data-rgt="<?=$model->rgt?>" data-tree="<?=$model->tree?>">
            <td><?=$model->id?></td>
            <td><?=$model->nameText?></td>
            <td><?=$model->parent_id?></td>
            <td>
                <span class="glyphicon glyphicon-minus-sign cate"></span>
                <?=\yii\bootstrap\Html::a('',['update','id'=>$model->id],['class'=>'btn btn-info glyphicon glyphicon-pencil'])?>
                <?=\yii\bootstrap\Html::a('',['delete','id'=>$model->id],['class'=>'btn btn-danger glyphicon glyphicon-trash'])?>
            </td>
        </tr>


    <?php endforeach;?>

</table>


<?php
$js=<<<EOF
  $(".cate").click(function(){
      
       $(this).toggleClass("glyphicon-minus-sign");
       $(this).toggleClass("glyphicon-plus-sign");
       
  
       var tr= $(this).parent().parent();
       
       var lft=tr.attr('data-lft');
       var rgt=tr.attr('data-rgt');
       
       var tree=tr.attr('data-tree');
       
       
       /*得到所有的tr*/
       
     var trs= $("tr")
       
       $.each(trs,function(k,v){
       
       var treePer=$(v).attr('data-tree');  
       var lftPer=$(v).attr('data-lft');
       var rgtPer=$(v).attr('data-rgt');
        console.log($(v).attr('data-lft'),$(v).attr('data-rgt'));
        
        if(tree==treePer && lftPer-lft>0 && rgtPer - rgt<0){
        
        $(v).toggle();
        }
       
       })
       
        
        
        
        
        
    });



EOF;

$this->registerJs($js);

?>

<script>
    $(".cate").click(function(){

        console.log(2);
    });


</script>