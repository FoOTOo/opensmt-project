<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */

class diskinfoController extends K980K_Controller_Action_Smarty {
    public $menucurrent = 'Disk';
    public $menuopen = 'Disk';

    public function  __construct($options,$extendData) {
       parent::__construct($options, $extendData);
       $view = $this->getViewInstance();
       $view->addTitle('Disk');
    }
    public function defaultAction() {
        $shell = new K980K_Shell();
	$view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();
	$return = $shell->exec('pfexec format');

	$myArray = array();
	$diskNum = (count($return) - 5) / 2;
	//var_dump($diskNum);
	for ($i = 0; $i < $diskNum; $i++) {
		$myArray[$i] = array();
		$diskName = explode('.', $return[4+$i*2]);
		//var_dump($diskName[1]);
		array_push($myArray[$i], $diskName[1]);
		$diskInfo = $return[5+$i*2];
		//var_dump($diskInfo);
		$diskInfoParts = explode('/', $diskInfo);
		//var_dump($diskInfoParts[4]);
		if (strstr($diskInfo, 'cmdk')) $dotPart = explode(',', $diskInfoParts[4]);
		else $dotPart = explode(',', $diskInfoParts[3]);
				$atPart = explode('@', $dotPart[0]);
		//var_dump($dotPart[0]);
		if (strstr($diskInfo, 'cmdk')) $diskNickName = $atPart[0].$atPart[1];
		else $diskNickName = 'sd'.$atPart[1];
                //var_dump($diskNickName);
                $return2 = $shell->exec('pfexec iostat -E', $diskNickName);
				//var_dump($return2[1]);
		if (strstr($diskInfo, 'cmdk')) {
                $infoParts = explode(' ', $return2[1]);
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
		else {
			$infoParts = explode(' ', $return2[1]);
			for ($j = 0; $j < count($infoParts); $j++) {
				if ($infoParts[$j] == 'Product:') {
					$tmpStr = '';
					$j++;
					while ($infoParts[$j] != 'Revision:') {
						$tmpStr = $tmpStr.$infoParts[$j].' ';
						$j++;
					}
					array_push($myArray[$i], $tmpStr);
				}
				if ($infoParts[$j] == 'No:') {
					$tmpStr = '';
					$j++;
					while ($j < count($infoParts)) {
						$tmpStr = $tmpStr.$infoParts[$j];
						$j++;
					}
					array_push($myArray[$i], $tmpStr);
				}
			}
			$infoParts = explode(' ', $return2[2]);
			array_push($myArray[$i], $infoParts[1]);
		}
	}
	//var_dump($myArray);
	$view->assign('myArray', $myArray);
        $view->assign('subaction','diskinfo');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/diskinfo.html');
	$view->addTitle('diskinfo');
	$this->display();
    }
}

?>
