<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */
class m171104_033620_create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->notNull()->comment('文章分类名'),
            'intro'=>$this->text()->comment('简介'),
            'status'=>$this->smallInteger()->notNull()->defaultValue(1)->comment('状态@1=显示&0=隐藏'),
            'sort'=>$this->smallInteger()->notNull()->defaultValue(100)->comment('排序'),
            'is_help'=>$this->smallInteger()->notNull()->defaultValue(0)->comment('是否是帮助分类@1=是&0=否')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_category');
    }
}
