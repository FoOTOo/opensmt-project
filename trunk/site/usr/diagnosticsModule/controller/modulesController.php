<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class modulesController extends K980K_Controller_Action_Smarty {
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
        $systemInfo = $shell->modinfo();
        //var_dump($systemInfo);
        foreach($systemInfo as $key => $value){
            $systemInfo[$key] =$value;
        }
        $systemInfoText = implode("\n", $systemInfo);
        array_shift($systemInfo);
        $module = array();
        foreach($systemInfo as $key=>$value){
            preg_match_all("/([\d]+).*?([a-zA-Z0-9]+).*?([0-9a-zA-Z]+).*?([a-zA-Z0-9-]+).*?([0-9]+)(.*)/is", $value, $a);
//            var_dump($value);
//            var_dump($a);
            array_shift($a);
                $module[] =$a;
        }
        
        foreach($module as $key =>$value){
            foreach($value as $key1 => $value1){
                $module[$key][$key1]= $value1[0];
            }

        }
        //var_dump($module);
        $view->assign('moduleList',$module);
        $view->assign('subaction','Modules');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/modules.html');
        $extendData = $this->_extendData;
        if(isset($extendData['type'])){
            if($extendData['type'] =='ajax'){
                echo $systemInfoText;die();
            }
        }
        $view->assign('systemInfoText',$systemInfoText);
	$view->addTitle('Modules');
	$this->display();
    }
}