<?php

class LUNController extends K980K_Controller_Action_Smarty {
    public $menucurrent = 'iSCSI';
    public $menuopen = 'iSCSI';

    public function  __construct($options,$extendData) {
       parent::__construct($options, $extendData);
       $view = $this->getViewInstance();
       $view->addTitle('iSCSI');
    }

    public function get_zfs_list() {
        $shell = new K980K_Shell();
        $return = $shell->exec('pfexec zfs list -Ho name');
        return $return;
    }

    public function get_lun_list() {
        $shell = new K980K_Shell();
        $return = $shell->exec("pfexec sbdadm list-lu");
        $lun_list = array();
        for ($i = 5; $i < count($return); $i++) {
            $parts = preg_split("/[\s]+/", $return[$i]);
            $lun_list[] = $parts[0];
        }
        return $lun_list;
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
    
    public function defaultAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();
        $shell = new K980K_Shell();
        $request = new K980K_Request();

        if ($request->isPost()) {
            if (isset($_POST["luncreate"])) {
                $zfs_name = $_POST['zfs_name'];
                $name = $_POST['name'];
                $data_size = $_POST['size'];
                //var_dump($name, $data_size);
                $new_zfs = "$zfs_name/$name";
                $arg = "$data_size $new_zfs 2>&1";
                $return = $shell->exec('pfexec zfs create -V', $arg);
                if (count($return) == 0) {
                    $arg = "/dev/zvol/rdsk/$zfs_name/$name";
                    $return = $shell->exec("pfexec sbdadm create-lu", $arg);
                }
            }
            if (isset($_POST["addview"])) {
                $lun_name = $_POST["lun_name"];
                $target_group = $_POST["target_group"];
                $host_group = $_POST["host_group"];
                $arg = "";
                if ($target_group != "") {
                    $arg = $arg."-t $target_group ";
                }
                if ($host_group != "") {
                    $arg = $arg."-h $host_group ";
                }
                $arg = $arg."$lun_name";
                //var_dump($arg);
                $return = $shell->exec("pfexec stmfadm add-view", $arg);

            }
            $lun_list = $this->get_lun_list();
            //var_dump($lun_list);
            $delete_flag = 0;
            foreach ($lun_list as $each) {
                if (isset($_POST[$each."D"])) {
                    $delete_flag = 1;
                    $lun_name = $each;
                    break;
                }
            }
            if ($delete_flag) {
                $return = $shell->exec("pfexec sbdadm delete-lu", $lun_name);
            }
            $execMessage = $return;
            $view->assign('execMessage', $execMessage);
        }

        $return = $shell->exec("pfexec sbdadm list-lu");
        $myArray = array();
        for ($i = 5; $i < count($return); $i++) {
            $parts = preg_split("/[\s]+/", $return[$i]);
			for ($j = 0; $j < count($parts); $j++) {
				if ($j == 1) {
					$myArray[$i-5][] = sprintf("%.2fMB",$parts[$j] / 1000 /1000);

				}
				else $myArray[$i-5][] = $parts[$j];
            }
        }
        //var_dump($myArray);
        $view->assign('myArray', $myArray);
        $view->assign('subaction','lun');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/lun.html');
	$view->addTitle('LUN');
	$this->display();
    }

        public function createlunAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        $zfs_list = $this->get_zfs_list();
        $view->assign('zfsName', $zfs_list);

        $view->assign('subaction','createlun');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/createlun.html');
	$view->addTitle('LUN');
	$this->display();
    }

    public function editlunAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        $lun_list = $this->get_lun_list();
        foreach ($lun_list as $each) {
            if (isset($_POST[$each])) {
                $lun_name = $each;
                break;
            }
        }
        $view->assign('lun_name', $lun_name);

        $tg_list = $this->get_group_list("target");
        $hg_list = $this->get_group_list("host");
        $view->assign('tg_list', $tg_list);
        $view->assign('hg_list', $hg_list);

        $shell = new K980K_Shell();
        $arg = "$lun_name 2>&1";
        $return = $shell->exec("pfexec stmfadm list-view -l", $arg);
        foreach($return as $key => $value){
                $returnInfo[$key] = '<p>' .$value .'</p>';
        }
        $execMessage = implode("\n", $returnInfo);
        $view->assign("execMessage", $execMessage);

        $view->assign('subaction','editlun');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/lunview.html');
	$view->addTitle('LUN');
	$this->display();
    }

}
?>
