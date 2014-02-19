<?php
/*****************************************************************************************
 * X2Engine Open Source Edition is a customer relationship management program developed by
 * X2Engine, Inc. Copyright (C) 2011-2014 X2Engine Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY X2ENGINE, X2ENGINE DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact X2Engine, Inc. P.O. Box 66752, Scotts Valley,
 * California 95067, USA. or at email address contact@x2engine.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * X2Engine" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by X2Engine".
 *****************************************************************************************/

// uncomment the following to define a path alias
// Yii::setPathOfAlias('custom','custom');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
include "X2Config.php";

$config = array(
    'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name' => $appName,
    'theme' => 'x2engine',
    'sourceLanguage' => 'en',
    'language' => $language,
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.components.ApplicationConfigBehavior',
        'application.components.X2UrlRule',
    // 'application.controllers.x2base',
    // 'application.models.*',
    // 'application.components.*',
    // 'application.components.ERememberFiltersBehavior',
    // 'application.components.EButtonColumnWithClearFilters',
    ),
    'modules' => array(
//		 'gii'=>array('class'=>'system.gii.GiiModule',
//            'password'=>'admin',
//            // If removed, Gii defaults to localhost only. Edit carefully to taste.
//            'ipFilters'=>false,
//        ),
        'mobile',
    ),
    'behaviors' => array('ApplicationConfigBehavior'),
    // application components
    'components' => array(
        'user' => array(
            'class' => 'X2WebUser',
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'file' => array(
            'class' => 'application.extensions.CFile',
        ),
        // uncomment the following to enable URLs in path-format

        'urlManager' => array(
            'urlFormat' => 'path',
            'urlRuleClass' => 'X2UrlRule',
            'showScriptName' => !isset($_SERVER['HTTP_MOD_REWRITE']),
            //'caseSensitive'=>false,
            'rules' => array(
                'api/tags/<model:[A-Z]\w+>/<id:\d+>/<tag:\w+>' => 'api/tags/model/<model>/id/<id>/tag/<tag>',
                'api/tags/<model:[A-Z]\w+>/<id:\d+>' => 'api/tags/model/<model>/id/<id>',
                'x2touch' => 'mobile/site/home',
                '<module:(mobile)>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
                '<module:(mobile)>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                '<module:(mobile)>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
                'gii' => 'gii',
                'gii/<controller:\w+>' => 'gii/<controller>',
                'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
                '<controller:(site|admin|profile|api|search|notifications|studio|gallery)>/<id:\d+>' => '<controller>/view',
                '<controller:(site|admin|profile|api|search|notifications|studio|gallery)>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:(site|admin|profile|api|search|notifications|studio|gallery)>/<action:\w+>' => '<controller>/<action>',
                'weblist/<action:\w+>' => 'marketing/weblist/<action>',
                '<module:\w+>' => '<module>/<module>/index',
                '<module:\w+>/<id:\d+>' => '<module>/<module>/view',
                '<module:\w+>/id/<id:\d+>' => '<module>/<module>/view',
                '<module:\w+>/<action:\w+>/id/<id:\d+>' => '<module>/<module>/<action>',
                '<module:\w+>/<action:\w+>' => '<module>/<module>/<action>',
                '<module:\w+>/<action:\w+>/<id:\d+>' => '<module>/<module>/<action>',
                '<module:\w+>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
            ),
        ),
        'zip' => array(
            'class' => 'application.extensions.EZip',
        ),
        'session' => array(
            'timeout' => 3600,
        ),
        // 'db'=>array(
        // 'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        // ),
        'db' => array(
            'connectionString' => "mysql:host=$host;dbname=$dbname",
            'emulatePrepare' => true,
            'username' => $user,
            'password' => $pass,
            'charset' => 'utf8',
            'enableProfiling'=>true,
            'enableParamLogging' => true,
            'schemaCachingDuration' => 84600
        ),
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
            'defaultRoles' => array('guest', 'authenticated', 'admin'),
            'itemTable' => 'x2_auth_item',
            'itemChildTable' => 'x2_auth_item_child',
            'assignmentTable' => 'x2_auth_assignment',
        ),
        // 'clientScript'=>array(
        // 'class' => 'X2ClientScript',
        // ),
        'clientScript'=>array(
            'class' => 'X2ClientScript',
            'mergeJs' => false,
            'mergeCss' => false,
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => '/site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' =>
            (YII_DEBUG && YII_LOGGING
                // All logging enabled
                ? array(
                    // array(
                    // 'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                    // 'ipFilters'=>array('127.0.0.1'),
                    // ),
                    array(
                        'class' => 'application.extensions.DbProfileLogRoute',
                        /* How many times the same query should be executed to be considered inefficient */
                        'countLimit' => 1,
                        'slowQueryMin' => 0.01, // Minimum time for the query to be slow
                    ),
                    array(
                        'class' => 'CWebLogRoute',
                        'categories' => 'translations',
                        'levels' => 'missing',
                    ),
                    array(
                        'class' => 'CFileLogRoute',
                        'categories' => 'application.update',
                        'logFile' => 'updater.log',
                        'maxLogFiles' => 10,
                        'maxFileSize' => 128,
                    ),
                )
                // Only update logging enabled.
                : array(
                    array(
                        'class' => 'CFileLogRoute',
                        'categories' => 'application.update',
                        'logFile' => 'updater.log',
                        'maxLogFiles' => 10,
                        'maxFileSize' => 128,
                    ),
                )
            ),
        ),
        'messages' => array(
            'class' => 'X2MessageSource',
//			 'forceTranslation'=>true,
//             'logBlankMessages'=>false,
//			 'onMissingTranslation'=>create_function('$event', 'Yii::log("[".$event->category."] ".$event->message,"missing","translations");'),
        ),
        'cache' => array(
            'class' => 'system.caching.CFileCache',
        ),
        'authCache' => array(
            'class' => 'application.components.X2AuthCache',
            'connectionID' => 'db',
            'tableName' => 'x2_auth_cache',
        // 'autoCreateCacheTable'=>false,
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => $email,
        'adminModel' => null,
        'profile' => null,
        'adminProfile' => null,
        'roles' => array(),
        'groups' => array(),
        'userCache' => array(),
        'isAdmin' => false,
        'sessionStatus' => 0,
        'logo' => "uploads/logos/yourlogohere.png",
        'webRoot' => __DIR__.DIRECTORY_SEPARATOR.'..',
        'trueWebRoot' => substr(__DIR__, 0, -17),
        'registeredWidgets' => array(
            'OnlineUsers' => 'Active Users',
            'TimeZone' => 'Time Zone',
            'GoogleMaps' => 'Google Map',
            'ChatBox' => 'Activity Feed',
            'TagCloud' => 'Tag Cloud',
            'ActionMenu' => 'My Actions',
            'MessageBox' => 'Message Board',
            'QuickContact' => 'Quick Contact',
            //'TwitterFeed'=>'Twitter Feed',
            'NoteBox' => 'Note Pad',
            'MediaBox' => 'Files',
            'DocViewer' => 'Doc Viewer',
            'TopSites' => 'Top Sites',
            'HelpfulTips' => 'Helpful Tips'
        ),
        'currency' => '',
        'version' => $version,
        'edition' => '',
        'buildDate' => $buildDate,
        'noSession' => false,
        'automatedTesting' => false,
        'supportedCurrencies' => array('USD', 'EUR', 'GBP', 'CAD', 'JPY', 'CNY', 'CHF', 'INR', 'BRL', 'VND'),
        'supportedCurrencySymbols' => array(),
    ),
);
if(file_exists('protected/config/proConfig.php')){
    $proConfig = include('protected/config/proConfig.php');
    foreach($proConfig as $attr => $proConfigData){
        if(isset($config[$attr])){
            $config[$attr] = array_merge($config[$attr], $proConfigData);
        }else{
            $config[$attr] = $proConfigData;
        }
    }
}
return $config;
