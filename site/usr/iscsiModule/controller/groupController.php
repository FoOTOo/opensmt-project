<?php

class groupController extends K980K_Controller_Action_Smarty {
    public $menucurrent = 'iSCSI';
    public $menuopen = 'iSCSI';

    public function  __construct($options,$extendData) {
       parent::__construct($options, $extendData);
       $view = $this->getViewInstance();
       $view->addTitle('iSCSI');
    }

    public function get_group_list($type) {
        $shell = new K980K_Shell();
        if ($type == 'target') $return = $shell->exec("pfexec stmfadm list-tg");
        else $return = $shell->exec("pfexec stmfadm list-hg");
        $group_list = array();
        foreach ($return as $eachLine) {
            $parts = explode(" ", $eachLine);
            $group_list[] = $parts[2];
        }
        return $group_list;
    }

    public function get_user_list($type, $group) {
        //var_dump($group);
        $shell = new K980K_Shell();
        if ($type == 'target') $return = $shell->exec("pfexec stmfadm list-tg -v", $group);
        else $return = $shell->exec("pfexec stmfadm list-hg -v", $group);
        $user_list = array();
        for ($i = 1; $i < count($return); $i++) {
            $parts= explode(":", $return[$i]);
            $user_list[$i-1] = '';
            for ($j = 1; $j < count($parts)-1; $j++) {
                $user_list[$i-1] .= $parts[$j].':';
            }
            $user_list[$i-1] .= $parts[$j];
        }
        return $user_list;
    }

    public function defaultAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        $shell = new K980K_Shell();
        $request = new K980K_Request();

        if ($request->isPost()) {
            if (isset($_POST["addtg"])) {
                $new_tg_name = $_POST["group_name"];
                $return = $shell->exec("pfexec stmfadm create-tg", $new_tg_name);
            }
            if (isset($_POST["addhg"])) {
                $new_hg_name = $_POST["group_name"];
                $return = $shell->exec("pfexec stmfadm create-hg", $new_hg_name);
            }
            if (isset($_POST["addtgmember"])) {
                $tg = $_POST["group_name"];
                $new_member_name = $_POST["member_name"];
                $arg = "-g $tg $new_member_name 2>&1";
                $shell->exec("pfexec svcadm disable stmf");
                $shell->exec("pfexec svcadm disable stmf");
                $return = $shell->exec("pfexec stmfadm add-tg-member", $arg);
                $shell->exec("pfexec svcadm enable stmf");
                $execMessage = $return;
            }
            if (isset($_POST["addhgmember"])) {
                $hg = $_POST["group_name"];
                $new_member_name = $_POST["member_name"];
                $arg = "-g $hg $new_member_name 2>&1";
                //var_dump($arg);
                $return = $shell->exec("pfexec stmfadm add-hg-member", $arg);
                $execMessage = $return;
            }
            $tg_list = $this->get_group_list("target");
            foreach ($tg_list as $tg) {
                if (isset($_POST[$tg.'D'])) {
                    $modify_tg = $tg;
                    $tg_member = $_POST["tgmember"];
                    $arg = "-g $modify_tg $tg_member 2>&1";
                    $shell->exec("pfexec svcadm disable stmf");
                    $shell->exec("pfexec svcadm disable stmf");
                    $return = $shell->exec("pfexec stmfadm remove-tg-member", $arg);
                    $shell->exec("pfexec svcadm enable stmf");
                    $execMessage = $return;
                    break;
                }
                if (isset($_POST[$tg.'G'])) {
                    $modify_tg = $tg;
                    $return = $shell->exec("pfexec stmfadm delete-tg", $modify_tg." 2>&1");
                    $execMessage = $return;
                    break;
                }
            }

            $hg_list = $this->get_group_list("host");
            foreach ($hg_list as $hg) {
                if (isset($_POST[$hg.'D'])) {
                    $modify_hg = $hg;
                    $hg_member = $_POST["hgmember"];
                    $arg = "-g $modify_hg $hg_member 2>&1";
                    $return = $shell->exec("pfexec stmfadm remove-hg-member", $arg);
                    $execMessage = $return;
                    break;
                }
                if (isset($_POST[$hg.'G'])) {
                    $modify_hg = $hg;
                    $return = $shell->exec("pfexec stmfadm delete-hg", $modify_hg);
                    break;
                }
            }
        }
        $view->assign("execMessage", $execMessage);
        $tg_list = $this->get_group_list("target");
        $myArray = array();
        foreach ($tg_list as $tg) {
            $myArray[$tg] = array();
            $temp_user_list = $this->get_user_list("target", $tg);
            foreach ($temp_user_list as $user) {
                $myArray[$tg][] = $user;
            }
        }
        //var_dump($myArray);
        $view->assign('myArray', $myArray);

        $hg_list = $this->get_group_list("host");
        $myArray2 = array();
        foreach ($hg_list as $hg) {
            $myArray2[$hg] = array();
            $temp_user_list = $this->get_user_list("host", $hg);
            foreach ($temp_user_list as $user) {
                $myArray2[$hg][] = $user;
            }
        }
        //var_dump($myArray);
        $view->assign('myArray2', $myArray2);

        $view->assign('subaction','iscsigroup');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/iscsigroup.html');
	$view->addTitle('group');
	$this->display();
    }

    public function addtgAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        $view->assign('subaction','iscsigroup');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/addtg.html');
	$view->addTitle('target');
	$this->display();
    }

    public function addhgAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        $view->assign('subaction','iscsigroup');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/addhg.html');
	$view->addTitle('target');
	$this->display();
    }

    public function addhgmemberAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        $hg_list = $this->get_group_list("host");
        foreach ($hg_list as $hg) {
            if (isset($hg)) {
                $group_name = $hg;
                break;
            }
        }
        $view->assign("group_name", $group_name);
        $view->assign('subaction','iscsigroup');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/addhgmember.html');
	$view->addTitle('target');
	$this->display();
    }

    public function addtgmemberAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        $tg_list = $this->get_group_list("target");
        foreach ($tg_list as $tg) {
            if (isset($tg)) {
                $group_name = $tg;
                break;
            }
        }
        $view->assign("group_name", $group_name);
        $view->assign('subaction','iscsigroup');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/addtgmember.html');
	$view->addTitle('target');
	$this->display();
    }

}
?>
