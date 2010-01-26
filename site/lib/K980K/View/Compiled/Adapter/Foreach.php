<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_View_Compiled_Adapter_Foreach extends K980K_View_Compiled_Abstract_Block {
    protected $_tempalteTag = 'foreach';
    public function _check($hackString) {        
        if(strpos($this->trim(strtolower($hackString)), $this->_tempalteTag) === 0) {
            return true;
        }else {
            return false;
        }
    }
    public function _parse($contentString, $orgString, $hackString) {       
        $contentString = $this->getAdapterInstance()->_clear($contentString); 
        $args = $this->_parseArgs($hackString);  
        list($blockString, $searchString) = $this->_parseBlock($contentString);        
        if($blockString === null or empty($searchString)){
            return null;
        }        
        $replaceString = null;
        //这里需要处理一下从标签中传入的参数
        for ($i=0; $i<2; $i++){
            $replaceString .= $this->getAdapterInstance()->_adapter($blockString);
        }
        return array($searchString,$replaceString);
    }
    private function _parseArgs($hackString){
        var_dump($hackString);
        //去除标签字符以保留参数字符串
        $argsString = substr($hackString,strpos($hackString, $this->_tempalteTag)+strlen($this->_tempalteTag),strlen($hackString)-strlen($this->_tempalteTag));
        var_dump($argsString);
        $argsArray = array();
        /*preg_match_all('~(?:'.'|(?>[^"\'=\s]+))+ |[=]~x', $argsString, $match);*/
        //$argsString = str_replace(array('\"',"\'"),array("\n","\r"),$argsString);
        
        preg_match_all("/([0-9a-zA-Z_$]+)|([=])|([\W])|([0-9a-zA-Z_$'\" \n\r]+?)/is", $argsString, $match);
        $tags = $match[0];
        $pos = 0;
        $start = 0;
        $finsh = 0;
        $varName = '';
        $oldString = '';
        $sflag = '';
        $str1Count = 0;
        $str2Count = 0;
        $varContent = '';
        foreach($tags as $string){
            if(strpos($string,'\'') === 0 and $oldString != '\\'){
                $str1Count++;    
            }
            if(strpos($string,"\"") === 0 and $oldString != '\\'){
                $str2Count++; 
            }
            switch($pos){
                case 0://如果为0则被视为变量名称,变量名称申请成功后状态位置为1
                    if(trim($string)=='')
                        continue;
                    $varName = $string;
                    $pos = 1;
                    break;
                case 1://如果为1则开始处理变量关系,变量关系处理成功后状态位置为2
                    if(trim($string)=='')
                        continue;
                    $varFlag = $string;
                    $pos = 2;
                    break;
                case 2://如果为2则开始处理变量内容,成功后状态位被置为0
           
                    if(strpos($string, '$') === 0){
                        $varContent .= $string;
                        $pos = 0;
                        $finsh = 1;
                    }                    
                    if(strpos($string, '\'') === 0 or $sflag == 'str1'){
                       
                        if($sflag == 'str1' and strpos($string,'\'') === 0 and $oldString != '\\'){                            
                            $pos =0;
                            $finsh = 1; 
                        }
                       
                        if($sflag == ''){
                            $sflag = 'str1';                             
                        }
                        
                        $varContent .= $string;
                    }elseif(strpos($string, "\"") === 0 or $sflag == 'str2'){
                        if($sflag == 'str2' and strpos($string,"\"") === 0 and $oldString != '\\'){                            
                            $pos =0;
                            $finsh = 1; 
                        }
                        
                        if($sflag == ''){
                            $sflag = 'str2';                             
                        }                        
                        $varContent .= $string;
                        
                    }elseif(preg_match("/([0-9]+)|true|false|TRUE|FALSE/is",$string)){
                        $varContent = $string;
                        $pos = 0;
                        $finsh =1; 
                    }
                    $oldString = $string;
                    if($finsh == 1){
                        $argsArray[$varName] = str_replace(array("\n","\r"),array('\"',"\'"),$varContent);
                        $varContent = '';
                        $varName = '';
                        $sflag = '';
                        $finsh = 0;
                        $start = 0;
                        $pos = 0;
                    }
                    break;    
                default:
                    break;
            }
        }
        
        if($str1Count%2 !== 0){
            require 'K980K/Exception.php';
            throw new K980K_Exception('模板中某处单引号出错',200,array($argsString));
        }
        if($str2Count%2 !== 0){
            require 'K980K/Exception.php';
            throw new K980K_Exception('模板中某处双引号出错',200,array($argsString));
        }
        var_dump($match[0],$argsArray,$str1Count,$str2Count);
       // var_dump(parse_str($argsString));       
        
    }    
}