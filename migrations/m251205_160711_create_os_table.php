<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%os}}`.
 */
class m251205_160711_create_os_table extends Migration
{
   public function safeUp()
{
    $this->createTable('{{%os}}', [
        'id' => $this->primaryKey(),
        'description' => $this->text()->notNull(),
        'status' => $this->string(20)->defaultValue('pending'),
        'checklist_template' => $this->json(), // modelo inicial
        'created_at' => $this->integer(),
        'updated_at' => $this->integer(),
        'created_by' => $this->integer(),
    ]);

    $this->addForeignKey(
        'fk-os-created_by',
        '{{%os}}',
        'created_by',
        '{{%users}}',
        'id',
        'SET NULL',
        'CASCADE'
    );
}

public function safeDown()
{
    $this->dropForeignKey('fk-os-created_by', '{{%os}}');
    $this->dropTable('{{%os}}');
}

}
