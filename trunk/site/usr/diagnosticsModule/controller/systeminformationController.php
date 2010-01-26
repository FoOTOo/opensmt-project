<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class systeminformationController extends K980K_Controller_Action_Smarty {
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
        $systemInfo = $shell->prtconf();
        //var_dump($systemInfo);
        foreach($systemInfo as $key => $value){
            $systemInfo[$key] = '<p>' .$value .'</p>';
        }
        $systemInfoText = implode("\n", $systemInfo);
        $view->assign('subaction','SystemInformation');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/systeminformation.html');
        $extendData = $this->_extendData;
        if(isset($extendData['type'])){
            if($extendData['type'] =='ajax'){
                echo $systemInfoText;die();
            }
        }
        $view->assign('systemInfoText',$systemInfoText);
	$view->addTitle('SystemInformation');
	$this->display();
    }
    public function hardwareAction() {
        $shell = new K980K_Shell();
        $systemInfo = null;
        $systemInfo = $shell->prtconf();
        //var_dump($systemInfo);
        foreach($systemInfo as $key => $value){
            $systemInfo[$key] = '<p>' .$value .'</p>';
        }
        $systemInfoText = implode("\n", $systemInfo);
        echo $systemInfoText;die();
    }
    public function poolAction(){
        $shell = new K980K_Shell();
        $systemInfo = null;
        $systemInfo = $shell->zpool(' list');
        //var_dump($systemInfo);
        foreach($systemInfo as $key => $value){
            $systemInfo[$key] = '<p>' .$value .'</p>';
        }
        $systemInfoText = implode("\n", $systemInfo);
        echo $systemInfoText;die();

    }
    public function spaceusedAction(){
        $shell = new K980K_Shell();
        $systemInfo = null;
        $systemInfo = $shell->pfexec('df -h');
        //var_dump($systemInfo);
        foreach($systemInfo as $key => $value){
            $systemInfo[$key] = '<p>' .$value .'</p>';
        }
        $systemInfoText = implode("\n", $systemInfo);
        echo $systemInfoText;die();

    }
    public function mountsAction(){
        $shell = new K980K_Shell();
        $systemInfo = null;
        $systemInfo = $shell->pfexec('mount');
        //var_dump($systemInfo);
        foreach($systemInfo as $key => $value){
            $systemInfo[$key] = '<p>' .$value .'</p>';
        }
        $systemInfoText = implode("\n", $systemInfo);
        echo $systemInfoText;die();

    }
    public function nfsAction(){
        $shell = new K980K_Shell();
        $systemInfo = null;
        $systemInfo = $shell->pfexec('nfsstat');
        //var_dump($systemInfo);
        foreach($systemInfo as $key => $value){
            $systemInfo[$key] = '<p>' .$value .'</p>';
        }
        $systemInfoText = implode("\n", $systemInfo);
        echo $systemInfoText;die();

    }
    public function socketsAction(){
        $shell = new K980K_Shell();
        $systemInfo = null;
        $systemInfo = $shell->pfexec('netstat');
        //var_dump($systemInfo);
        foreach($systemInfo as $key => $value){
            $systemInfo[$key] = '<p>' .$value .'</p>';
        }
        $systemInfoText = implode("\n", $systemInfo);
        echo $systemInfoText;die();

    }
    public function swapAction(){
        $shell = new K980K_Shell();
        $systemInfo = null;
        $systemInfo = $shell->pfexec('swap -s');
        //var_dump($systemInfo);
        foreach($systemInfo as $key => $value){
            $systemInfo[$key] = '<p>' .$value .'</p>';
        }
        $systemInfoText = implode("\n", $systemInfo);
        echo $systemInfoText;die();

    }
    public function raidAction(){
        $shell = new K980K_Shell();
        $systemInfo = null;
        $systemInfo = array('raid');
        //var_dump($systemInfo);
        foreach($systemInfo as $key => $value){
            $systemInfo[$key] = '<p>' .$value .'</p>';
        }
        $systemInfoText = implode("\n", $systemInfo);
        echo $systemInfoText;die();

    }
    public function cifssmbAction(){
        $shell = new K980K_Shell();
        $systemInfo = null;
        $systemInfo = array('cifssmb');
        //var_dump($systemInfo);
        foreach($systemInfo as $key => $value){
            $systemInfo[$key] = '<p>' .$value .'</p>';
        }
        $systemInfoText = implode("\n", $systemInfo);
        echo $systemInfoText;die();

    }
    public function ftpAction(){
        $shell = new K980K_Shell();
        $systemInfo = null;
        $systemInfo = array('ftp');
        //var_dump($systemInfo);
        foreach($systemInfo as $key => $value){
            $systemInfo[$key] = '<p>' .$value .'</p>';
        }
        $systemInfoText = implode("\n", $systemInfo);
        echo $systemInfoText;die();

    }
}