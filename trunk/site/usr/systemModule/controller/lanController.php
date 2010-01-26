<?php

class lanController extends K980K_Controller_Action_Smarty {
    private static $nwamFMRI = 'svc:/network/physical:nwam';
    private static $gwFile = '/etc/defaultrouter';
    private static $nodenameFile = '/etc/nodename';
    private static $netmaskFile = '/etc/netmasks';
    private static $netFMRI = 'svc:/network/physical:default';

    public $menucurrent = 'System';
    public $menuopen = 'System';
    public function  __construct($options,$extendData) {
       parent::__construct($options, $extendData);
       $view = $this->getViewInstance();
       $view->addTitle('System');
    }

    private function readinet(){
        $shell = new K980K_Shell();

        $systemInfo = null;
        $systemInfo = $shell->pfexec('ifconfig -a');

        $extendData = $this->_extendData;
        if(isset($extendData['type'])){

        }
        $etcList = array();
        $i = 0;
        #var_dump($systemInfo);
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
        }
        return $etcArray[0];
    }

    public function defaultAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        $request = new K980K_Request();
        if($request->isPost()){
            $shell = new K980K_Shell();
//            $rawhostname = $shell->exec('pfexec ls /etc/hostname*');
//            $hostname = $rawhostname[0];
//            $rawipv4 = $shell->exec("pfexec cat $hostname");
//            $oldIpv4 = $rawipv4[0];
//            
            $interface = $this->readinet();
            $oldIpv4 = $interface['inet'];

            $rawnwam = $shell->exec('pfexec svcs '.self::$nwamFMRI);
            // STATE          STIME    FMRI
            // disabled       Jan_12   svc:/network/physical:nwam
            $nwamStatus = preg_split("/[\s]+/", $rawnwam[1]);
            if($nwamStatus[0] == 'disabled')
                $oldDhcp = FALSE;
            else
                $oldDhcp = TRUE;
            $rawgateway = $shell->exec('pfexec cat '.self::$gwFile);
            $oldGateway = $rawgateway[0];
            $ifconfig = $shell->exec('pfexec ifconfig -a |grep \''.$oldIpv4.' netmask\'');
            // inet 173.26.100.33 netmask ffffff00 broadcast 173.26.100.255
            $rawnetmask = preg_split("/[\s]+/", $ifconfig[0]);
            // $rawnetmask[0] is an empty element, don't know why
            $maskfield = $rawnetmask[4][0].$rawnetmask[4][1];
            $maskfield = hexdec($maskfield);
            $oldNetmask = $maskfield.'.';
            $maskfield = $rawnetmask[4][2].$rawnetmask[4][3];
            $maskfield = hexdec($maskfield);
            $oldNetmask .= $maskfield.'.';
            $maskfield = $rawnetmask[4][4].$rawnetmask[4][5];
            $maskfield = hexdec($maskfield);
            $oldNetmask .= $maskfield.'.';
            $maskfield = $rawnetmask[4][6].$rawnetmask[4][7];
            $maskfield = hexdec($maskfield);
            $oldNetmask .= $maskfield;

            $rawnodename = $shell->exec('pfexec cat '.self::$nodenameFile);
            $oldNodename = $rawnodename[0];

            $nodename = $_POST['nodename'];
            $netmask = $_POST['mask'];
            $gateway = $_POST['gateway'];
            $ipv4 = $_POST['ipv4'];

            if($nodename != $oldNodename){
                $shell->exec('pfexec cp '.self::$nodenameFile.' /etc/nodename.bak');
                $shell->exec("pfexec echo $nodename > ".self::$nodenameFile);
            }

            if($oldDhcp){
                if( !isset ($_POST['dhcp'])){
                    $shell->exec('pfexec svcadm disable '.self::$nwamFMRI);

                    $hostsFile = file('/etc/hosts');
                    if($hostsFile == FALSE)
                        die('/etc/hosts cannot be opened');

                    if($nodename != $oldNodename)
                        $newfile = str_replace($oldNodename, $nodename, $hostsFile);
                    $newfile = str_replace($oldIpv4, $ipv4, $hostsFile);

                    $ipfields = explode('.',$ipv4);
                    $maskfields = explode('.', $netmask);

                    for($i = 0; $i < 4; $i++){
                        $temp = (int)$ipfields[$i] & (int)$maskfields[$i];
                        $ipmask .= $temp;
                        if($i < 3)
                            $ipmask .= '.';
                    }
                    #var_dump($ipmask);


                    $hostsfp = fopen('/etc/hosts','w');
                    $ipnodesfp = fopen('/etc/inet/ipnodes','w');
                    $shell->exec('pfexec cp /etc/hosts /etc/hosts.bak');
                    $shell->exec('pfexec cp /etc/inet/ipnodes /etc/inet/ipnodes.bak');
                    $shell->exec("pfexec cp $hostname $hostname.bak");
                    $shell->exec('pfexec cp '.self::$gwFile.' '.self::$gwFile.'.bak');
                    $shell->exec('pfexec cp '.self::$netmaskFile.' '.self::$netmaskFile.'.bak');
                    fwrite($hostsfp, $newfile);
                    fwrite($ipnodesfp, $newfile);
                    $shell->exec("pfexec echo $ipv4 > ".$hostname);
                    $shell->exec("pfexec echo $gateway > ".self::$gwFile);
                    $shell->exec("pfexec echo '$ipmask  $netmask' > ".self::$netmaskFile);

                    $shell->exec('pfexec svcadm restart '.self::$netFMRI);

                }
                else{
                    $hostsFile = file('/etc/hosts');
                    if($hostsFile == FALSE)
                        die('/etc/hosts cannot be opened');
                    if($nodename != $oldNodename) {
                        $newfile = str_replace($oldNodename, $nodename, $hostsFile);
                        $hostsfp = fopen('/etc/hosts','w');
                        $ipnodesfp = fopen('/etc/inet/ipnodes','w');
                        $shell->exec('pfexec cp /etc/hosts /etc/hosts.bak');
                        $shell->exec('pfexec cp /etc/inet/ipnodes /etc/inet/ipnodes.bak');
                        $shell->exec("pfexec cp $hostname $hostname.bak");

                        $hostsfp = fopen('/etc/hosts','w');
                        $ipnodesfp = fopen('/etc/inet/ipnodes','w');
                        fwrite($hostsfp, $newfile);
                        fwrite($ipnodesfp, $newfile);
                        fclose($hostsfp);
                        fclose($ipnodesfp);
                    }
                }
            }
            else{
                if(isset ($_POST['dhcp'])){
                    $shell->exec('pfexec svcadm enable '.self::$nwamFMRI);
                    $hostsFile = file('/etc/hosts');
                    if($hostsFile == FALSE)
                        die('/etc/hosts cannot be opened');
                    if($nodename != $oldNodename) {
                        $newfile = str_replace($oldNodename, $nodename, $hostsFile);
                        $hostsfp = fopen('/etc/hosts','w');
                        $ipnodesfp = fopen('/etc/inet/ipnodes','w');
                        $shell->exec('pfexec cp /etc/hosts /etc/hosts.bak');
                        $shell->exec('pfexec cp /etc/inet/ipnodes /etc/inet/ipnodes.bak');
                        $shell->exec("pfexec cp $hostname $hostname.bak");

                        $hostsfp = fopen('/etc/hosts','w');
                        $ipnodesfp = fopen('/etc/inet/ipnodes','w');
                        fwrite($hostsfp, $newfile);
                        fwrite($ipnodesfp, $newfile);
                        fclose($hostsfp);
                        fclose($ipnodesfp);
                    }
                }
                else{
                    $hostsFile = file('/etc/hosts');
                    if($hostsFile == FALSE)
                        die('/etc/hosts cannot be opened');

                    if($nodename != $oldNodename){
                        $newfile = str_replace($oldNodename, $nodename, $hostsFile);
                        $hostsfp = fopen('/etc/hosts','w');
                        $ipnodesfp = fopen('/etc/inet/ipnodes','w');
                        $shell->exec('pfexec cp /etc/hosts /etc/hosts.bak');
                        $shell->exec('pfexec cp /etc/inet/ipnodes /etc/inet/ipnodes.bak');
                        $shell->exec("pfexec cp $hostname $hostname.bak");

                        $hostsfp = fopen('/etc/hosts','w');
                        $ipnodesfp = fopen('/etc/inet/ipnodes','w');
                        fwrite($hostsfp, $newfile);
                        fwrite($ipnodesfp, $newfile);
                        fclose($hostsfp);
                        fclose($ipnodesfp);
                        $shell->exec("pfexec echo $ipv4 > ".$hostname);
                    }

                    $ipfields = explode('.',$ipv4);
                    if($ipv4 != $oldIpv4) {
                        $newfile = str_replace($oldIpv4, $ipv4, $hostsFile);
                        $hostsfp = fopen('/etc/hosts','w');
                        $ipnodesfp = fopen('/etc/inet/ipnodes','w');
                        $shell->exec('pfexec cp /etc/hosts /etc/hosts.bak');
                        $shell->exec('pfexec cp /etc/inet/ipnodes /etc/inet/ipnodes.bak');
                        $shell->exec("pfexec cp $hostname $hostname.bak");

                        $hostsfp = fopen('/etc/hosts','w');
                        $ipnodesfp = fopen('/etc/inet/ipnodes','w');
                        fwrite($hostsfp, $newfile);
                        fwrite($ipnodesfp, $newfile);
                        fclose($hostsfp);
                        fclose($ipnodesfp);
                    }
                    if($netmask != $oldNetmask) {
                        $ipfields = explode('.',$ipv4);
                        $maskfields = explode('.', $netmask);
                        #var_dump($ipfields);
                        #var_dump($maskfields);
                        for($i = 0; $i < 4; $i++) {
                            $temp = (int)$ipfields[$i] & (int)$maskfields[$i];
                            var_dump($temp);
                            $ipmask .= $temp;
                            if($i < 3)
                                $ipmask .= '.';
                        }
                        #var_dump($ipmask);
                        $shell->exec('pfexec cp '.self::$netmaskFile.' '.self::$netmaskFile.'.bak');
                        $shell->exec("pfexec echo '$ipmask  $netmask' > ".self::$netmaskFile);
                    }
                    if($gateway != $oldGateway) {
                        $shell->exec('pfexec cp '.self::$gwFile.' '.self::$gwFile.'.bak');
                        $shell->exec("pfexec echo $gateway > ".self::$gwFile);
                    }
                    $shell->exec('pfexec svcadm restart '.self::$netFMRI);
                }
            }
        }

        $shell = new K980K_Shell();

        $interface = $this->readinet();
        $ipv4 = $interface['inet'];

