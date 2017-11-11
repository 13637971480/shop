<h1>管理员管理</h1>
<?=\yii\bootstrap\Html::a('添加管理员',['create'],['class'=>'btn btn-success'])?>
<table class="table table-hover">
    <tr>
        <th>ID</th>
        <th>管理员账号</th>
        <th>邮箱</th>
        <th>创建时间</th>
        <th>最后登录时间</th>
        <th>最后登录IP</th>
        <th>角色</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr style="height: 60px">
            <td><?=$model->id?></td>
            <td><?=$model->username?></td>
            <td><?=$model->email?></td>
            <td><?=date('Y-m-d H:i:s',$model->add_time)?></td>
            <td><?=date('Y-m-d H:i:s',$model->last_login_time)?></td>
            <td><?=$model->last_login_ip?></td>
            <td>
                <?php
                //实例化RBAC组件
                $auth = Yii::$app->authManager;
                //得到当前用户所有角色
                $pers = $auth->getRolesByUser($model->id);
                //循环出所有角色
                foreach ($pers as $per){
                    echo $per->description.'|';
                }
                ?>
            </td>
            <td>
                <?=\yii\bootstrap\Html::a('修改',['update','id'=>$model->id],['class'=>'btn btn-info'])?>
                <?=\yii\bootstrap\Html::a('删除',['delete','id'=>$model->id],['class'=>'btn btn-danger'])?>

            </td>
        </tr>
    <?php endforeach;?>

</table>
