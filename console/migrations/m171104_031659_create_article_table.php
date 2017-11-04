<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m171104_031659_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(100)->notNull()->comment('文章名'),
            'intro'=>$this->text()->comment("文章简介"),
            'article_category_id'=>$this->smallInteger()->notNull()->comment('文章分类'),
            'status'=>$this->smallInteger()->notNull()->defaultValue(0)->comment('状态@1=显示&0=隐藏'),
            'sort'=>$this->smallInteger()->notNull()->defaultValue(100)->comment('文章排序'),
            'create_time'=>$this->integer()->notNull()->defaultValue(0)->comment('文章录入时间')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
