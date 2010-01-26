<?php

class defaultController extends K980K_Controller_Action_Smarty {
    public $menucurrent = 'System';
    public $menuopen = 'System';
    public function  __construct($options,$extendData) {
       parent::__construct($options, $extendData);
       $view = $this->getViewInstance();
       $view->addTitle('System');
    }

    public function rebootAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        $request = new K980K_Request();
        if($request->isPost()){
            $shell = new K980K_Shell();
            $shell->exec('pfexec reboot');
        }

        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile','element/reboot.html');
        $view->assign('subaction', 'reboot');
        $view->addTitle('Reboot');
        $this->display();
    }

    public function shutdownAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        $request = new K980K_Request();
        if($request->isPost()){
            $shell = new K980K_Shell();
            $shell->exec('pfexec shutdown now');
        }

        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile','element/shutdown.html');
        $view->assign('subaction', 'shutdown');
        $view->addTitle('Shutdown');
        $this->display();
    }

}
?>