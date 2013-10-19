<?php

class CoreMVC_Router {

    /** Default URI **/
    const DEFAULT_URI = 'default';

    /** Routes collection **/
    protected static $routes = array();

    /** The URI **/
    protected $uri = self::DEFAULT_URI;

    /** The Router instance **/
    protected static $instance = null;

    protected function __construct($uri = '')
    {
        if (!empty($uri)) {
            $this->uri = $uri;
        }
    }

    public function instance($uri = '')
    {
        if (is_null(self::$instance)) {
            self::$instance = new CoreMVC_Router($uri);
        }
        return self::$instance;
    }

    /**
     *  Map a URI to a controller and action. Extra parameters get passed to
     *  the action in order.
     */
    public static function addRoute(CoreMVC_Route $route)
    {
       
        // check if route already exists
        foreach (self::$routes as $r) {
            if ($r->getUri() == $route->getUri()) {
                throw new LogicException('A route already exists for URI: '.$uri);
            }
        }

        self::$routes[] = $route;
    }

    public function exec($uri = '')
    {
        // If a URI is specified use it. Otherwise use the default.
        if (empty($uri)) {
            $uri = $this->uri;
        }

        // find the route
        $route = $this->getRoute($uri);

        // now execute
        $c = $route->getController();
        $a = $route->getAction();

        $controller = new $c;
        return $controller->$a();
    }

    /**
     * Get the route for a given URI.
     */
    public function getRoute($uri)
    {
        if (empty($uri)) {
            throw new UnexpectedValueException('URI cannot be empty.');
        }

        // Theoretically there should only be 1 match, but we should check to see if the URI
        // matches any other routes and raise an error if so.
        $matches = array();
        $uri = CoreMVC_Route::cleanUri($uri);

        foreach (self::$routes as $route) {
//TODO: fix this. need to do preg_match_all and then save the params.
            if ($uri == $route->getUri()) {
                $matches[] = $route;
            }
        }

        $nMatches = count($matches); 
        if (0 == $nMatches) { 
            throw new RuntimeException('Route not found: ' . $uri);
        } elseif (1 < $nMatches) {
            throw new RuntimeException('Multiple routes found for URI: ' . $uri . ', ' . var_dump($matches));
        }

        return $matches[0];
    }

}
