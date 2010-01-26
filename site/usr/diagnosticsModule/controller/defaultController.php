<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of defaultController
 *
 * @author Hotaru
 */
class defaultController  extends K980K_Controller_Action_Smarty {
    public $menucurrent = 'diagnostics';
    public $menuopen = 'diagnostics';
    public function  __construct($options,$extendData) {       
       parent::__construct($options, $extendData);
       $view = $this->getViewInstance();
       $view->addTitle('diagnostics');
    }
    public function defaultAction() {
        exec('passwd -a root',$a,$b);
        //var_dump($a,$b);
    }
    //put your code here
    public function pingAction() {

        $request = new K980K_Request();
        $view = $this->getViewInstance();
        $viewOptions = $this->getViewOptions();

        if($request->isPost()) {
            $shell = new K980K_Shell();
            $pingDes = $_POST["ping_des"];
            $pingCount = $_POST['ping_count'];
            $pingSizeof = $_POST['ping_sizeof'];
            $pingCustom = $_POST['ping_custom'];
            $args = "-s $pingDes $pingSizeof $pingCount $pingCustom" ;
            $return = $shell->exec('ping',$args);
            //$return = $shell->exec('ping',array('-s',$pingDes,$pingSizeof,$pingCount));
            //$return  = $shell->ping(array('-s',$pingDes,$pingSizeof,$pingCount));
            //$return  = $shell->ping($args);
            $execMessage = $return;
            
            $view->assign('execMessage',$execMessage);
        }
        $view->assign('_baseUrl',$viewOptions['template']['baseUrl']);
        $view->assign('tplfile','element/ping.html');
        $view->assign('subaction','ping');
        $view->addTitle('ping');
        $this->display();
    }
    public function tracerouteAction() {
        $request = new K980K_Request();
        $view = $this->getViewInstance();
        $viewOptions = $this->getViewOptions();
        if($request->isPost()) {
            $shell = new K980K_Shell();
            $tracerouteDes = $_POST['traceroute_des'];
            $tracerouteTtl = $_POST['traceroute_ttl'];
            $args = "-m $tracerouteTtl $tracerouteDes" ;
            $return = $shell->traceroute($args);
            $execMessage = $return;
            $view->assign('execMessage',$execMessage);
        }
        //打开一个子菜单,使模板可以添加相关的样式信息
        $view->assign('subaction','traceroute');
        $view->addTitle('traceroute');
        //使用模板文件来填充布局
        $view->assign('tplfile','element/traceroute.html');
        
        $this->display(); 
    }
}
?>
