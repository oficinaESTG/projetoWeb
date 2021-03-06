<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'api' => [
            'class' => 'backend\modules\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' =>
                    [
                        'api/car',
                        'api/mar',
                        'api/reg',
                        'api/per'
                    ],
                    'pluralize' => false,
                    'extraPatterns' => [
                        //Métodos do CarController
                        'POST carrocreate' => 'carrocreate',
                        'GET carroget' => 'carroget',
                        'GET carrovendaget' => 'carrovendaget',
                        'PUT carroput/{id}' => 'carroput',
                        'DELETE carrodel/{id}' => 'carrodel',
                        //Métodos do MarController
                        'POST marcacaocreate' => 'marcacaocreate',
                        'POST marcacaovendacreate' => 'marcacaovendacreate',
                        'GET marcacaoget' => 'marcacaoget',
                        //Métodos do PerController
                        'GET pessoaget' => 'pessoaget',
                        'PUT pessoaput/{id}'  => 'pessoaput',
                        //Métodos do RegController
                        'POST registar' => 'registar',
                        'POST login' => 'login',
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>', //O standard tem que aparecer!
                        '{limit}' => '<limit:\\d+>',


                    ],

                        
                ],
            ],
        ],

    ],
    'params' => $params,
];
