<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
*/
class arptableController extends K980K_Controller_Action_Smarty {
    public $menucurrent = 'diagnostics';
    public $menuopen = 'diagnostics';
    public function  __construct($options,$extendData) {
        parent::__construct($options, $extendData);
        $view = $this->getViewInstance();
        $view->addTitle('diagnostics');

    }
    
    public function defaultAction() {
        $view = $this->getViewInstance();
        $viewOptions = $this->getViewOptions();
        $shell = new K980K_Shell();
        $systemInfo = null;
        $systemInfo = $shell->pfexec('arp -a');
        //var_dump($systemInfo);
        foreach($systemInfo as $key => $value) {
            $systemInfo[$key] = $value;
        }
        $systemInfoText = implode("\n", $systemInfo);
        $systemInfoText = str_replace('-', '', $systemInfoText);
        $tmp = explode("\n",$systemInfoText);
        
        $i = 0;
        $etc =  array();
        foreach($tmp as $key => $value){
            if(trim($tmp) == '')
                continue;
            if($i == 3){
               
                preg_match_all("/([a-zA-Z0-9]+).*?([a-zA-Z0-9:\.\-]+).*?([0-9\.]+).*?([a-zA-Z]+).*?([0-9a-zA-Z:]+)/is", $value, $a);
                array_shift($a);
                $etc[] =$a;
            }else{
                $i++;
            }
        }
        foreach($etc as $key =>$value){
            foreach($value as $key1 => $value1){
                $etc[$key][$key1]= $value1[0];
            }
            
        }
       
        $view->assign('etcList',$etc);
        $view->assign('subaction','ARPTable');
        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile', 'element/arptable.html');
        $extendData = $this->_extendData;
        if(isset($extendData['type'])) {
            if($extendData['type'] =='ajax') {
                echo $systemInfoText;
                die();
            }
        }
        $view->assign('systemInfoText',$systemInfoText);
        $view->addTitle('arpTable');
        $this->display();
    }
}