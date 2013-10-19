<?php

class CoreMVC_View {

    /**
     * @param array View variables
     */
    private $_vars = array();

    /**
     * @param string Path to views directory. Defaults to 'views'.
     */
    private $_views_path = 'views';

    /**
     * @param string The view file, relative to the views path.
     */
    private $_view_file = '';

    /**
     * @param string Default extension for view files.
     */
    private $_extension = '.phtml';

    public function __construct($viewfile = '')
    {
        //load from config file
        $this->_views_path = 'views';
        $this->_view_file = $viewfile;
        $this->_extension = '.phtml';

        // TODO: add a factory. the view with the base template should be a singleton.
        // otherwise spawn a new view object for a subview
    }

    public function set($k, $v)
    {
        $this->_vars[$k] = $v;
    }

    public function get($k)
    {
        return (isset($this->vars[$k])) ? $this->vars[$k] : null;
    }

    /**
     * Render the view as a string. Optionally it may be printed to the screen.
     *
     * @param bool $output Output method flag. True = print to screen, False = returned as string.
     * @return mixed View rendered as a string or nothing if output flag is on.
     */
    public function render($output = FALSE)
    {
        if (!is_bool($output)) {
            throw new UnexpectedValueException('Value of the ouput flag must be a boolean.');
        }
        if (empty($this->_views_path) || empty($this->_view_file)) {
            throw new RuntimeException('Missing view file.');
        }

        ob_start();
        
        // bring the view vars into local scope
        foreach ($this->_vars as $k => $v) {
            // render any subviews
            if (is_object($v) && $v instanceof CoreMVC_View) {
                $$k = $v->render();
            } else {
                $$k = $v;
            }
        }

        //TODO: create a helper in utils to build a path
        include CMVC_APP . $this->_views_path . '/' . $this->_view_file . $this->_extension;

        if (FALSE === $output) {
            return ob_get_clean();
        }

        ob_end_flush();
    }

    public function __toString()
    {
        return $this->render();
    }
}
