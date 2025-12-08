<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Checklist da OS';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="os-checklist-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'os_id',
            'item_label',
            [
                'attribute' => 'completed',
                'value' => fn($model) => $model->completed ? 'Sim' : 'Não',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]) ?>

</div>
