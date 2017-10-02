<?php

/**
 * Copied from index.php.
 * Used by phpunit.
 * @since 2017-06-13
 * @author Olle Härstedt
 */

if (!file_exists(__DIR__ . '/../enabletests')) {
    die('phpunit disabled. NEVER run tests on a production system - the tests will modify the database. To enable phpunit, run $touch enabletests');
}

/*
 *---------------------------------------------------------------
 * SYSTEM FOLDER NAME
 *---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" folder.
 * Include the path if the folder is not in the same  directory
 * as this file.
 *
 */
$system_path = "framework";

/*
 *---------------------------------------------------------------
 * APPLICATION FOLDER NAME
 *---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * folder then the default one you can set its name here. The folder
 * can also be renamed or relocated anywhere on your server.  If
 * you do, use a full server path. For more info please see the user guide:
 * http://codeigniter.com/user_guide/general/managing_apps.html
 *
 * NO TRAILING SLASH!
 *
 */
$application_folder = dirname(__FILE__) . "/../application";

/*
 * --------------------------------------------------------------------
 * DEFAULT CONTROLLER
 * --------------------------------------------------------------------
 *
 * Normally you will set your default controller in the routes.php file.
 * You can, however, force a custom routing by hard-coding a
 * specific controller class/function here.  For most applications, you
 * WILL NOT set your routing here, but it's an option for those
 * special instances where you might want to override the standard
 * routing in a specific front controller that shares a common CI installation.
 *
 * IMPORTANT:  If you set the routing here, NO OTHER controller will be
 * callable. In essence, this preference limits your application to ONE
 * specific controller.  Leave the function name blank if you need
 * to call functions dynamically via the URI.
 *
 * Un-comment the $routing array below to use this feature
 *
 */
// The directory name, relative to the "controllers" folder.  Leave blank
// if your controller is not in a sub-folder within the "controllers" folder
// $routing['directory'] = '';

// The controller class file name.  Example:  Mycontroller.php
// $routing['controller'] = '';

// The controller function you wish to be called.
// $routing['function']    = '';


/*
 * -------------------------------------------------------------------
 *  CUSTOM CONFIG VALUES
 * -------------------------------------------------------------------
 *
 * The $assign_to_config array below will be passed dynamically to the
 * config class when initialized. This allows you to set custom config
 * items or override any default config values found in the config.php file.
 * This can be handy as it permits you to share one application between
 * multiple front controller files, with each file containing different
 * config values.
 *
 * Un-comment the $assign_to_config array below to use this feature
 *
 */
// $assign_to_config['name_of_config_item'] = 'value of config item';



// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// --------------------------------------------------------------------




/*
 * ---------------------------------------------------------------
 *  Resolve the system path for increased reliability
 * ---------------------------------------------------------------
 */
if (realpath($system_path) !== FALSE)
{
    $system_path = realpath($system_path).'/';
}

// ensure there's a trailing slash
$system_path = rtrim($system_path, '/').'/';

// Is the system path correct?
if (!is_dir($system_path))
{
    exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */


// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

define('ROOT', dirname(__FILE__));

// The PHP file extension
define('EXT', '.php');

// Path to the system folder
define('BASEPATH', str_replace("\\", "/", $system_path));

// Path to the front controller (this file)
define('FCPATH', str_replace(SELF, '', __FILE__));

// Name of the "system folder"
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));


// The path to the "application" folder
if (is_dir($application_folder))
{
    define('APPPATH', $application_folder.'/');
}
else
{
    if (!is_dir(BASEPATH . $application_folder . '/'))
    {
        exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: ".SELF);
    }

    define('APPPATH', BASEPATH . $application_folder . '/');
}
if (file_exists(APPPATH.'config'.DIRECTORY_SEPARATOR.'config.php'))
{
    $aSettings= include(APPPATH.'config'.DIRECTORY_SEPARATOR.'config.php');
}
else
{
    $aSettings=array();
}
// Set debug : if not set : set to default from PHP 5.3
if (isset($aSettings['config']['debug']))
{
    if ($aSettings['config']['debug']>0)
    {
        define('YII_DEBUG', true);
        if($aSettings['config']['debug']>1)
            error_reporting(E_ALL);
        else
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
    }
    else
    {
        define('YII_DEBUG', false);
        error_reporting(0);
    }
}
else
{
    error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);// Not needed if user don't remove his 'debug'=>0, for application/config/config.php (Installation is OK with E_ALL)
}

if (version_compare(PHP_VERSION, '5.3.3', '<'))
    die ('This script can only be run on PHP version 5.3.3 or later! Your version: '.PHP_VERSION.'<br />');


/**
 * Load Psr4 autoloader, should be replaced by composer autoloader at some point.
 */
require_once __DIR__ . '/../application/Psr4AutoloaderClass.php';
$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('ls\\pluginmanager', __DIR__ . '/../application/libraries/PluginManager');
$loader->addNamespace('ls\\pluginmanager', __DIR__ . '/../application/libraries/PluginManager/Storage');
$loader->addNamespace('ls\\menu', __DIR__ . '/../application/libraries/MenuObjects');
$loader->addNamespace('ls\\helpers', __DIR__ . '/../application/helpers');

/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 *
 */
require_once BASEPATH . 'yii' . EXT;
require_once APPPATH . 'core/LSYii_Application' . EXT;

$config = require_once(APPPATH . 'config/internal' . EXT);

if (!file_exists(APPPATH . 'config/config' . EXT)) {
    // If Yii can not start due to unwritable runtimePath, present an error
    $sDefaultRuntimePath = dirname(__FILE__).DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR.'runtime';
    if (!is_dir($sDefaultRuntimePath) || !is_writable($sDefaultRuntimePath)) {
        // @@TODO: present html page styled like the installer
        die (sprintf('%s should be writable by the webserver (766 or 776).', $sDefaultRuntimePath));
    }
}

Yii::$enableIncludePath = false;
Yii::createApplication('LSYii_Application', $config);

set_error_handler(function($no, $msg, $file, $line, $context) {
    error_log($file . ':' . $line . ': ' . $msg);
}, E_ERROR & E_WARNING & E_PARSE);

require_once(__DIR__ . '/TestHelper.php');
require_once(__DIR__ . '/TestBaseClass.php');