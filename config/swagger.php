<?php

return [
    'scanDir' => [
        Yii::getAlias('@app/controllers'),
        Yii::getAlias('@app/models'),
    ],
    'outputDir' => '@runtime/swagger',
    'openApi' => [
        'info' => [
            'title' => 'API OS System',
            'version' => '1.0.0',
        ]
    ]
];
