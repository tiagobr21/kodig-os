<?php
use yii\helpers\Html;

?>

<h1>OS #<?= $model->id ?></h1>

<p><strong>Descrição:</strong> <?= $model->description ?></p>
<p><strong>Status:</strong> <?= $model->status ?></p>

<hr>

<h3>Checklist</h3>
<p><?= Html::a('Adicionar Item', ['/os-checklist/create', 'os_id' => $model->id], ['class' => 'btn btn-success']) ?></p>

<table class="table table-bordered">
    <tr>
        <th>Item</th>
        <th>Concluído</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($checklist as $c): ?>
        <tr>
            <td><?= $c->item_label ?></td>
            <td><?= $c->completed ? "✔️" : "❌" ?></td>
            <td>
                <?= Html::a('Editar', ['/os-checklist/update', 'id' => $c->id], ['class' => 'btn btn-warning btn-sm']) ?>
                <?= Html::a('Excluir', ['/os-checklist/delete', 'id' => $c->id], [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => ['confirm' => 'Tem certeza?']
                ]) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<hr>

<h3>Fotos</h3>
<p><?= Html::a('Enviar Foto', ['/os-photos/upload', 'os_id' => $model->id], ['class' => 'btn btn-primary']) ?></p>

<div class="row">
    <?php foreach ($photos as $p): ?>
        <div class="col-md-3">
            <img src="/<?= $p->path ?>" class="img-thumbnail" style="width: 100%; height: auto;">
            <p>
                <?= Html::a('Excluir', ['/os-photos/delete', 'id' => $p->id], [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => ['confirm' => 'Remover foto?']
                ]) ?>
            </p>
        </div>
    <?php endforeach; ?>
</div>
