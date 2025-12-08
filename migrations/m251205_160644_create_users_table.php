<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m251205_160644_create_users_table extends Migration
{
  public function safeUp()
{
    $this->createTable('{{%users}}', [
        'id' => $this->primaryKey(),
        'username' => $this->string(100)->notNull()->unique(),
        'password_hash' => $this->string()->notNull(),
        'auth_key' => $this->string(32),
        'access_token' => $this->string(255),
        'created_at' => $this->integer(),
        'updated_at' => $this->integer(),
    ]);
}

public function safeDown()
{
    $this->dropTable('{{%users}}');
}

}
