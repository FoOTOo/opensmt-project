<?php

class defaultController extends K980K_Controller_Action_Smarty {
    public $menucurrent = 'help';
    public $menuopen = 'help';

    public function  __construct($options,$extendData) {
       parent::__construct($options, $extendData);
       $view = $this->getViewInstance();
       $view->addTitle('help');
    }

    public function licenseAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        $view->assign('subaction','license');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/license.html');
	$view->addTitle('license');
	$this->display();
    }

    public function releaseAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        $view->assign('subaction','release');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/release.html');
	$view->addTitle('release');
	$this->display();
    }
}
?>
