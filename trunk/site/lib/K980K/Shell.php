<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_Shell {
    private $type = 'bash';
    private $Instance = null;
    public function  __construct($shellType = 'bash') {
        $this->initInstance($shellType);
    }
    private function initInstance($shellType) {
        $className = 'K980K_Shell_Adapter_' . ucfirst(strtolower($shellType));
        $object = new $className();
        $this->Instance = $object;
    }
    public function getInstance(){
        return $this->Instance;
    }
    public function exec($command, $args){
        $string = ' ';
        $type = gettype($args);
     
        switch(trim($type)){
            case 'string':
                
                $string .= $args;
                break;
            case 'array':
               
                foreach($args as $key => $value){
                    if(is_numeric($key)){
                        $key = null;
                    }
                   
                    $string .= " $key $value ";
                }
                break;
        }       
        $object = $this->getInstance();
        
        return $object->$command($string);
    }
    public function __call($command, $args){
      
        return call_user_func_array(array($this,'exec'), array_merge_recursive(array($command),$args));
    }
}