<?php

namespace app\controllers;

use yii\web\Controller;
use light\swagger\SwaggerApiAction;

class SwaggerJsonController extends Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => SwaggerApiAction::class,
                'scanDir' => [
                    '@app/controllers',
                    '@app/models',
                    '@app/swagger',
                ],
            ],
        ];
    }
}
