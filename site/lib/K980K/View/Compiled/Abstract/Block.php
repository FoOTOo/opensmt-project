<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_View_Compiled_Abstract_Block extends K980K_View_Compiled_Abstract_Base{
    protected $_tempalteTag;
    public function _check($string){;}
    public function _parse($contentString, $orgString, $hackString){;}
    protected function _getBlockStringArray($contentString){
        $blockStrng = $this->getAdapterInstance()->_addHashString($contentString);
        $blockArray = $this->getAdapterInstance()->_parseTemplateArray($blockStrng);
        $i = $s = 0;
        $searchString = null;        
        //获取块区域,包含有完整标签
        foreach($blockArray as $key => $value){
            if(strpos($value, $this->getAdapterInstance()->leftDelimiter . $this->_tempalteTag) === 0){
                $i++;
            }
            if(strpos($value, $this->getAdapterInstance()->leftDelimiter . '/' .$this->_tempalteTag) === 0){
                $s++;
            }
            if($i == $s and $i != 0){
                $searchString .= $value;
                break;
            }
            if($i != 0){
                $searchString .= $value;
            }
        }		
        return array($searchString, $blockArray);
    }    
    protected function _parseBlock($contentString){
        $hashDelimiter = $this->getAdapterInstance()->hashDelimiter;        
        //var_dump($blockStrng, $blockArray);die();
        $parseString = null;
        //重新构造替换所需要的字符串
        list($searchString) = $this->_getBlockStringArray($contentString);
        //获取块区域的内容
        $blockStrng = $this->getAdapterInstance()->_addHashString($searchString);
        $blockArray = $this->getAdapterInstance()->_parseTemplateArray($blockStrng);        
        if(isset($blockArray[0])){
            unset($blockArray[0]);
        }
        array_pop($blockArray);
        foreach($blockArray as $string){
            
            $parseString .= $string;
        }        
        if($parseString === null){
            $parseString = '';
        }        
        return array($parseString, $this->getAdapterInstance()->_addHashString($searchString));
        //return array('<span style="color: #336699;display: block;"><{$time}></span>','');
    }
}