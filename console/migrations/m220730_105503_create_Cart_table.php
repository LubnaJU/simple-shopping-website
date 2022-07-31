<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Cart}}`.
 */
class m220730_105503_create_Cart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Cart}}', [
            'id' => $this->primaryKey(),
        ]);
		$this->addColumn('Cart', 'user_id', $this->integer());
		$this->addColumn('Cart', 'product_id', $this->integer());
		$this->addColumn('Cart', 'quantity', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Cart}}');
    }
}