//        $rawhostname = $shell->exec('pfexec ls /etc/hostname*');
//        $hostname = $rawhostname[0];
//        $rawipv4 = $shell->exec("pfexec cat $hostname");
//        $ipv4 = $rawipv4[0];

        $rawnwam = $shell->exec('pfexec svcs '.self::$nwamFMRI);
        // STATE          STIME    FMRI
        // disabled       Jan_12   svc:/network/physical:nwam
        $nwamStatus = preg_split("/[\s]+/", $rawnwam[1]);
        if($nwamStatus[0] == 'disabled')
            $dhcp = FALSE;
        else
            $dhcp = TRUE;
        $rawgateway = $shell->exec('pfexec cat '.self::$gwFile);
        $gateway = $rawgateway[0];

        $ifconfig = $shell->exec('pfexec ifconfig -a |grep \''.$ipv4.' netmask\'');
        // inet 173.26.100.33 netmask ffffff00 broadcast 173.26.100.255
        $rawnetmask = preg_split("/[\s]+/", $ifconfig[0]);
        // $rawnetmask[0] is an empty element, don't know why
        $maskfield = $rawnetmask[4][0].$rawnetmask[4][1];
        $maskfield = hexdec($maskfield);
        $netmask = $maskfield.'.';
        $maskfield = $rawnetmask[4][2].$rawnetmask[4][3];
        $maskfield = hexdec($maskfield);
        $netmask .= $maskfield.'.';
        $maskfield = $rawnetmask[4][4].$rawnetmask[4][5];
        $maskfield = hexdec($maskfield);
        $netmask .= $maskfield.'.';
        $maskfield = $rawnetmask[4][6].$rawnetmask[4][7];
        $maskfield = hexdec($maskfield);
        $netmask .= $maskfield;

        $rawnodename = $shell->exec('pfexec cat '.self::$nodenameFile);
        $nodename = $rawnodename[0];

        $view->assign('gateway',$gateway);
        $view->assign('dhcp',$dhcp);
        $view->assign('ipv4',$ipv4);
        $view->assign('netmask',$netmask);
        $view->assign('nodename',$nodename);
        #var_dump($nodename);
        
        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile','element/lan.html');
        $view->assign('subaction', 'lan');
        $view->addTitle('LAN');
        $this->display();
    }

}
?>