<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_View_Compiled_Adapter_Var extends K980K_View_Compiled_Abstract_Base {
    public function _check($string) {
        if(strpos($this->trim(strtolower($string)), '$') === 0) {
            return true;
        }else {
            return false;
        }
    }
    public function _parse($contentString, $orgString, $hackString) {        
        $key = $this->trim($hackString,'\'" $=');
        return array($orgString,$this->_getvar($key));
        
    }
    public function _getvar($key){
        $AdapterInstance = $this->getAdapterInstance();
        /*@var $AdapterInstance K980K_View_Compiled_Adapter*/
        $dataPool = $AdapterInstance->dataPool;
        if(isset($dataPool[$key])){
            return $dataPool[$key];
        }
        return null;
    }
}