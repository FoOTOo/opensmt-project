<?php
/* 
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
/**
 * 将INI文件转换为对象或数组
 */
class K980K_Config_Ini {
    /**
     * 结构函数
     * @param <type> $fileName
     * @return <type>
     */
    public function  __construct($fileName = null) {
        if($fileName == null)
            return false;
        $iniArray = $this->parseFile($fileName);
        if(!is_array($iniArray)) {
            return false;
        }
        $this->arrayToObject($iniArray);
    }
    /**
     * 将文件解析为多维数组
     * @param <type> $fileName
     * @return <type>
     */
    private function parseFile($fileName) {
        return parse_ini_file($fileName, true);
    }
    /**
     * 将数组转换为对象
     * @param <type> $array
     */
    private function arrayToObject($array) {
        foreach($array as $key=>$value) {
            if(is_array($value)) {
                $this->$key = new K980K_Config_Ini();
                $this->$key->arrayToObject($value);
            }else {
                $check = explode('.', $key);
                if(count($check) == 1) {
                    $this->$key = $value;
                }else {
                    $ikey = array_shift($check);
                    if(!isset($this->$ikey))
                        $this->$ikey = new K980K_Config_Ini();
                    $loop = $this->$ikey;
                    for($i=0;$i<count($check)-1;$i++) {
                        if(!isset($loop->$check[$i])) {
                            $loop->$check[$i] = new K980K_Config_Ini();

                        }
                        $loop = $loop->$check[$i];
                    }
                    $loop->$check[$i] = $value;
                }
            }
        }
    }
    /**
     * 将对象转换为数组
     * @return <type>
     */
    public function _toArray() {
        $return = array();
        foreach($this as $key => $value) {
            if(is_object($value)) {
                $return[$key] = $value->_toArray();
            }else {
                $return[$key] = $value;
            }
        }
        return $return;
    }
    public function  __destruct() {

    }

}

