<?php

use yii\db\Migration;

/**
 * Handles the creation of table `brand`.
 */
class m171103_080437_create_brand_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('brand', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull()->defaultValue('')->comment('名称'),
            'intro' => $this->text()->comment('简介'),
            'logo' => $this->string(100)->notNull()->comment('图片'),
            'status' => $this->integer()->notNull()->defaultValue('1')->comment('状态'),
            'sort'=>$this->integer()->defaultValue('100')->comment('排序'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('brand');
    }
}
