<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_Request {
    public function getRequestMethod(){
       return trim(strtolower($_SERVER['REQUEST_METHOD']));
    }
    public function isPost(){
        if($this->getRequestMethod() == 'post'){
            return true;
        }
        return false;
    }
    public function isGet(){
        if($this->getRequestMethod() == 'get'){
            return true;
        }
        return false;
    }
}