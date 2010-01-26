<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_Shell_Adapter_Bash {
    public function  __construct() {

    }
    public function _ping($args) {
        return $this->exec('ping'. $args);
    }
    public function exec($command) {
    //string exec ( string command [, array &output [, int &return_var]] )
        $output = $return_var = null;  
        exec($command,$output,$return_var);

        return $output;
    }
    public function  __call($method,  $arguments) {
        $method = trim($method);
        
        if(method_exists($this, '_' . $method)) {
            return call_user_func_array(array($this,'_' . $method), $arguments);
        }
        return call_user_func_array(array($this,'exec'), $method.implode(' ', $arguments));
        require_once 'K980K/Exception.php';
        throw new K980K_Exception($method . '方法不存在');

    }
}