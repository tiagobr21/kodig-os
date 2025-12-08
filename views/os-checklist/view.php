<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\OsChecklist $model */

$this->title = "Item #{$model->id}";
$this->params['breadcrumbs'][] = ['label' => 'Checklist da OS', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="os-checklist-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza que deseja excluir?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'os_id',
            'item_label',
            [
                'attribute' => 'completed',
                'value' => $model->completed ? 'Sim' : 'Não',
            ],
        ],
    ]) ?>

</div>
