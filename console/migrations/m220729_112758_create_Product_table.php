<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Product}}`.
 */
class m220729_112758_create_Product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Product}}', [
            'id' => $this->primaryKey(),
        ]);
		$this->addColumn('Product', 'name', $this->string(64));
		$this->addColumn('Product', 'category_name', $this->string(64));
		$this->addColumn('Product', 'price', $this->integer());
		$this->addColumn('Product', 'imageFile', $this->string(64));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Product}}');
    }
}
