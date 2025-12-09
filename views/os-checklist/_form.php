<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\OsChecklist $model */
/** @var array $osList */

$this->title = "Criar Checklist";
?>
<div class="os-checklist-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'os_id')->dropDownList(
        ArrayHelper::map($osList, 'id', 'description'),
        ['prompt' => 'Selecione a Ordem de Serviço']
    ) ?>

    <?= $form->field($model, 'item_label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'completed')->checkbox() ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
