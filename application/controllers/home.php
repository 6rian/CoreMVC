<?php
class App_Controller_Home extends CoreMVC_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $v = new CoreMVC_View('test');
        echo $v;

    }

    public function test() {
        $v = new CoreMVC_View('test2');
        echo $v;
    }

}
