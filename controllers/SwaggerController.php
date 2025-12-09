a<?php

namespace app\controllers;

use yii\web\Controller;
use light\swagger\SwaggerAction;

class SwaggerController extends Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => SwaggerAction::class,
                'apiJsonUrl' => ['/swagger-json/index'],
            ],
        ];
    }
}
