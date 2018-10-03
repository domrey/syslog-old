<?php
use kartik\datecontrol\Module;
use kartik\mpdf\Pdf;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$language='es-MX';
$zone='America/Mexico_City';
$dFormat='php:d-M-Y';
$sFormat='php:Y-m-d';

$config = [
    'id' => 'syslog',
    'name' => 'Departamento de Logística',
    'language' => $language,
    'timeZone' => $zone,
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Mu5OjSLPX5XZuemmrkBqrLrCSkxWBR43',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'pdf' => [
          'class'=>Pdf::classname(),
          'format'=>Pdf::FORMAT_LETTER,
          'orientation'=>Pdf::ORIENT_PORTRAIT,
          'mode'=>Pdf::MODE_UTF8,
        ],
        'formatter'=>[
          'dateFormat'=>$dFormat,
          'decimalSeparator'=>'.',
          'thousandSeparator'=>',',
          'currencyCode'=>'MXN',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

    ],
    'modules' => [
          'rh' => [
              'class' => 'app\modules\rh\Module',
           ],
           'gridview' => [
              'class' => '\kartik\grid\Module'
           ],
           'datecontrol' => [
              'class' => 'kartik\datecontrol\Module',
              // format settings for displaying each date attribute
              'displaySettings' => [
                Module::FORMAT_DATE => $dFormat,
                Module::FORMAT_TIME => 'H:i:s A',
                Module::FORMAT_DATETIME => 'd-m-Y H:i:s a',
              ],
              // format settings for saving each date attribute
              'saveSettings' => [
                //'date' => 'Y-m-d',
                //'time' => 'H:i:s',
                //'datetime' => 'Y-m-d H:i:s',
                Module::FORMAT_DATE => 'php:Y-m-d',
                //Module::FORMAT_DATE => 'php:U',
                Module::FORMAT_TIME => 'H:i:s',
                Module::FORMAT_DATETIME => 'Y-m-d H:i:s',
              ],
              'displayTimezone'=>$zone,
              'saveTimezone'=>$zone,
              // automatically use kartik\widgets for each of the above formats
              'autoWidget' =>true,
              'ajaxConversion'=>true,
              'autoWidgetSettings' => [
                Module::FORMAT_DATE => [
                  //'type'=>2,
                  'type'=>kartik\widgets\DatePicker::TYPE_COMPONENT_APPEND,
                  'removeButton'=>false,
                  'pluginOptions'=>[
                    'autoclose'=>true,
                    'todayHighlight'=>true,
                    'todayBtn'=>false,
                    'calendarWeeks'=>true,
                    'daysOfWeekHighlighted'=>[0,6],
                  ],
                ], // example
                Module::FORMAT_DATETIME => [], // setup if needed
                Module::FORMAT_TIME => [], // setup if needed
              ],
                // custom widget settings that will be used to render the date input instead of kartik\widgets,
                // this will be used when autoWidget is set to false at module or widget level.
                'widgetSettings' => [
                  Module::FORMAT_DATE => [
                    'class' => 'yii\jui\DatePicker', // example
                    'options' => [
                        'dateFormat' => $dFormat,
                        'options' => ['class'=>'form-control'],
                    ],
                  ],
              ]
            ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
