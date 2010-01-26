<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class defaultController extends K980K_Controller_Action_Smarty {
    public function defaultAction() {
        /*@var $view Smarty*/     
     
       $view = $this->getViewInstance();
       //$view->assign('authCheck',true);
       $this->display('layout.html');
      
        //echo '<pre>',print_r($this),'</pre>';
    
      //
    }
    public function testAction(){

       $this->display('index.html');
    }
}
?>
