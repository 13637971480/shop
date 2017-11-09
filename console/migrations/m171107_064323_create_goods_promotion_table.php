<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_promotion`.
 */
class m171107_064323_create_goods_promotion_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_promotion', [
            'id' => $this->primaryKey(),
            'goods_id'=>$this->integer()->unsigned()->comment('商品ID'),
            'promotion'=>$this->integer()->unsigned()->comment('促销类型ID')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_promotion');
    }
}
