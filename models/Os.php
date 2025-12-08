<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Os extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%os}}';
    }

    public function rules()
    {
        return [
            [['description', 'status'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 30]
        ];
    }

    public function getChecklist()
    {
        return $this->hasMany(OsChecklist::class, ['os_id' => 'id']);
    }

    public function getPhotos()
    {
        return $this->hasMany(OsPhotos::class, ['os_id' => 'id']);
    }

    public function updateStatusFromChecklist()
    {
        $query = $this->getChecklist();

        // se não há itens, mantém o status atual
        if ($query->count() == 0) {
            return;
        }

        // conta total e quantos concluídos
        $total = $query->count();
        $done = $query->andWhere(['completed' => 1])->count();

        if ($done === $total) {
            $this->status = 'concluida';
        } else {
            $this->status = 'em_andamento';
        }

        // salva sem validar (apenas atualizar status)
        $this->save(false);
    }
    
}
