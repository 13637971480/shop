<?php

use yii\db\Migration;

/**
 * Handles the creation of table `promotion`.
 */
class m171107_063953_create_promotion_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('promotion', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(20)->notNull()->comment('促销名称'),
            'start_time'=>$this->integer()->unsigned()->comment('促销开始'),
            'end_time'=>$this->integer()->unsigned()->comment('促销结束')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('promotion');
    }
}
