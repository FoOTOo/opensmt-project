<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_Auth {
    private $userList;
    private $authData;
    public function  __construct($authData) {
        $this->authData = $authData;
        $this->userList = $authData['auth']['user'];
        //dump($userList);
    }
    public function load($route,$options) {
        $userList = $this->userList;
        $module = $route->getRouteModule();
        $controller = $route->getRouteController();
        $action = $route->getRouteAction();
        $checkString = $module . '/' . $controller . '/' . $action;
        $userId = $this->checkStatus();
        $skip = $this->getUserSkip($userId);
        $allow = $this->getUserAllow($userId);
        $denial = $this->getUserDenial($userId);
        //var_dump($checkString,$userId);
        if($this->checkSkip($userId, $skip, $checkString)){
            return array('error'=>'-1','message'=>'權限認證過程被省略');
        }
        if($this->checkDenial($userId,$denial,$checkString)){
           
            return array('error'=>'403','message'=>'您沒有權限訪問本模塊(被禁用)');
        }else{
            if(!$this->checkAllow($userId,$allow,$checkString)){
              
                return array('error'=>'402','message'=>'您沒有權限訪問本模塊(你沒有在相應的工作組中)');
            }
        }
        return array('error'=>'0','message'=>'');
        //dump($userList);
    }
    private function checkSkip($userId,$skip, $checkString){
        foreach($skip as $rule){
            $pregRule = str_replace(array('*','/'), array('([\\w\\W]+)','\/'), trim($rule,'/'));

            $ret = preg_match("/{$pregRule}/is", $checkString);
            //var_dump($pregRule,$checkString,$ret);
            if($ret){
                return true;
            }
            //var_dump($pregRule, $ret);
        }
        return false;
    }
    private function checkAllow($userId,$allow,$checkString) {
        foreach($allow as $rule){
            $pregRule = str_replace(array('*','/'), array('([\\w\\W]+)','\/'), trim($rule,'/'));
            
            $ret = preg_match("/{$pregRule}/is", $checkString);
            //var_dump($pregRule,$checkString,$ret);
            if($ret){
                return true;
            }
            //var_dump($pregRule, $ret);
        }
        return false;
       // var_dump($userId,$denial,$checkString);
    }
    private function checkDenial($userId,$denial,$checkString) {
        $start = 0;
        foreach($denial as $rule){
            $pregRule = str_replace(array('*','/'), array('([\\w\\W]+)','\/'), trim($rule,'/'));
            if(empty($pregRule)){
                continue;
            }
            $start = 1;
            $ret = preg_match("/{$pregRule}/is", $checkString);
            
            if($ret){
                return true;
            }
            //var_dump($pregRule, $ret);
        }
        if($start){
            return true;
        }
        return false;
       // var_dump($userId,$denial,$checkString);
    }
    private function getUserAllow($userId) {
        $userList = $this->userList;
        if(isset($userList[$userId])){
            $userInfo = $userList[$userId];
            if(isset($userInfo['access'])){
                $access = $userInfo['access'];
                if(isset($access['allow'])){
                    $allow = $access['allow'];
                    return explode('@',$allow);
                }else{
                    return null;
                }
            }else{
                return null;
            }
        }else{
            return false;
        }
    }
    private function getUserSkip($userId) {
        $userList = $this->userList;
        if(isset($userList[$userId])){
            $userInfo = $userList[$userId];
            if(isset($userInfo['access'])){
                $access = $userInfo['access'];
                if(isset($access['skip'])){
                    $skip = $access['skip'];
                    return explode('@',$skip);
                }else{
                    return null;
                }
            }else{
                return null;
            }
        }else{
            return false;
        }
    }
    private function getUserDenial($userId) {
        $userList = $this->userList;
        if(isset($userList[$userId])){
            $userInfo = $userList[$userId];
            if(isset($userInfo['access'])){
                $access = $userInfo['access'];
                if(isset($access['denial'])){
                    $denial = $access['denial'];
                    return explode('@',$denial);
                }else{
                    return null;
                }
            }else{
                return null;
            }
        }else{
            return false;
        }
    }
    public function getPassword($userId) {
        $userList = $this->userList;
       
        if(isset($userList[$userId])){
            $userInfo = $userList[$userId];
             
            if(isset($userInfo['password'])){
                $password = $userInfo['password'];
                return $password;
            }else{
                return null;
            }
        }else{
            return false;
        }
    }
    public function checkPass($userId, $password) {
        
        $pwd1 = $this->getPassword($userId);
        $pwd2 = sha1($password);
        
        if($pwd1 == $pwd2){
            return true;
        }
        return false;
    }
    public function checkStatus() {
        
        if(isset($_SESSION['userid'])){
            $userId = $_SESSION['userid'];
        }else{
            $userId = null;
        }
        if(empty($userId)){
            $userId = 'guest';
        }
        return $userId;
    }
    public function saveAuth($userId, $time = 3600) {
        
        $_SESSION['userid'] = $userId;
        $_SESSION['auth_time'] = time();
        $_SESSION['auth_outime'] = $time;
        return true;
    }
    public function clearAuth($userId) {
         $_SESSION['userid'] = '';
        $_SESSION['auth_time'] = '';
        $_SESSION['auth_outime'] = '';
        return true;
    }

}