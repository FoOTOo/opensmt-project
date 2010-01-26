<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class systemController extends K980K_Controller_Action_Smarty {
    public $menucurrent = 'status';
    public $menuopen = 'status';
    public function  __construct($options,$extendData) {
       parent::__construct($options, $extendData);
       $view = $this->getViewInstance();
       $view->addTitle('status');
    }

    public function defaultAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();
        $shell = new K980K_Shell();
        $systemInfo = array();
        $systemInfo['Hostname'] = implode('',$shell->hostname());
        $systemInfo['Version'] = 'no-define';
        $systemInfo['OS_Version'] = implode('',$shell->uname('-a'));
        //$systemInfo['Platform']sorvi
        $systemInfo['Platform'] = implode('',$shell->uname('-srvi'));
        $systemInfo['System_Time'] = implode('',$shell->date());
        $temp = $shell->uptime();        
        preg_match_all("/(.*?),\W+(\d users.*)/is", $temp[0], $matches);
        $systemInfo['Uptime'] = implode('',$matches[1]);
        $systemInfo['Load_Average'] = implode('',$matches[2]);
        $systemInfo['CPU_Temperature'] = 'no-define';
        $temp = implode('',$shell->psrinfo('-vp'));
        $matches = null;
        preg_match("/.*?(\d+\W+mhz)/is", $temp, $matches);
        $systemInfo['CPU_Frequency'] = $matches[1];
        $temp = $matches = null;
        $temp = implode('', $shell->top());
        preg_match("/([1-9]\d*\.\d*|0\.\d*[1-9]\d*)\W+user/is", $temp, $matches);
        $systemInfo['CPU_Usage'] = $matches[1];
        $matches = null;
        preg_match("/Memory:\W+([\d]+).*?([\d]+).*?([\d]+).*?([\d]+).*/is", $temp, $matches);
        //var_dump($matches);
        $systemInfo['Memory_Usage'] = $matches[1] . '/' . $matches[2] .  ':' . $matches[3] . '/' . $matches[4];
        //
        //var_dump($temp,$matches);
        foreach($systemInfo as $key =>$value) {
            $view->assign('Auto_' . $key, $value);
        }
        //var_dump($systemInfo);
        $view->assign('subaction','system');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/system.html');
	$view->addTitle('system');
	$this->display();
    }

}
?>
