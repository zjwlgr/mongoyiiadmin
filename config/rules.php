<?php

return [
    //admin
    //'http://admin.yiiadmin.c' => 'admin/login/index',
    //'adminloginindex' => 'admin/index/default',



    //Rest ful
    /*['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
    相比于URL管理的Web应用程序，上述主要的新东西是通过RESTful API 请求yii\rest\UrlRule。这个特殊的URL规则类将会 建立一整套子URL规则来支持路由和URL创建的指定的控制器。 例如， 上面的代码中是大致按照下面的规则:
     *
    'PUT,PATCH users/<id>' => 'user/update',
    'DELETE users/<id>' => 'user/delete',
    'GET,HEAD users/<id>' => 'user/view',
    'POST users' => 'user/create',
    'GET,HEAD users' => 'user/index',
    'users/<id>' => 'user/options',
    'users' => 'user/options',
    */





    //mobile
    'http://m.form1.cn' => 'mobile', //绑定二级域名时，只写要绑定的模块名称
    'm-<one>-<two>-<id:\d+>' => 'mobile/index/content',
    'm-search' => 'mobile/index/search',
    'm-<class>' => 'mobile/index/list',
    'english' => 'mobile/topic/english',
    'math' => 'mobile/topic/math',


    //index
    '<one>-<two>-<id:\d+>' => 'index/index/content',
    'tools-json-format' => 'index/tools/index',
    'tools-unix-format' => 'index/tools/unix',
    'tools-md5-encrypt' => 'index/tools/md5',
    'tools-url-encoding' => 'index/tools/url',
    'search' => 'index/index/search',
    '<class>' => 'index/index/list',



    /*[//配置组方式
        'pattern' => 'posts/<page:\d+>/<tag>',//规则
        'route' => 'post/index',//目标地址
        'defaults' => ['page' => 1, 'tag' => ''],//所有参数
        'suffix' => '.json',//后缀
    ]*/

    /*  实现REST风格的API,默认GET
     * 'PUT,POST post/<id:\d+>' => 'post/create',
     * 'DELETE post/<id:\d+>' => 'post/delete',
     * 'post/<id:\d+>' => 'post/view',
    */

    /*简单二级域名规则
     * 'http://admin.example.com/login' => 'admin/user/login',
     * 'http://www.example.com/login' => 'site/login',
     * */

];
