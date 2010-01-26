<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_View_Compiled_Adapter_Include extends K980K_View_Compiled_Abstract_Base {
    public function _check($string) {
        if(strpos($this->trim(strtolower($string)), 'include') === 0) {
            return true;
        }else {
            return false;
        }
    }
    public function _parse($contentString, $orgString, $hackString) {
        $AdapterInstance = $this->getAdapterInstance();
        $matches = null;
        preg_match("/include.*?filename[.*?|=|\w\W](.*)/", $hackString, $matches);
        if(!empty($matches)) {
            $file =  $this->trim($matches[1]);
            
            $fileName = $AdapterInstance->templatePath . $file;
            if(!is_file($fileName)) {
                $fileName  = $AdapterInstance->templatePath . $file . '.' . $AdapterInstance->templateFileExt;
            }
            $contents = $this->fileGetContents($fileName);
            return array($orgString, $AdapterInstance->_adapter($contents));
        }

    }
}