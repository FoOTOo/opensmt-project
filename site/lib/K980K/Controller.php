<?php
/* 
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_Controller {
    private $router;
    private $reQuest;
    private $defaultModuleName = 'defaultModule';
    private $defaultControllerName = 'default';
    private $defaultActionName = 'defaultAction';
    private $_options;
    public function  __construct() {
        $this->router = null;
        $this->_options = null;
        $this->reQuest =  $_SERVER['REQUEST_URI'];
    }
    /**
     * 加载系统配置中与控制器相关的参数。
     * @param <type> $options
     * @return <type>
     */
    public function setOptions($options) {
        $newOptions = array();
        
        foreach($options as $key => $value) {
            if($key == 'controller') {
                foreach($value as $name =>$config) {
                    
                    if(property_exists($this, $name)) {
                        $this->$name = $config;
                    }
                }

            }
            $newOptions[$key] = $value;
        }
        $this->_options = $newOptions;

        return $this;
    }
    /**
     * 取得系统配置
     * @return <type>
     */
    public function getOptions() {        
        return $this->_options;
    }
    /**
     * 指定一个路由集合作为指定的过滤器
     * @param K980K_Controller_Router $router
     * @return <type>
     */
    public function setRouter(K980K_Controller_Router $router) {
        if($this->router === null) {
            $this->router = $router;
            return $this->router;
        }
        return false;
    }
    /**
     * 当规则没有中没有符合的路由时，由其它参数生成一个路由信息
     * @return <type>
     */
    private function createDefaultRoute() {
        $route = new K980K_Controller_Router_Adapter_Create($this->reQuest);
        
        return $route;
    }
    /**
     * 检测用户路由器是否符合要求，并对缺失参照进行补全
     * @param <type> $route
     * @return <type>
     */
    private function checkRoute($route) {
        if(!is_object($route)) {
            require_once 'K980K/Exception.php';
            throw new K980K_Exception('$route 必需为对象');
        }
        if(get_parent_class($route) != 'K980K_Controller_Router_Adapter' && get_class($route) != 'K980K_Controller_Router_Adapter') {
            require_once 'K980K/Exception.php';
            throw new K980K_Exception('$route 父类必需为 K980K_Controller_Router_Adapter');
        }
        
        if($route->getRouteKey('module') === null) {
            $route->setRouteKey('module', $this->defaultModuleName);            
        }else{
            $route->setRouteKey('module',strtolower($route->getRouteKey('module')));
        }
        if($route->getRouteKey('controller') === null) {
            $route->setRouteKey('controller', $this->defaultControllerName);
        }else{
            $route->setRouteKey('controller',strtolower($route->getRouteKey('controller')));
        }
        if($route->getRouteKey('action') === null) {
            $route->setRouteKey('action', $this->defaultActionName);
        }else{
            $route->setRouteKey('action',strtolower($route->getRouteKey('action')));
        }
        if($route->getRuleString() === null){
            $route->setRuleString('AUTOFIX');
        }
       
        return $route;
    }
    /**
     * 开始进行路由
     * @param <type> $reQuest
     * @return <type>
     */
    public function start($reQuest = null, $authenticator = null) {
        if($reQuest === null) {
            $reQuest = $this->reQuest;
        }
        $router = $this->router;       
        $route = $router->filterRoute($reQuest);
        
        if($route == false) {
            $route = $this->createDefaultRoute();
           
        }
       // die();
        $route = $this->checkRoute($route);
        
        return $this->loadUserController($route,$authenticator);
    }
    /**
     * 加载用户自定义的控制器文件并运行相关用户方法
     * @param <type> $route
     * @return K980K_Controller_Router_Load
     */
    private function loadUserController($route,$authenticator = null) {
        $options = $this->getOptions();
        $methodName = 'load';
        if(is_object($authenticator)){
            if(method_exists($authenticator, $methodName)){
                $ret = call_user_func_array(array($authenticator,$methodName), array($route,$options));
                //var_dump($ret);
                if($ret['error'] == 403){
                    K980K_Registry::set('authCheck',false);
                }else{
                    K980K_Registry::set('userInfo',array('userId'=>$authenticator->checkStatus()));
                    K980K_Registry::set('authCheck',true);
                }
            }
        }
       
        return new K980K_Controller_Router_Load(
        $route,
        $options,
        array($this->defaultModuleName, $this->defaultControllerName, $this->defaultActionName)
        );
    }

}


