<?php
/* 
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_Registry extends ArrayObject {
    static private $_registryClassName = 'K980K_Registry';
    static private $_registry;
    /**
     * 初始化
     */
    static protected function init() {
        self::setInstance(new self::$_registryClassName());
    }
    /**
     * 获得一个已经注册的值
     * @param <type> $key
     * @return <type>
     */
    static function get($key) {
        $instance = self::getInstance();
        if (!$instance->offsetExists($key)) {
            require_once 'K980K/Exception.php';
            throw new K980K_Exception("No entry is registered for key '$index'");
        }
        return $instance->offsetGet($key);
    }
    /**
     * 修改或注册一个值
     * @param <type> $key
     * @param <type> $value
     */
    static function set($key, $value) {
        $instance = self::getInstance();
        $instance->offsetSet($key, $value);
    }
    /**
     * 返回存储注册信息的类句柄
     * @return <type>
     */
    static function getInstance() {
        if(self::$_registry === null) {
            self::init();
        }
        return self::$_registry;
    }
    /**
     * 设计存储注册信息的类句柄
     * @param K980K_Registry $registry
     */
    static function setInstance(K980K_Registry $registry) {
        if(self::$_registry !== null) {
            require 'K980K/Exception.php';
            throw new K980K_Exception('类已经被注册了');
        }
        self::setClassName(get_class($registry));
        self::$_registry = $registry;
    }
    /**
     * 修改注册类名
     * @param <type> $className
     */
    static function setClassName($className) {
        if(self::$_registry !== null) {
            require 'K980K/Exception.php';
            throw new K980K_Exception('类已经被注册了');
        }
        if(!is_string($className)) {
            require 'K980K/Exception.php';
            throw new K980K_Exception('参数必需为字符串');
        }
        require_once 'K980K/Loader.php';
        K980K_Loader::loadClass($className);
        self::$_registryClassName = $className;
    }
}

