<?php
$config = [
    'id' => 'basic',
    'version' => '1.0',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'index',
    //'catchAll' => ['site/offline'],//全拦截路由
    'modules' => [
        'index'  => 'app\modules\index\Module',
        'admin'  => 'app\modules\admin\Module',
        'mobile' => 'app\modules\mobile\Module',
        'api'    => 'app\modules\api\Module'
    ],
    'aliases' => [//自定义别名
        '@foo' => '/path/to/foo',
        '@bar' => 'http://www.example.com',
    ],
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'components' => [
        //API时响应处理(任何响应都会触发)，已在API模块中处理
        /*'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                $r = $response->data;
                if (is_array($r) && $r['m'] == 'api') {//当前moduel为api时处理响应事件
                    unset($r['m']);
                    $response->data = [
                        //'success' => $response->isSuccessful,
                        'message' => 'success',
                        'status' => 200,
                        'data' => $r,
                    ];
                    $response->statusCode = 200;
                }
            },
        ],*/
        'myhelper' => [
            'class' => 'app\commands\Form1Helper',//自定义组件
        ],
        'urlManager' => [
            'enablePrettyUrl'     => true,//属性强制它切换漂亮的URL格式
            'showScriptName'      => false,//是否显示入口index.php名称
            'enableStrictParsing' => false,//此属性确定是否启用严格要求解析
            'suffix'              => '.html',
            'rules'               => require(__DIR__ . '/rules.php'),
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey'  => 'FR1BNEnrSyIVFjrwbMsdbgYZCdeMjRpG',
            'enableCsrfValidation' => true,//开启或关闭验证_csrf
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,//是否开启自动登录
            //'enableSession' => false,//请求中的用户认证状态就不能通过session来保持
            //'loginUrl' => null,//显示一个HTTP 403 错误而不是跳转到登录界面
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        /*'db' => [
            'class'       => 'yii\db\Connection',
            'dsn'         => 'mysql:host=127.0.0.1;dbname=yiiadmin',
            'username'    => 'root',
            'password'    => '123456',
            'charset'     => 'utf8',
            'tablePrefix' => 'yi_',
        ],*/
        'mongodb' => [
            'class' => 'yii\mongodb\Connection',
            'dsn'   => 'mongodb://root:123456@121.42.231.177:27017/dataname',
        ],
    ],
    'params' => require(__DIR__ . '/params.php'),
];

if (YII_ENV_DEV) {
    // 根据 `dev` 环境进行的配置调整
    //$config['bootstrap'][] = 'debug';//开启或关闭调试工具
    //$config['modules']['debug'] = ['class' => 'yii\debug\Module'];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
