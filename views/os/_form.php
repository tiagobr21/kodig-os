<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>
<?= $form->field($model, 'status')->dropDownList([
    'pending' => 'Pendente',
    'in_progress' => 'Em andamento',
    'done' => 'Concluída'
]) ?>

<div class="form-group">
    <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
