<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class processController extends K980K_Controller_Action_Smarty {
    public $menucurrent = 'status';
    public $menuopen = 'status';
    public function  __construct($options,$extendData) {
       parent::__construct($options, $extendData);
       $view = $this->getViewInstance();
       $view->addTitle('status');
       $view->assign('authCheck',true);
    }
    public function defaultAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();
        $shell = new K980K_Shell();
        $systemInfo = null;
        $systemInfo = $shell->top();
        //var_dump($systemInfo);
        $systemInfoText = implode("\n", $systemInfo);
        $view->assign('subaction','process');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/process.html');
        $extendData = $this->_extendData;
        if(isset($extendData['type'])){
            if($extendData['type'] =='ajax'){
                echo $systemInfoText;die();
            }
        }
        $view->assign('systemInfoText',$systemInfoText);
	$view->addTitle('process');
	$this->display();
    }
}