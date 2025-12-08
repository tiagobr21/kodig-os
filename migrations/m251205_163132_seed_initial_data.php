<?php

use yii\db\Migration;

class m251205_163132_seed_initial_data extends Migration
{
public function safeUp()
{
    // user 
    
    $password = Yii::$app->security->generatePasswordHash('adminos');
   
    $this->insert('{{%users}}', [
        'username' => 'admin',
        'password_hash' => $password,
        'auth_key' => Yii::$app->security->generateRandomString(),
        'created_at' => time(),
    ]);
    
    //os 

    $this->insert('{{%os}}', [
        'description' => 'Manutenção preventiva do equipamento X',
        'status' => 'pending',
        'created_at' => time(),
        'updated_at' => time(),
    ]);

    $osId = $this->db->getLastInsertID();

    $items = ['Limpeza realizada', 'Parafusos ajustados', 'Lubrificação aplicada'];

    foreach ($items as $item) {
        $this->insert('{{%os_checklist_items}}', [
            'os_id' => $osId,
            'item_label' => $item,
            'completed' => false,
        ]);
    }
}

    public function safeDown()
    {
        $this->delete('{{%users}}', ['username' => 'admin']);
        $this->delete('{{%os}}');
        $this->delete('{{%os_checklist_items}}');
    }

}
