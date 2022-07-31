<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Category}}`.
 */
class m220729_031742_create_Category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Category}}', [
            'id' => $this->primaryKey(),
        ]);
		$this->addColumn('Category', 'name', $this->string(64)->after('id'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Category}}');
    }
}
