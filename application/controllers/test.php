<?php
class App_Controller_Test extends CoreMVC_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function testaction() {
        $v = new CoreMVC_View('testview');
        $v->set('route', 'just a test');
        echo $v;
    }

}
