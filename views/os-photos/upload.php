<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<h1>Enviar Foto</h1>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

<input type="file" name="photo" class="form-control" required>

<br>

<?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>
