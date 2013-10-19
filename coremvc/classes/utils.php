<?php
abstract class CoreMVC_Utils {

    public static function sanitize($val)
    {
        if (is_array($val)) {
            foreach ($val as $k => $v) {
                $val[$k] = addslashes($v);
            }
        } else {
            $val = addslashes($val);
        }

        return $val;
    }

    /**************************************************************************
     * String Helpers
     *************************************************************************/


    /**************************************************************************
     * Debugging Utils
     *************************************************************************/
    public static function debugArray($a)
    {
        echo '<pre>';
        print_r($a);
        echo '<br></pre>';
    }

    public static function debugDump($o)
    {
        echo '<pre>';
        var_dump($o);
        echo '<br></pre>';
    }

}
