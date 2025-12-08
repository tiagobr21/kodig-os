<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OsChecklist;

class OsChecklistSearch extends OsChecklist
{
    public function rules()
    {
        return [
            [['id', 'os_id'], 'integer'],
            [['item_label'], 'safe'],
            [['completed'], 'boolean'],
        ];
    }

    public function scenarios()
    {
        // ignora cenários do pai
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = OsChecklist::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'os_id' => $this->os_id,
            'completed' => $this->completed,
        ]);

        $query->andFilterWhere(['like', 'item_label', $this->item_label]);

        return $dataProvider;
    }
}
