

<h1>角色管理</h1>

<?php echo  \yii\bootstrap\Html::a('添加角色',['create'],['class'=>'btn btn-warning'])?>
<table class="table table-hover">
    <tr>
        <th>角色</th>
        <th>角色描述</th>
        <th>权限</th>
        <th>操作</th>
    </tr>

    <?php foreach ($roles as $role):?>
        <tr>
            <td><?=$role->name?></td>
            <td><?=$role->description?></td>
            <td>
                <?php
                //实例化RBAC组件
                $auth = Yii::$app->authManager;
                //得到当前对象所有权限
                $pers = $auth->getPermissionsByRole($role->name);
                //循环出所有权限
                foreach ($pers as $per){
                    echo $per->description.'|';
                }

            ?>
            </td>
            <td>
                <?= \yii\bootstrap\Html::a('修改',['update','name'=>$role->name],['class'=>'btn btn-info'])?>
                <?= \yii\bootstrap\Html::a('删除',['delete','name'=>$role->name],['class'=>'btn btn-danger'])?>

            </td>
        </tr>



    <?php endforeach;?>


</table>
