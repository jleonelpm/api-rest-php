<?php
return [
    'id' => 'micro-app',
    // the basePath of the application will be the `micro-app` directory
    'basePath' => __DIR__,
    // this is where the application will find all controllers
    'controllerNamespace' => 'micro\controllers',
    // set an alias to enable autoloading of classes from the 'micro' namespace
    'aliases' => [
        '@micro' => __DIR__,
    ],

    'components' => [
        'request' => [
            'enableCookieValidation' => false,// also set it to true
            'enableCsrfValidation' => false, // also set it to true            
            #'cookieValidationKey' => '1223456789',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]            
        ],
        'db' => [
            'class' => '\yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=backgroundchanger',
            'username' => 'root',
            'password' => 'developer',
            'charset' => 'utf8',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => 
                [
                    'POST login' => 'site/login',  
                    'data' => 'site/data',                                       
                ],
        ],
        //https://github.com/sizeg/yii2-jwt
        'jwt' => [
            'class' => \sizeg\jwt\Jwt::class,
            'key' => '0123456789',
            // You have to configure ValidationData informing all claims you want to validate the token.
            'jwtValidationData' => \app\components\JwtValidationData::class,
        ],   
    ],

    'params' => [
        'jwt' => [
            'issuer' => 'https://api-rest',  //name of your project (for information only)
            'audience' => 'https://api-rest',  //description of the audience, eg. the website using the authentication (for info only)
            'id' => '4f1g23a12aa',  //a unique identifier for the JWT, typically a random string
            'expire' => 3000,  //the short-lived JWT token is here set to expire after 50 min.
        ],            
    ],
    
];
