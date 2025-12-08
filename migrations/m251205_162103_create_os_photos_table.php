<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%os_photos}}`.
 */
class m251205_162103_create_os_photos_table extends Migration
{
    public function safeUp()
{
    $this->createTable('{{%os_photos}}', [
        'id' => $this->primaryKey(),
        'os_id' => $this->integer()->notNull(),
        'path' => $this->string(255)->notNull(),
        'created_at' => $this->integer(),
    ]);

    $this->addForeignKey(
        'fk-photos-os',
        '{{%os_photos}}',
        'os_id',
        '{{%os}}',
        'id',
        'CASCADE',
        'CASCADE'
    );
}

public function safeDown()
{
    $this->dropForeignKey('fk-photos-os', '{{%os_photos}}');
    $this->dropTable('{{%os_photos}}');
}

}
