<?php
use yii\helpers\Html;

/** @var $os app\models\Os[] */
?>

<h1>Ordens de Serviço</h1>

<p><?= Html::a('Criar OS', ['create'], ['class' => 'btn btn-success']) ?></p>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Descrição</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($os as $item): ?>
        <tr>
            <td><?= $item->id ?></td>
            <td><?= $item->description ?></td>
            <td><?= $item->status ?></td>
            <td>
                <?= Html::a('Ver', ['view', 'id' => $item->id], ['class' => 'btn btn-primary btn-sm']) ?>
                <?= Html::a('Editar', ['update', 'id' => $item->id], ['class' => 'btn btn-warning btn-sm']) ?>
                <?= Html::a('Excluir', ['delete', 'id' => $item->id], [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => ['confirm' => 'Tem certeza?']
                ]) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
