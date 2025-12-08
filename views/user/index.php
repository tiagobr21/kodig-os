<?php
use yii\helpers\Html;

?>

<h1>Usuários</h1>

<p><?= Html::a('Criar Usuário', ['create'], ['class' => 'btn btn-success']) ?></p>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($users as $u): ?>
        <tr>
            <td><?= $u->id ?></td>
            <td><?= $u->username ?></td>
            <td>
                <?= Html::a('Editar', ['update', 'id' => $u->id], ['class' => 'btn btn-primary btn-sm']) ?>
                <?= Html::a('Excluir', ['delete', 'id' => $u->id], [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => ['confirm' => 'Tem certeza?']
                ]) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
