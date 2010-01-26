<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class routeController extends K980K_Controller_Action_Smarty {
    public $menucurrent = 'diagnostics';
    public $menuopen = 'diagnostics';
    public function  __construct($options,$extendData) {
       parent::__construct($options, $extendData);
       $view = $this->getViewInstance();
       $view->addTitle('diagnostics');

    }
    public function defaultAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();
        $shell = new K980K_Shell();
        $systemInfo = null;
        $systemInfo = $shell->pfexec('netstat -r');
        //var_dump($systemInfo);
        foreach($systemInfo as $key => $value){
            $systemInfo[$key] = '<p>' .$value .'</p>';
        }
        $systemInfoText = implode("\n", $systemInfo);
        $view->assign('subaction','Route');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/route.html');
        $extendData = $this->_extendData;
        if(isset($extendData['type'])){
            if($extendData['type'] =='ajax'){
                echo $systemInfoText;die();
            }
        }
        $view->assign('systemInfoText',$systemInfoText);
	$view->addTitle('route');
	$this->display();
    }
}