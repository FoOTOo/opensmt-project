<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_Controller_Router {
    private $routeTable;
    public function  __construct() {
        $this->initRouteTable();
    }
    /**
     * 添加一个路由过程
     * @param <type> $key
     * @param <type> $route
     * @return <type>
     */
    public function addRouter($key, $route) {
        if(is_object($route)) {
            $routeTable = $this->getRouteTable();
            $routeTable->offsetSet($key, $route);
        }
        return $this;
    }
    /**
     * 获得路由表
     * @return <type>
     */
    public function getRouteTable() {
        if(!get_class($this->routeTable) == 'ArrayObject') {
            $this->initRouteTable();
        }
        return $this->routeTable;
    }
    /**
     * 初始化路由表
     * @return <type>
     */
    private function initRouteTable() {
        $this->routeTable = new ArrayObject();
        return $this;
    }
    /**
     * 对路由表进行遍历以找到符合已经定义的路由规则的数据
     * @param <type> $reQuest
     * @return <type>
     */
    public function filterRoute($reQuest) {
        $routeTable = $this->routeTable;
        foreach($routeTable as $key => $object) {
            if(!method_exists($object, '_matching')) {
                continue ;
            }
            $route = $object->_matching($reQuest);
            if($route !== false) {
                return $route;
            }
        }
        return false;
    }

}