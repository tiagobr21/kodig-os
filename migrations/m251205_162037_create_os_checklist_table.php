<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%os_checklist}}`.
 */
class m251205_162037_create_os_checklist_table extends Migration
{
    public function safeUp()
{
    $this->createTable('{{%os_checklist_items}}', [
        'id' => $this->primaryKey(),
        'os_id' => $this->integer()->notNull(),
        'item_label' => $this->string(255)->notNull(),
        'completed' => $this->boolean()->defaultValue(false),
    ]);

    $this->addForeignKey(
        'fk-checklist-os',
        '{{%os_checklist_items}}',
        'os_id',
        '{{%os}}',
        'id',
        'CASCADE',
        'CASCADE'
    );
}

public function safeDown()
{
    $this->dropForeignKey('fk-checklist-os', '{{%os}}');
    $this->dropTable('{{%os_checklist_items}}');
}

}
