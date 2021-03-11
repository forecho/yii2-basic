<?php

use yii\helpers\Url;

$common = require(__DIR__ . '/common.php');
$params = require __DIR__ . '/params.php';
$bundles = require __DIR__ . '/bundles.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'multiLanguage'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'on beforeAction' => function ($event) {
        Yii::createObject([
            'class' => \yiier\returnUrl\ReturnUrl::class,
            'uniqueIds' => ['site/qrcode', 'site/login', 'site/signup']
        ])->beforeAction();
    },
    'components' => [
        'request' => [
            'class' => \skeeks\yii2\multiLanguage\MultiLangRequest::class,
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'KglzanqLG2k_Eu-kbNNwds6frnVlWUS7',
//            'enableCsrfValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'view' => [
            'as seo' => [
                'class' => 'yiier\seo\SeoViewBehavior',
                'names' => [
                    'referrer' => 'no-referrer',
                    'title' => getenv('APP_NAME') . '-' . getenv('SEO_DESCRIPTION'),
                    'keywords' => getenv('SEO_KEYWORDS'),
                    'description' => getenv('APP_NAME') . getenv('SEO_DESCRIPTION'),
                    'og:site_name' => getenv('APP_NAME') . '-' . getenv('SEO_DESCRIPTION'),
                ],
                'properties' => [
                    [
                        'property' => ['og:title', 'title', 'twitter:title'],
                        'content' => getenv('APP_NAME') . '-' . getenv('SEO_DESCRIPTION'),
                    ],
                    [
                        'property' => ['og:description', 'description', 'twitter:description'],
                        'content' => getenv('SEO_DESCRIPTION'),
                    ],
                    [
                        'property' => ['og:image', 'twitter:image'],
                        'content' => function () {
                            return Url::to('/favicon.png', true);
                        },
                    ],
                    'og:type' => 'website',
                    'og:url' => function () {
                        return Url::current([], true);
                    }
                ],
            ]
        ],
        'response' => [
            'class' => 'yii\web\Response',
        ],
        'assetManager' => [
            'linkAssets' => true, // 符号链接资源
            'bundles' => $bundles // CDN
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        // 'defaultRoute' => 'topic/default/index',
        'urlManager' => [
            'class' => \skeeks\yii2\multiLanguage\MultiLangUrlManager::class,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['pattern' => 'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<module>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
            ],
        ],
        'multiLanguage' => [
            'class' => \skeeks\yii2\multiLanguage\MultiLangComponent::class,
            'langs' => ['zh-CN', 'zh-TW'],
            'default_lang' => 'zh-CN',         //Language to which no language settings are added.
            'lang_param_name' => 'lang',
        ]
    ],
    'params' => $params,
    'container' => [
        'definitions' => [
            \yii\widgets\LinkPager::class => \yii\bootstrap4\LinkPager::class,
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return \yii\helpers\ArrayHelper::merge($common, $config);
