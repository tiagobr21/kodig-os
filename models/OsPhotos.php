<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class OsPhotos extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%os_photos}}';
    }

    public function rules()
    {
        return [
            [['os_id', 'path'], 'required'],
            [['os_id', 'created_at'], 'integer'],
            [['path'], 'string', 'max' => 255],
        ];
    }

    public function getOs()
    {
        return $this->hasOne(Os::class, ['id' => 'os_id']);
    }
}
