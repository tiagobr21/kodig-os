<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class OsChecklist extends ActiveRecord
{
    public static function tableName()
    {
        return 'os_checklist_items'; // nome da tabela NO BANCO
    }

    public function rules()
    {
        return [
            [['os_id', 'item_label'], 'required'],
            [['os_id'], 'integer'],
            [['item_label'], 'string', 'max' => 255],
            [['completed'], 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'os_id' => 'Ordem de Serviço',
            'item_label' => 'Descrição do Checklist',
            'completed' => 'Concluído',
        ];
    }

    // cada checklist pertence a uma OS
    public function getOs()
    {
        return $this->hasOne(Os::class, ['id' => 'os_id']);
    }
}
