<?php

class targetController extends K980K_Controller_Action_Smarty {
    public $menucurrent = 'iSCSI';
    public $menuopen = 'iSCSI';

    public function  __construct($options,$extendData) {
       parent::__construct($options, $extendData);
       $view = $this->getViewInstance();
       $view->addTitle('iSCSI');
    }

    public function get_target_list() {
        $shell = new K980K_Shell();
        $return = $shell->exec("pfexec itadm list-target");
        $target_list = array();
        for ($i = 1; $i < count($return); $i++) {
            $parts = preg_split("/[\s]+/", $return[$i]);
            $target_list[] = $parts[0];
        }
        return $target_list;
    }

    public function defaultAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        $shell = new K980K_Shell();
        $request = new K980K_Request();
        if ($request->isPost()) {
            if (isset($_POST["createtarget"])) {
                $return = $shell->exec("pfexec itadm create-target 2>&1");
                $execMessage = $return;
                //var_dump($return);
            }
            $target_list = $this->get_target_list();
            //var_dump($_POST);
            foreach ($target_list as $each) {
                $parts = explode('.', $each);
                $new = $parts[0];
                for ($i = 1; $i < count($parts); $i++) {
                    $new = $new.'_'.$parts[$i];
                }
                //var_dump($new);
                if (isset($_POST[$new])) {
                    $target_name = $each;
                    //var_dump($target_name);
                    break;
                }
                if (isset($_POST[$new.'O'])) {
                    $offline_name = $each;
                    break;
                }
                if (isset($_POST[$new.'L'])) {
                    $online_name = $each;
                    break;
                }
            }
            if (isset($target_name)) {
                //var_dump("aa");
                $arg = "$target_name 2>&1";
                $return = $shell->exec("pfexec itadm delete-target", $arg);
                $execMessage = $return;
            }
            if (isset($offline_name)) {
                $arg = "$offline_name 2>&1";
                $return = $shell->exec("pfexec stmfadm offline-target", $arg);
                $execMessage = $return;
            }
            if (isset($online_name)) {
                $arg = "$online_name 2>&1";
                $return = $shell->exec("pfexec stmfadm online-target", $arg);
                $execMessage = $return;
            }
        }
        $view->assign("execMessage", $execMessage);
        $return = $shell->exec("pfexec itadm list-target");
        $myArray = array();
        for ($i = 1; $i < count($return); $i++) {
            $parts = preg_split("/[\s]+/", $return[$i]);
            foreach ($parts as $part) {
                $myArray[$i-1][] = $part;
            }
        }
        //var_dump($myArray);
        $view->assign('myArray', $myArray);
        $view->assign('subaction','target');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/target.html');
	$view->addTitle('target');
	$this->display();
    }

}
?>
