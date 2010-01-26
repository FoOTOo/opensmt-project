<?php
/* 
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_Exception extends Exception {    
    public function  __construct($message = null, $code = 0, $resouce = null) {
        
        parent::__construct($message, $code);        
        $this->referrence($resouce);
    }
    /**
     * 格式异常信息并输出到浏览器中
     * @param <type> $resouce
     */
    public function referrence($resouce){        
        include realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'Exception' . DIRECTORY_SEPARATOR .'Exception.xhtml';
    }
}