<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class interfacesController extends K980K_Controller_Action_Smarty {
    public $menucurrent = 'status';
    public $menuopen = 'status';
    public function  __construct($options,$extendData) {
       parent::__construct($options, $extendData);
       $view = $this->getViewInstance();
       $view->addTitle('status');
    }
    public function defaultAction() {
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();
        $shell = new K980K_Shell();
        $systemInfo = null;
        $systemInfo = $shell->pfexec('ifconfig -a');
        
        $view->assign('subaction','interfaces');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/interfaces.html');
        $extendData = $this->_extendData;
        if(isset($extendData['type'])){
           
        }
        $etcList = array();
        $i = 0;
        //var_dump($systemInfo);
        while(!empty($systemInfo)) {
            $line1 = array_shift($systemInfo);
            $line2 = array_shift($systemInfo);
            if(strpos($line1, 'lo') === false) {
                
                $line3 =  array_shift($systemInfo);
                $etcList[$i] = $line1 . ' ' . $line2 . ' ' . $line3;
                $i++;
            }else{
                
            }

        }
        $etcArray = array();
        $i = 0;
        foreach($etcList as $key => $value){
            
            preg_match_all("/([a-zA-Z0-9]+):.*?(<[a-zA-Z0-9,]+>).*?(mtu [\d]+).*?(index [\d]+).*?(inet [\d\.]+).*?(netmask [0-9a-zA-Z]+).*?(broadcast [\d\.]+).*?(ether [\d\w:]+)/is", $value, $matches);
            array_shift($matches);
            $z = 0;
            foreach($matches as $tmp){
                $str = $tmp[0];
                $tmpArray = explode(' ',$str);
                
                if(count($tmpArray) == 2){
                    $akey = $tmpArray[0];
                    $avalue = $tmpArray[1];
                    $etcArray[$i][$akey] = $avalue;
                }else{
                    if($z==1)
                        $akey = 'status';
                    if($z==0)
                        $akey = 'name';
                    $etcArray[$i][$akey] = $tmpArray[0];
                }
               $z++;
            }
             $i++;
           // var_dump($matches);
        }
        var_dump($etcArray);
        $view->assign('interfaces',$etcArray);
	$view->addTitle('interfaces');
	$this->display();
    }
}