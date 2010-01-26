<?php
/* 
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
/**
 * 自动载入类
 */
class K980K_Loader {
    /**
     * 注册或反注册一个自动载入方法
     * @param <type> $className
     * @param <type> $enable
     */
    public static function registerAutoLoad($className = 'K980K_Loader', $enable = true) {
        if(!function_exists('spl_autoload_register')) {
            require_once 'K980K/Exception.php';
            throw new K980K_Exception('spl_autoload_register no found');
        }
        spl_autoload_register(array($className,'autoload'));
        self::loadClass($className);
        $methods = get_class_methods($className);
        if(!in_array('autoload', (array) $methods)) {
            require 'K980K/Exception.php';
            throw new K980K_Exception('在类中没有找到autoload方法');
        }
        if($enable == true) {
            spl_autoload_register(array($className,'autoload'));
        }else {
            spl_autoload_unregister(array($className,'autoload'));
        }
    }
    /**
     * 自动载入方法
     * @param <type> $className
     * @return <type>
     */
    public static function autoload($className) {
        try {
            self::loadClass($className);
            return $className;
        } catch (Exception $e) {
            die();
            return false;
        }

    }
    /**
     * 查检文件名是否安全
     * @param <type> $fileName
     */
    public static function _securityCheck($fileName) {
        if (preg_match('/[^a-z0-9\\/\\\\_.-]/i', $fileName)) {
            require_once 'Zend/Exception.php';
            throw new Zend_Exception('文件安全检查失败');
        }
    }
    /**
     * 根据类名载入相应的文件
     * @param <type> $className
     * @param <type> $dirs
     * @return <type>
     */
    public static function loadClass($className, $dirs = null) {
        if(class_exists($className))
            return;
        $fileName = str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
        self::loadFile($fileName);
        if(!class_exists($className)) {
            require 'K980K/Exception.php';
            throw new K980K_Exception($className . '类没有被定义');
        }
    }
    /**
     * 载入一个文件
     * @param <type> $fileName
     * @param <type> $dirs
     * @param <type> $one
     */
    public static function loadFile($fileName, $dirs = null , $one = false) {
        self::_securityCheck($fileName);
        $contents = null;
        ob_start();
        if($one == true) {
            include_once $fileName;
        }else {
            include $fileName;
        }
        $contents = ob_get_contents();
        ob_end_clean();
        
        if(!strlen($contents) === 0){
            require 'K980K/Exception.php';
            throw new K980K_Exception($fileName . '文件中出现异常');
            echo 'a';
        }else{
           
        }
    }
}
