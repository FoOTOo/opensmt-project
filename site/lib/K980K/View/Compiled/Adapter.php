<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_View_Compiled_Adapter {
    private $pluginList = array();
    private $html = null;
    public $contentString;
    public $hashDelimiter;
    public $leftDelimiter;
    public $rightDelimiter;
    public $varDelimiter;
    public $dataPool;
    public $templatePath;
    public $templateFileExt;
    public function  __construct($contentString,$hashDelimiter, $leftDelimiter,$rightDelimiter,$varDelimiter, $dataPool, $templatePath, $templateFileExt) {
        $this->contentString = $contentString;
        $this->hashDelimiter = $hashDelimiter;
        $this->leftDelimiter = $leftDelimiter;
        $this->rightDelimiter = $rightDelimiter;
        $this->varDelimiter = $varDelimiter;
        $this->dataPool = $dataPool;
        $this->templatePath = $templatePath;
        $this->templateFileExt = $templateFileExt;
        $pluginList = $this->searchPlugin(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Adapter' . DIRECTORY_SEPARATOR);
        $this->pluginList = $pluginList;
        $html = $this->_adapter($contentString);
        $this->html = $this->_clear($html);
    }
    public function getHtml() {
        return $this->html;
    }
    public function _clear($string) {
        return str_replace(array($this->hashDelimiter), array(''), $string);
    }
    public function _addHashString($contentString, $leftDelimiter = null, $rightDelimiter = null, $hashDelimiter = null) {
        if($leftDelimiter === null) {
            $leftDelimiter = $this->leftDelimiter;
        }
        if($rightDelimiter === null) {
            $rightDelimiter = $this->rightDelimiter;
        }
        if($hashDelimiter === null) {
            $hashDelimiter = $this->hashDelimiter;
        }
        $contentString = str_replace(
            array(
            $leftDelimiter,
            $rightDelimiter
            ),
            array(
            $hashDelimiter . $leftDelimiter,
            $rightDelimiter . $hashDelimiter
            ),
            $contentString
        );

        return $contentString;
    }
    public function _parseTemplateArray($contentString, $hashDelimiter = null) {
        if($hashDelimiter === null) {
            $hashDelimiter = $this->hashDelimiter;
        }

        $return = explode($hashDelimiter, $contentString);
        $templateArray = array();
        foreach($return as $value) {
			if(strlen(trim($value))==0) {
                continue ;
            }
            array_push($templateArray, $value);
        }
		//var_dump(str_replace("\r\n",'@',$contentString),$templateArray);die();
        return $templateArray;
    }
    public function _adapter($contentString) {
        $pluginList = $this->getPluginList();
        $leftDelimiter = $this->leftDelimiter;
        $rightDelimiter = $this->rightDelimiter;
        $hashDelimiter = $this->hashDelimiter;
        $contentString = $this->_addHashString($contentString, $leftDelimiter, $rightDelimiter, $hashDelimiter);
        $templateArray = $this->_parseTemplateArray($contentString, $hashDelimiter);
        
        foreach($templateArray as $index => $string) {
            $flag = preg_match("/{$leftDelimiter}(.*?){$rightDelimiter}/i", $string,$matches);
            if($flag === 1) {
                list($orgString, $hackString) = $matches;
                foreach($pluginList as $key => $object) {
                    if($object->_check($hackString) === true) {
                        $replaceRule = $object->_parse($contentString, $orgString, $hackString, $templateArray, $index);
                        if(is_array($replaceRule)) {
                            list($search, $replace) = $replaceRule;
                            $contentString = $this->str_replace_once($search, $replace, $contentString);
                        }else {

                        }
                    }else {

                    }
                }
            }
        }
        return $contentString;
    }
    public function getPluginList(){
        return $this->pluginList;    
    }
    function str_replace_once1($search, $replace, $haystack) {
    // Looks for the first occurence of $needle in $haystack
    // and replaces it with $replace.
        $pos = strpos($haystack, $search);
        if ($pos === false) {

        // Nothing found
            return $haystack;
        }
        return substr_replace($haystack, $replace, $pos, strlen($search));
    }

    public function str_replace_once($search, $replace, $haystack) {
        //var_dump($search,$replace);
        return preg_replace('/' . preg_quote($search,'/') . '/', $replace,$haystack,1);
    }
    private function searchPlugin($pluginPath ,$classBaseName = 'K980K_View_Compiled_Adapter_') {

        $pluginList = array();
        $fileList = scandir($pluginPath);
        foreach($fileList as $index => $file) {
            if($file == '.' || $file == '..' || strpos($file , '.') === 0) {
                continue ;
            }

            $fileName  = basename($file, '.php');
            $className = $classBaseName . $fileName;
            if(class_exists($className)) {
                $pluginList[$fileName] = new $className($this);
            }else {

            }
        }
        return $pluginList;
    }
    private function _trim($string) {
        return trim($string);
    }
}