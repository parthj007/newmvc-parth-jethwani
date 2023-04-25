<?php

define("DS", DIRECTORY_SEPARATOR);
require_once("Controller/Core/Front.php");

spl_autoload_register(function ($class_name) {
    $classPath = str_replace("_", "/", $class_name);
    require_once($classPath . ".php");
});
class Ccc
{

    protected $register = null;

    public static function init()
    {
        session_start();
        $front = new Controller_Core_Front();
        $front->init();
    }

    public static function getModel($className)
    {
        $className = "Model_" . $className;
        return new $className();
    }

    public static function getSingleton($className)
    {
        $className = "Model_" . $className;
        if (array_key_exists($className, $GLOBALS)) {
            return $GLOBALS[$className];
        }

        $GLOBALS[$className] = new $className();
        return $GLOBALS[$className];
    }

    public static function register($key, $value)
    {
        $GLOBALS[$key] = $value;
    }

    public static function getRegistry($key)
    {
        if (array_key_exists($key, $GLOBALS)) {
            return $GLOBALS[$key];
        }
        return null;
    }

    public static function log($data, $fileName = 'system.log', $newFile = false)
    {
        self::getSingleton('core_log')->log($data, $fileName, $newFile);
    }

    public static function getBaseDir($subDir = null)
    {
        $dir = getcwd();
        if($subDir){
            return $dir.$subDir;
        }
        return $dir;
    }
}
Ccc::init();
?>