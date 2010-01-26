<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_View_Compiled_Adapter_If extends K980K_View_Compiled_Abstract_Block {
    protected $_tempalteTag = 'if';
    public function _check($hackString) {
        if(strpos($this->trim(strtolower($hackString)), $this->_tempalteTag) === 0) {
            return true;
        }else {
            return false;
        }
    }
    public function _parse($contentString, $orgString, $hackString) {
        
        $contentString = $this->getAdapterInstance()->_clear($contentString);       
        list($blockString, $searchString) = $this->_parseBlock($contentString);        
        if($blockString === null or empty($searchString)){
            return null;
        }        
        $replaceString = null;
        //这里需要处理一下从标签中传入的参数.
        //var_dump($searchString,$replaceString);
        return null;
        return array($searchString,$replaceString);
    }
}