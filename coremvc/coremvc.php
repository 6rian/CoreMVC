<?php

//temporarily loading classes manually here
//TODO: autoload functionality
require_once(CMVC_BASE . 'classes/config.php');
require_once(CMVC_BASE . 'classes/utils.php');
require_once(CMVC_BASE . 'classes/controller.php');
require_once(CMVC_BASE . 'classes/view.php');
require_once(CMVC_BASE . 'classes/route.php');
require_once(CMVC_BASE . 'classes/router.php');
require_once(CMVC_APP  . 'routes.php');


// set include path

// autoloader goes here

/***
 * The main CoreMVC class. Serves as the front controller.
 *
 * Author:      Brian Griffin <brian@performanceadops.com>
 **/
class CoreMVC {

    /** instance **/
    static protected $instance = null;

    /** config object **/
    protected $config = null;

    protected function __construct($config = null)
    {
        // load the config
        if (!is_null($config)) {
            $this->setConfig($config);
        }
    }

    public function instance($config = null)
    {
        if (is_null(self::$instance)) {
            self::$instance = new CoreMVC($config);
        }
        return self::$instance;
    }

    public function setConfig($config)
    {
        if (is_array($config)) {
            $this->config = CoreMVC_Config::load($config);
        } else if ($config instanceof CoreMVC_Config) {
            $this->config = $config;
        } else {
            throw new UnexpectedValueException('setConfig() only accepts a config array or CoreMVC_Config object.');
        }
    }


    public function main()
    {
        // make sure we have the config set up first
        if (is_null($this->config)) {
            throw new RuntimeException('Fatal Error: Missing configuration object.');
        }


require_once(CMVC_APP . 'controllers/home.php');
require_once(CMVC_APP . 'controllers/test.php');

        $router = CoreMVC_Router::instance($_GET['uri']);
        $router->exec();
    }


}
