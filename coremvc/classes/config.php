<?php
class CoreMVC_Config {

    /**
     * @param array Config properties list
     */
    private $_props = array();

    /**
     * @param Config Singleton reference to the root config object.
     */
    private static $_instance = NULL;

    protected function __construct(array $props)
    {
        foreach ($props as $k => $v) {
            if (is_array($v)) {
                $v = new  CoreMVC_Config($v);
            }
            $this->_props[$k] = $v;
        }
    }

    public static function load(array $props)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new CoreMVC_Config($props);
        }

        //TODO: need to handle this better. override existing config?
        return self::getInstance();
    }

    public static function getInstance()
    {
        return self::$_instance;
    }

    public function get($key)
    {
        if (FALSE === $this->exists($key)) {
            return FALSE;
        }
        return $this->_props[$key];
    }

    public function exists($key)
    {
        if (!is_string($key)) {
            throw new UnexpectedValueException('Config key must be a string.');
        }
        return isset($this->_props[$key]);
    }

    public function toArray()
    {
        $a = array();
        foreach ($this->_props as $k => $v) {
            if (is_object($v) && $v instanceof Config) {
                $v = $v->toArray();
            }
            $a[$k] = $v;
        }

        return $a;
    }
}
