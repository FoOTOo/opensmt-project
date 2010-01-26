<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class zpoolController extends K980K_Controller_Action_Smarty {
    public $menucurrent = 'Disk';
    public $menuopen = 'Disk';
    public function  __construct($options,$extendData) {
       parent::__construct($options, $extendData);
       $view = $this->getViewInstance();
       $view->addTitle('Disk');
    }

    public function get_disk_list() {
	    $shell = new K980K_Shell();
	    $return = $shell->exec('pfexec format');
	    $DISK_NUM = (count($return) - 5) / 2;
	    $DISK_NAME = array();
	    for ($i = 0; $i < $DISK_NUM; $i++) {
		    $parts = explode('.', $return[4+$i*2]);
		    $name = explode(' ', $parts[1]);
		    array_push($DISK_NAME, $name[1]);
	    }
	    return $DISK_NAME;
    }
    
    public function get_zpool_list() {
        $shell = new K980K_Shell();
	$return = $shell->exec('pfexec zpool list -Ho name');
	return $return;
    }

    public function defaultAction() {
       	$shell = new K980K_Shell();
	$view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();
	$return = $shell->exec('pfexec zpool list -H');
	$myArray = array();
	for ($i = 0; $i < count($return); $i++) {
		$myArray[$i] = array();
		$parts = explode("\t", $return[$i]);
		foreach($parts as $part) {
			array_push($myArray[$i], $part);
		}
	}
	//var_dump($myArray);
	$view->assign('myArray', $myArray);
	$request = new K980K_Request();
	if ($request->isPost()) {
		$shell2 = new K980K_Shell();
		$zpool_name = $this->get_zpool_list();
		foreach ($zpool_name as $zpool) {
                        $zpoolS = $zpool.'S';
			if (isset($_POST[$zpool]) || isset($_POST[$zpoolS])) {
				$arg = $zpool;
			}
		}
                //var_dump($_POST);
                if ($_POST[$arg] == 'Status') {
                    $return = $shell2->exec('pfexec zpool status', $arg);
                    foreach($return as $key => $value){
                        $returnInfo[$key] = '<p>' .$value .'</p>';
                    }
                    $execMessage = implode("\n", $returnInfo);
                    $view->assign("execMessage", $execMessage);
                }
                if ($_POST[$arg.'S'] == 'Scrub') {
                    $return = $shell2->exec("pfexec zpool scrub", $arg);
                }
                else if ($_POST[$arg.'S'] == 'Stop Scrub') {
                    $return = $shell2->exec("pfexec zpool scrub -s", $arg);
                }

	}

        $zpool_name = $this->get_zpool_list();
        $scrub_finish = array();
        $last_scrub_pool = "";
        foreach ($zpool_name as $zpool) {
            $return = $shell->exec("pfexec zpool status $zpool | grep scrub");
            //var_dump($return);
            array_push($scrub_finish, strstr($return[0], "in progress") ? 0 : 1);
            $last_scrub_pool = strstr($return[0], "in progress") ? $zpool : $last_scrub_pool;
        }

        //var_dump($last_scrub_pool);
        //var_dump(strlen($last_scrub_pool));
        if (strlen($last_scrub_pool) != 0) {
            //var_dump(self::$last_scrub_pool);
            $return = $shell->exec("pfexec zpool status", $last_scrub_pool);
            foreach($return as $key => $value){
                $returnInfo[$key] = '<p>' .$value .'</p>';
            }
            $scrubMessage = implode("\n", $returnInfo);
            $extendData = $this->_extendData;
            if(isset($extendData['type'])){
                if($extendData['type'] =='ajax'){
                    echo $scrubMessage;die();
                }
            }
            $view->assign("scrubMessage", $scrubMessage);
        }
        else {
             $extendData = $this->_extendData;
            if(isset($extendData['type'])){
                if($extendData['type'] =='ajax'){
                    echo '';die();
                }
            }
            $view->assign("scrubMessage", $scrubMessage);
        }


        //var_dump($scrub_finish);
        $view->assign('scrubfinish', $scrub_finish);
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile','element/zpoolinfo.html');
        $view->assign('subaction','zpoolinfo');
        $view->addTitle('zpoolinfo');
        $this->display();
    }

    public function zpoolcreateAction() {
    	$request = new K980K_Request();
	$view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

	$disk_name = $this->get_disk_list();
	$view->assign('diskName', $disk_name);
	//var_dump($disk_name);

	if ($request->isPost()) {
		$shell = new K980K_Shell();
		$poolName = $_POST["pool_name"];
		$poolType = $_POST["pool_type"];
		$disk1 = $_POST["disk1"];
		$disk2 = $_POST["disk2"];
		$disk3 = $_POST["disk3"];
		$args = "$poolName $poolType $disk1 $disk2 $disk3 2>&1";
		$return = $shell->exec('pfexec zpool create', $args);
		if ($return != null) $execMessage = $return;
		else $execMessage[] = "Created Successful!";
		$view->assign('execMessage', $execMessage);
	}
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/zpoolcreate.html');
	$view->assign('subaction', 'zpoolcreate');
	$view->addTitle('zpool create');
	$this->display();
    }

    public function zpoolopAction() {
	    $request = new K980K_Request();
	    $view = $this->getViewInstance();
	    $viewOptions = $this->getViewOptions();

	    $zpool_name = $this->get_zpool_list();
	    $view->assign('zpoolName', $zpool_name);
	    $disk_name = $this->get_disk_list();
	    $view->assign('diskName', $disk_name);

	    if ($request->isPost()) {
		    $shell = new K980K_Shell();
			$pool_name = $_POST["poolName"];
		    if ($_POST["opType"] == "destroy") {
				$arg = $pool_name." 2>&1";
				//var_dump($arg);
				$return = $shell->exec('pfexec zpool destroy', $arg);
		    }
		    if ($_POST["opType"] == "add") {
			    $cmd = "zpool add";
			    $poolType = $_POST["vdeviceType"];
			    $disk1 = $_POST["disk1"];
			    $disk2 = $_POST["disk2"];
			    $disk3 = $_POST["disk3"];
				$arg = "$pool_name $poolType $disk1 $disk2 $disk3 2>&1";
				//var_dump($arg);
				$return = $shell->exec('pfexec zpool add', $arg);
		    }
		    if ($_POST["opType"] == "attach") {
			    $cmd = "zpool attach";
			    $disk1 = $_POST["disk1"];
			    $disk2 = $_POST["disk2"];
				$disk3 = $_POST["disk3"];
				$old_disk = '';
				$statusInfo = $shell->exec('pfexec zpool status', $pool_name);
				for ($i = 7; $i < count($statusInfo)-1; $i++) {
					$parts = preg_split('/[\s]+/', $statusInfo[$i]);
					//var_dump($parts);
					foreach ($parts as $part) {
						$tmp = '';
						foreach ($disk_name as $disk) {
							if ($part == $disk) {
								$tmp = $disk;
								break;
							}
						}
						if ($tmp != '') {
							//var_dump($tmp);
							$old_disk = $old_disk.$tmp.' ';
						}
					}
					if ($old_disk != '') break;
				}
				//var_dump($old_disk);
				$arg = "$pool_name $old_disk$disk1 $disk2 $disk3 2>&1";
				$return = $shell->exec('pfexec zpool attach', $arg);
		    }
		    if ($_POST["opType"] == "detach") {
			    $cmd = "zpool detach";
			    $disk1 = $_POST["disk1"];
			    $disk2 = $_POST["disk2"];
			    $disk3 = $_POST["disk3"];
				$arg = "$pool_name $disk1 $disk2 $disk3 2>&1";
				$return = $shell->exec('pfexec zpool detach', $arg);
		    }
		    if ($_POST["opType"] == "clear") {
			    $cmd = "zpool clear";
				$arg = "$pool_name 2>&1";
				$return = $shell->exec('pfexec zpool clear', $arg);
		    }
		    if ($_POST["opType"] == "replace") {
			    $cmd = "zpool replace";
			    $disk1 = $_POST["disk1"];
			    $disk2 = $_POST["disk2"];
				$arg = "$pool_name $disk1 $disk2 2>&1";
				$return = $shell->exec('pfexec zpool replace', $arg);
			}
		    if ($return != null) $execMessage = $return;
		    else $execMessage[] = "Successful!";
		    $view->assign('execMessage', $execMessage);
	    }

	    $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	    $view->assign('tplfile', 'element/zpoolop.html');
	    $view->assign('subaction', 'zpoolop');
	    $view->addTitle('zpool op');
	    $this->display();
    }

    public function zpoolioAction() {
	$request = new K980K_Request();
	$view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();
        $zpool_name = $this->get_zpool_list();
	$view->assign('zpoolName', $zpool_name);
        if ($request->isPost()) {
            $shell = new K980K_Shell();
            //var_dump($_POST);
            $pool_name = $_POST["poolName"];
            $per_time = $_POST["perTime"];
            $times = $_POST["times"];
            if (isset($_POST["vdevice"])) $vdevice = "-v";
            else $vdevice = "";
            $arg = "$vdevice $pool_name $per_time $times";
            //var_dump($arg);
            $return = $shell->exec('pfexec zpool iostat', $arg);
            //var_dump($return);
            $execMessage = $return;
            $view->assign("execMessage", $execMessage);
        }
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/zpoolio.html');
	$view->assign('subaction', 'zpoolio');
	$view->addTitle('zpool io');
	$this->display();
    }
}

?>
