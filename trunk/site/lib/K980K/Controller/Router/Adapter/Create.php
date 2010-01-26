<?php
/* 
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_Controller_Router_Adapter_Create extends K980K_Controller_Router_Adapter {
    /**
     * 构造函数
     * @return <type>
     */
    function  __construct() {
        $reQuestUrl = $this->getQuestUrl();
        $query = $this->parseQuestString($reQuestUrl);
        
        if($query[0] == $this->_trim($reQuestUrl) and strpos($query[0], '?')===0) {
            return $this->setDefaultRoute();
        }else {
            $queryArray = $query;
            $module = $controller = $action = null;
            $extendData = array();
            if(isset($queryArray[0]) and strlen($queryArray[0])) {
                $module = $queryArray[0];
                unset($queryArray[0]);
            }
            if(isset($queryArray[1])) {
                $controller = $queryArray[1];
                unset($queryArray[1]);
            }
            if(isset($queryArray[2])) {
                $action = $queryArray[2];
                unset($queryArray[2]);
            }
            if(!empty($queryArray)) {
                foreach($queryArray as $index => $value) {
                    if(strlen($value) ==0){
                        continue;
                    }
                    if(strpos($value, '?')===0){
                        continue ;
                    }
                    if($index%2 != 0) {
                        $extendData[$value]=null;
                        $key = $value;
                    }else {
                        
                        $extendData[$key]=$value;
                    }
                }
            }
           
            $this->setRuleString('AUTO');
            $this->setRoute(array('module'=>$module, 'controller'=>$controller, 'action'=>$action));
            $this->setExtendData($extendData);
            return $this;
        }
    }
    /**
     * 解析用于生成路由信息与扩展参数的字符串
     * @param <type> $questString
     * @return <type>
     */
    private function parseQuestString($questString) {
        $matches = explode('/', $this->_trim($questString));
        return $matches;
    }
    /**
     * 通过get post 等系统全局变量来生成路由信息与扩展数据，如果失败则会新建一个空的路由
     * @param <type> $resource
     * @return <type>
     */
    private function setDefaultRoute($resource = 'get') {         
        $key = '_'.strtoupper($resource);
        if(!isset($GLOBALS[$key])) {
            return false;
        }
        $getQuery = $GLOBALS[$key];
        if(empty($getQuery)) {
            return $this->createDefaultRoute();
        }
        if(empty($getQuery) or !is_array($getQuery)) {
            return $this;
        }
        
        $module = $controller = $action = null;
        $extendData = array();
        foreach($getQuery as $key => $value) {
            if($key == 'module') {
                $module = $value;
                continue ;
            }
            if($key == 'controller') {
                $controller = $value;
                continue ;
            }
            if($key == 'action') {
                $action = $value;
                continue ;
            }
            $extendData[$key] = $value;
        }
        $this->setRuleString('$_GET');
        $this->setRoute(array('module'=>$module, 'controller'=>$controller, 'action'=>$action));
        $this->setExtendData($extendData);
        return $this;
    }
    /**
     * 新建一个空的路由
     * @return <type>
     */
    private function createDefaultRoute() {
        $this->setRuleString('CREATE');
        return $this;
    }
}

