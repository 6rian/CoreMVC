<?php

class CoreMVC_Route {

    /** URI pattern **/
    protected $uri;

    /** Controller name **/
    protected $controller;

    /** Action name **/
    protected $action;

    public function __construct($uri, $controller, $action)
    {
        if (empty($uri)) {
            throw new UnexpectedValueException('URI is required to add a route.');
        }
        if (empty($controller)) {
            throw new UnexpectedValueException('Controller is required to add a route.');
        }
        if (empty($action)) {
            throw new UnexpectedValueException('Action is required to add a route.');
        }

        //TODO: more checking here. ie. class/action method exists.

        $this->uri = $this->uriToRegex($uri);
        $this->controller = $controller;
        $this->action = $action;
    }

    public static function cleanUri($uri)
    {
        $uri = ltrim($uri, '/');
        $uri = rtrim($uri, '/');
        return $uri;
    }

    /**
     * Wrap a URI string with regex delimiters.
     */
    protected function uriToRegex($uri)
    {
        return '^' . $uri . '^i';
    }

    /**
     * Remove regex delimiters from uri.
     */
    protected function regexToUri($regex)
    {
        return substr($regex, 1, strlen($regex)-3);
    }

    public function getUri()
    {
        return $this->regexToUri($this->uri);
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

}
