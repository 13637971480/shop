<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m171107_064704_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username'=>$this->string(50)->notNull()->comment('用户名'),
            'password'=>$this->string(32)->notNull()->comment('密码'),
            'salt'=>$this->string(6)->notNull()->comment('盐'),
            'email'=>$this->string(30)->notNull()->comment('邮箱'),
            'token'=>$this->string(30)->notNull()->comment('自动登录令牌'),
            'token_create_time'=>$this->integer()->unsigned()->comment('令牌创建时间'),
            'add_time'=>$this->integer()->notNull()->comment('注册时间'),
            'last_login_time'=>$this->integer()->notNull()->comment('最后登录时间'),
            'last_login_ip'=>$this->string(20)->comment('最后登录ip')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}
