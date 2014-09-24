<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
    //'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name' => 'Africa Press List',
    // preloading 'log' component
    'preload' => array('log'),
    'preload' => array('booster'),
    "aliases" => array(
        "packages" => dirname(__DIR__) . "/packages/",
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
        'application.extensions.solr.*',
        'application.packages.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'user' => array(
            'tableUsers' => 'users',
            'tableProfiles' => 'profiles',
            'tableProfileFields' => 'profiles_fields',
            # encrypting method (php hash function)
            'hash' => 'md5',
            # send activation email
            'sendActivationMail' => true,
            # allow access for non-activated users
            'loginNotActiv' => false,
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => FALSE,
            # automatically login from registration
            'autoLogin' => true,
            # registration path
            'registrationUrl' => array('/user/registration'),
//            # registration path
//            'registrationCUrl' => array('/userC/registration'),
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
            # login form path
            'loginUrl' => array('/user/login'),
            # page after login
            'returnUrl' => array('/user/profile'),
            # page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),
        'rights' => array(
            'superuserName' => 'Admin', // Name of the role with super user privileges.
            'authenticatedName' => 'Authenticated', // Name of the authenticated user role.
            'userIdColumn' => 'id', // Name of the user id column in the database.
            'userNameColumn' => 'username', // Name of the user name column in the database.
            'enableBizRule' => true, // Whether to enable authorization item business rules.
            'enableBizRuleData' => false, // Whether to enable data for business rules.
            'displayDescription' => true, // Whether to use item description instead of name.
            'flashSuccessKey' => 'RightsSuccess', // Key to use for setting success flash messages.
            'flashErrorKey' => 'RightsError', // Key to use for setting error flash messages.
            'install' => true, // Whether to install rights.
            'baseUrl' => '/rights', // Base URL for Rights. Change if module is nested.
            'layout' => 'rights.views.layouts.main', // Layout to use for displaying Rights.
            'appLayout' => 'application.views.layouts.main', // Application layout.
            'cssFile' => 'rights.css', // Style sheet file to use for Rights.
            'install' => false, // Whether to enable installer.
            'debug' => false, // Whether to enable debug mode.
        ),
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '0000',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    //Array('sourceLanguage'=>'en','language'=>'de'),
    // application components
    'components' => array(
        'Paypal' => array(
            'class' => 'application.components.Paypal',
            'apiUsername' => 'mohamedaymen.mastouri-facilitator_api1.esprit.tn',
            'apiPassword' => '1407448515',
            'apiSignature' => 'ASIxIIKpi7xROmHHHOfwKK9FrsJ9AifN-gJkvT8Rn6FM.4EQMCZJ7DYP',
            'apiLive' => false,
            'returnUrl' => '/user/registrationClient/confirm/', //regardless of url management component
            'cancelUrl' => '/user/registrationClient/cancel/', //regardless of url management component
            // Default currency to use, if not set USD is the default
            'currency' => 'EUR',
        // Default description to use, defaults to an empty string
        //'defaultDescription' => '',
        // Default Quantity to use, defaults to 1
        // 'defaultQuantity' => '1',
        //The version of the paypal api to use, defaults to '3.0' (review PayPal documentation to include a valid API version)
        //'version' => '3.0',
        ),
         'PaypalExt' => array(
            'class' => 'application.components.PaypalExt',
            'apiUsername' => 'mohamedaymen.mastouri-facilitator_api1.esprit.tn',
            'apiPassword' => '1407448515',
            'apiSignature' => 'ASIxIIKpi7xROmHHHOfwKK9FrsJ9AifN-gJkvT8Rn6FM.4EQMCZJ7DYP',
            'apiLive' => false,
            'returnUrl' => '/client/confirm/', //regardless of url management component
            'cancelUrl' => '/client/cancel/', //regardless of url management component
            // Default currency to use, if not set USD is the default
            'currency' => 'EUR',
        // Default description to use, defaults to an empty string
        //'defaultDescription' => '',
        // Default Quantity to use, defaults to 1
        // 'defaultQuantity' => '1',
        //The version of the paypal api to use, defaults to '3.0' (review PayPal documentation to include a valid API version)
        //'version' => '3.0',
        ),
         'PaypalCredits' => array(
            'class' => 'application.components.PaypalCredits',
            'apiUsername' => 'mohamedaymen.mastouri-facilitator_api1.esprit.tn',
            'apiPassword' => '1407448515',
            'apiSignature' => 'ASIxIIKpi7xROmHHHOfwKK9FrsJ9AifN-gJkvT8Rn6FM.4EQMCZJ7DYP',
            'apiLive' => false,
            'returnUrl' => '/client/ConfirmBuyCredits/', //regardless of url management component
            'cancelUrl' => '/client/cancelBuyCredits/', //regardless of url management component
            // Default currency to use, if not set USD is the default
            'currency' => 'EUR',
        // Default description to use, defaults to an empty string
        //'defaultDescription' => '',
        // Default Quantity to use, defaults to 1
        // 'defaultQuantity' => '1',
        //The version of the paypal api to use, defaults to '3.0' (review PayPal documentation to include a valid API version)
        //'version' => '3.0',
        ),
        'mandrillwrap' => array(
            'class' => 'ext.mandrillwrap.mandrillwrap',
        ),
        'webhooks' => array(
            'class' => 'ext.webhooks.webhooks',
        ),
//            'contactSearch'=>array(
//            'class'=>'CSolrComponent',
//            'host'=>'localhost',
//            'port'=>80,
//            'indexPath'=>'/listContact/create'
//        ),
//      'commentSearch'=>array(
//            'class'=>'CSolrComponent',
//            'host'=>'localhost',
//            'port'=>80,
//            'indexPath'=>'/solr/comment'
//        ),
        "solr" => array(
            "class" => "packages.solr.ASolrConnection",
            "clientOptions" => array(
                "hostname" => "localhost",
                "port" => 8983,
            ),
        ),
        'curl' => array(
            'class' => 'ext.curl.curl',
            'options' => array(/* additional curl options */),
        ),
        'user' => array(
            'class' => 'RWebUser',
            
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl' => array('/user/login'),
        ),
        // uncomment the following to enable URLs in path-format
        'authManager' => array(
            'class' => 'RDbAuthManager',
        ),
        'mail' => array(
            'class' => 'ext.yii-mail.YiiMail',
            'transportType' => 'smtp',
            'transportOptions' => array(
                'host' => 'mail.yetgroup.com',
                'username' => 'web2@yetgroup.com',
                'password' => 'gCDWdlDx',
                'port' => '25',
            //'encryption'=>'',
            ),),
        'urlManager' => array(
            'class' => 'ext.yii-multilanguage.MLUrlManager',
            'urlFormat' => 'path',
            'languages' => array(
                #...
                'de',
                'el',
                'en',
                'es',
                'fr',
                'hu',
                'ja',
                'nl',
                'pl',
                'pt',
                'ro',
                'ru',
                'uk',
            ),
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<id:\d+>/<action:\w+>' => '<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>' => '<module>/<controller>',
                '<module:\w+>' => '<module>',
            ),
        ),
       // 'db' => array(
       //     'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
       // ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=presslist',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ),
//            
//                'db'=>array(
//			'connectionString' => 'mysql:host=localhost;dbname=webside_apl',
//			'emulatePrepare' => true,
//			'username' => 'webside_apl',
//			'password' => 'F}-LT[Z3Vns2',
//			'charset' => 'utf8',
//		),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                array(
                    'class' => 'CWebLogRoute',
                ),
            ),
        ),
        'booster' => array(
            'class' => 'ext.yiibooster.components.Booster',
        ),
    ),
    'sourceLanguage' => 'en',
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'administrator@africapresslist.com',
    ),
);
