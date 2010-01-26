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
    public $menucurrent = 'disk';
    public $menuopen = 'disk';
    public function  __construct($options,$extendData) {       
       parent::__construct($options, $extendData);
       $view = $this->getViewInstance();
       $view->addTitle('disk');
    }
    public function defaultAction() {
        exec('ls',$a,$b);
        //var_dump($a,$b);
    }
    //put your code here

    public function diskinfoAction() {
	$shell = new K980K_Shell();
	$view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();
	$return = $shell->exec('pfexec format');

	$myArray = array();
	$diskNum = (count($return) - 5) / 2;
	for ($i = 0; $i < $diskNum; $i++) {
		$myArray[$i] = array();
		$diskName = explode('.', $return[4+$i*2]);
		array_push($myArray[$i], $diskName[1]);
		$diskInfo = $return[5+$i*2];
                $diskInfoParts = explode('/', $diskInfo);
                $dotPart = explode(',', $diskInfoParts[4]);
                $atPart = explode('@', $dotPart[0]);
                $diskNickName = $atPart[0].$atPart[1];
                //var_dump($diskNickName);
                $return = $shell->exec('pfexec iostat -E', $diskNickName);
                //var_dump($return[1]);
                $infoParts = explode(' ', $return[1]);
                //var_dump($infoParts);
                for ($j = 0; $j < count($infoParts); $j++) {
                    if ($infoParts[$j] == 'Model:') {
                        $tmpStr = '';
                        $j++;
                        while ($infoParts[$j] != 'Revision:') {
                            $tmpStr = $tmpStr.$infoParts[$j].' ';
                            $j++;
                        }
                        //var_dump($tmpStr);
                        array_push($myArray[$i], $tmpStr);
                    }
                    if ($infoParts[$j] == 'No:') {
                        $tmpStr = '';
                        $j++;
                        while ($infoParts[$j] != 'Size:') {
                            if ($infoParts[$j] != '') $tmpStr = $tmpStr.$infoParts[$j];
                            $j++;
                        }
                        //var_dump($tmpStr);
                        array_push($myArray[$i], $tmpStr);
                    }
                    if ($infoParts[$j] == 'Size:') {
                        $tmpStr = $infoParts[++$j];
                        //var_dump($tmpStr);
                        array_push($myArray[$i], $tmpStr);
                    }
                }
		//array_push($myArray[$i], $diskInfo);
	}
	//var_dump($myArray);
	$view->assign('myArray', $myArray);
        $view->assign('subaction','diskinfo');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/diskinfo.html');
	$view->addTitle('diskinfo');
	$this->display();
    }

    public function get_zpool_list() {
	    $shell = new K980K_Shell();
	    $return = $shell->exec('pfexec zpool list -Ho name');
	    return $return;
    }

    public function zpoolinfoAction() {
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
                }
                if ($_POST[$arg.'S'] == 'Scrub') {
                    $return = $shell2->exec("pfexec zpool scrub", $arg);
                }
                else if ($_POST[$arg.'S'] == 'Stop Scrub') {
                    $return = $shell2->exec("pfexec zpool scrub -s", $arg);
                }
		$execMessage = $return;
		$view->assign('execMessage', $execMessage);
	}
        $zpool_name = $this->get_zpool_list();
        $scrub_finish = array();
        foreach ($zpool_name as $zpool) {
            $return = $shell->exec("pfexec zpool status $zpool | grep scrub");
            //var_dump($return);
            array_push($scrub_finish, strstr($return[0], "in progress") ? 0 : 1);
        }
        //var_dump($scrub_finish);
        $view->assign('scrubfinish', $scrub_finish);
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile','element/zpoolinfo.html');
        $view->assign('subaction','zpoolinfo');
        $view->addTitle('zpoolinfo');
        $this->display();
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
		else $execMessage = "Created Successful!";
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
			    $cmd = "zpool destroy";
			    $arg = "$pool_name";
		    }
		    if ($_POST["opType"] == "add") {
			    $cmd = "zpool add";
			    $poolType = $_POST["vdeviceType"];
			    $disk1 = $_POST["disk1"];
			    $disk2 = $_POST["disk2"];
			    $disk3 = $_POST["disk3"];
			    $arg = "$pool_name $poolType $disk1 $disk2 $disk3";
		    }
		    if ($_POST["opType"] == "attach") {
			    $cmd = "zpool attach";
			    $disk1 = $_POST["disk1"];
			    $disk2 = $_POST["disk2"];
			    $disk3 = $_POST["disk3"];
			    $arg = "$pool_name $disk1 $disk2 $disk3";
		    }
		    if ($_POST["opType"] == "detach") {
			    $cmd = "zpool detach";
			    $disk1 = $_POST["disk1"];
			    $disk2 = $_POST["disk2"];
			    $disk3 = $_POST["disk3"];
			    $arg = "$pool_name $disk1 $disk2 $disk3";
		    }
		    if ($_POST["opType"] == "clear") {
			    $cmd = "zpool clear";
			    $arg = "$pool_name";
		    }
		    if ($_POST["opType"] == "replace") {
			    $cmd = "zpool replace";
			    $disk1 = $_POST["disk1"];
			    $disk2 = $_POST["disk2"];
			    $arg = "$pool_name $disk1 $disk2";
		    }
		    $return = $shell->exec($cmd, $args);
		    if ($return != null) $execMessage = $return;
		    else $execMessage = "Created Successful!";
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
