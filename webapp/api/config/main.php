<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'name' => 'Pet4all',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-api',
            'cookieValidationKey' => 'Xwf3Djk4sS2IqqGlhiUBQDbp_rbYhtcp',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser'
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'animal',
                    'pluralize' => false
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'user',
                    'tokens' => [
                        '{username}' => '<username:\\w+>',
                        '{password}' => '<password:\\w+>'
                    ],
                    'extraPatterns' => [
                        'GET authentication/{username}/{password}' => 'authentication'
                    ],
                    //'pluralize' => false
                ]
            ]
        ]
    ],
    'params' => $params,
];
