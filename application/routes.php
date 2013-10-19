<?php
/***
 *  Set the application routes.
 */
//TODO: Need a way to pass args to the action
//*** split uri into array on '/' and pass array to action by default?


// Default route
CoreMVC_Router::addRoute(new CoreMVC_Route(
    CoreMVC_Router::DEFAULT_URI,
    'App_Controller_Home',
    'index')
);

CoreMVC_Router::addRoute(new CoreMVC_Route(
    'test/test2',
    'App_Controller_Home',
    'test')
);

CoreMVC_Router::addRoute(new CoreMVC_Route(
    'newtest',
    'App_Controller_Test',
    'testaction')
);
