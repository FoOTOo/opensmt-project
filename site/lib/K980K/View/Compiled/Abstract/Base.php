<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
abstract class K980K_View_Compiled_Abstract_Base {
    abstract public function _check($string);
    abstract public function _parse($contentString, $orgString, $hackString);
    private $adapterInstance = null;
    public function  __construct(K980K_View_Compiled_Adapter $adapterInstance) {
        $this->adapterInstance = $adapterInstance;
    }
    public function getAdapterInstance() {
        return $this->adapterInstance;
    }
    public function trim($string, $charlist = '\'=" '){        
        return trim($string, $charlist);
    }
    public function fileGetContents($fileName){
        return file_get_contents($fileName);
    }
}