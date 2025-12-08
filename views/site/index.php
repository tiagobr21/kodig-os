<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Bem-vindo ao Sistema de Ordens de Serviço';
?>

<div class="site-index" style="text-align: center; margin-top: 60px;">

    <h1 style="font-size: 32px; font-weight: bold; margin-bottom: 20px;">
       Bem-vindo ao Sistema de Ordens de Serviço da Kodigos
    </h1>

    <p style="font-size: 18px; color: #555; margin-bottom: 40px;">
        Gerencie ordens, checklist e fotos de forma rápida e eficiente.
    </p>

    <a href="<?= Url::to(['os/index']) ?>" 
       style="
            background-color: #2a8cff;
            color: white;
            padding: 14px 26px;
            font-size: 18px;
            text-decoration: none;
            border-radius: 8px;
            display: inline-block;
       ">
        📄 Acessar Ordens de Serviço
    </a>

</div>
