<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
?>

<div class="site-login" style="max-width:400px;margin:40px auto;">
    <h1 style="text-align:center;margin-bottom:20px;">Acesso ao Sistema</h1>

    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="form-group" style="text-align:center;">
            <?= Html::submitButton('Entrar', [
                'class' => 'btn btn-primary',
                'name' => 'login-button'
            ]) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
