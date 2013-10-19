<?php
/***
 * Name:        CoreMVC
 * Author:      Brian Griffin <brian@performanceadops.com>
 * Version:     0.0.1
 ***/

error_reporting(E_ALL);

// Path to CMVC
define('CMVC_BASE', '../coremvc/');

// Path to App
define('CMVC_APP', '../application/');

// Load the config defaults
require_once(CMVC_BASE . 'config/coremvc_config.php');

// Grab the main CMVC class and instatiate
require_once(CMVC_BASE . 'coremvc.php');
$cmvc = CoreMVC::instance($config_defaults);
$cmvc->main();

?>
