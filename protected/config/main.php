<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => '3atnow - Online Restaurant Booking',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'theme' => 'bootstrap', // requires you to copy the theme under your themes directory
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'generatorPaths' => array(
                'bootstrap.gii',
            ),
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1', '192.168.0.103', '192.168.1.10'),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => false,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => true,
            'caseSensitive' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=127.0.0.1;dbname=xstore',
            'emulatePrepare' => true,
            'username' => 'xstore_user',
            'password' => 'hellostore',
            'charset' => 'utf8',
        ),
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
                /*
                array(
                    'class' => 'CWebLogRoute',
                ),
                 */
            ),
        ),
        // Session (DB)
        'session' => array(
            'class' => 'system.web.CDbHttpSession',
            'connectionID' => 'db',
            'sessionTableName' => 'session',
        ),
        // bootstrap
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',
        ),
        // GeoIP (Maxmind)
        'geoip' => array(
            'class' => 'ext.PcMaxmindGeoIp.PcMaxmindGeoIp',
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'yweichen@gmail.com',
    ),
    // Default language Yii::app()->language
    'language' => 'en',
);