<?php
/* 
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
*/
class K980K_Controller_Router_Adapter {
    protected $ruleString;
    protected $route;
    protected $extendData;
    protected $reQueryMethod;
    protected $severReQueryMethod;
    /**
     * 构造函数
     * @param <type> $ruleString
     * @param <type> $route
     * @param <type> $extendData
     */
    public function __construct($reQueryMethod,$ruleString, $route, $extendData = array()) {
        $this->severReQueryMethod = strtolower($_SERVER['REQUEST_METHOD']);
        $this->reQueryMethod = strtolower($reQueryMethod);
        $this->ruleString = $ruleString;
        $this->route = $route;

        $this->extendData = $extendData;
    }
    /**
     * 适配器校验接口
     */
    public function _matching() {

    }
    /**
     *
     *
     */
    public function getQueryMethod() {
        if($this->reQueryMethod == '*') {
            return null;
        }
        return $this->reQueryMethod;
    }
    /**
     *
     */
    public function checkReQueryMethod() {
        if(!($this->reQueryMethod == $this->severReQueryMethod or $this->reQueryMethod ==  '*')) {
            return false;
        }
        return true;
    }
    /**
     * 过滤字符左右的/
     * @param <type> $String
     * @return <type>
     */
    protected function _trim($String) {
        return trim($String,'/');
    }
    /**
     * 获得规则字符串
     * @return <type>
     */
    public function getRuleString() {
        return $this->ruleString;
    }
    /**
     * 设置规则字符串
     * @param <type> $ruleString
     */
    public function setRuleString($ruleString) {
        if(!is_string($ruleString)) {
            require_once 'K980K/Exception.php';
            throw new K980K_Exception('ruleString 必需为字符串');
        }
        $this->ruleString = $ruleString;
    }
    /**
     * 设置适配器中已经值
     * @param <type> $key
     * @param <type> $value
     * @return <type>
     */
    public function setRouteKey($key, $value) {
        $route = $this->getRoute();
        if($route === null) {
            $route = array();
        }
        if(!is_array($route)) {
            return null;
        }
        $route[$key] = $value;
        $this->setRoute($route);

    }
    /**
     * 获得适配器中已经定义的值
     * @param <type> $key
     * @return <type>
     */
    public function getRouteKey($key) {
        $route = $this->getRoute();
        if(!is_array($route) and $route === null) {
            return null;
        }
        if(array_key_exists($key, $route)) {
            return $route[$key];
        }else {
            return null;
        }
    }
    /**
     * 获适配器中的路由模块名
     * @return <type>
     */
    public function getRouteModule() {
        return $this->getRouteKey('module');
    }
    /**
     * 获得适配器中的路由控制器名
     * @return <type>
     */
    public function getRouteController() {
        return $this->getRouteKey('controller');
    }
    /**
     * 获得适配器中路由动作名
     * @return <type>
     */
    public function getRouteAction() {
        return $this->getRouteKey('action');
    }
    /**
     * 获得适配器中的路由名
     * @return <type>
     */
    protected function getRoute() {
        return $this->route;
    }
    /**
     * 设置适配器中的路由信息
     * @param <type> $route
     */
    protected function setRoute($route) {
        if(!is_array($route)) {
            require_once 'K980K/Exception.php';
            throw new K980K_Exception('route 必需为数组');
        }

        $this->route = $route;
    }
    /**
     * 获得适配器中的扩展参数
     * @return <type>
     */
    public function getExtendData() {
        return $this->extendData;
    }
    /**
     * 设置适配器的扩展参数
     * @param <type> $extendData
     */
    protected function setExtendData($extendData) {
        if(!is_array($extendData)) {
            require_once 'K980K/Exception.php';
            throw new K980K_Exception('extendData 必需为数组');
        }
        $this->extendData = $extendData;
    }
    /**
     * 获得生成基本路由信息与扩展参数的字符串
     * @param <type> $scriptName
     * @param <type> $reQuestUrl
     * @return <type>
     */
    protected function getQuestUrl($scriptName = null, $reQuestUrl = null) {
        if($scriptName === null) {
            $scriptName = $_SERVER['SCRIPT_NAME'];
        }
        if($reQuestUrl === null) {
            $reQuestUrl = $_SERVER['REQUEST_URI'];
        }
        $scriptPath = dirname ($scriptName);

        $reQuestUrl = str_replace(
                array($scriptName,$scriptPath),
                array('',''),
                $reQuestUrl);

        return $reQuestUrl;
    }
}

