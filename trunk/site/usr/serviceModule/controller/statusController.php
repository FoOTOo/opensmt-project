<?php
Class statusController extends K980K_Controller_Action_Smarty {
    public $menucurrent = 'service';
    public $menuopen = 'service';

    public function __construct($options, $extendData) {
        parent::__construct($options, $extendData);
        $view = $this->getViewInstance();
        $view->addTitle('service');
    }
    public function disable($svcname) {
        $shell = new K980K_Shell();
        $shell->exec("pfexec svcadm disable ", $svcname);
    }
    public function enable($svcname) {
        $shell = new K980K_Shell();
        $shell->exec("pfexec svcadm enable ", $svcname);
        $shell->exec("pfexec svcadm enable ", $svcname);
        $shell->exec("pfexec svcadm enable ", $svcname);
        $shell->exec("pfexec svcadm enable ", $svcname);
        $shell->exec("pfexec svcadm enable ", $svcname);
    }

    public function defaultAction() {
        $view = $this->getViewInstance();
        $viewOptions = $this->getViewOptions();
        $request = new K980K_Request();
        $shell = new K980K_Shell();

        $ftparg = "svc:/network/ftp:default";
        $smbarg = "svc:/network/samba:default";
        $ssharg = "svc:/network/ssh:default";
        $httparg = "svc:/network/http:apache22";
        $nfsarg = "svc:/network/nfs/server:default";
        $targetarg = "svc:/network/iscsi/target:default";
        $stmfarg = "svc:/system/stmf:default";
        if($request->isPost()) {
            
            if(isset($_POST["ftpenable"]))
                $ftpenable = ($_POST["ftpenable"] == "Enable")? "yes" : "no";
            if(isset($_POST["smbenable"]))
                $smbenable = ($_POST["smbenable"] == "Enable") ? "yes" : "no";
            if(isset($_POST["sshenable"]))
                $sshenable = ($_POST["sshenable"] == "Enable") ? "yes" : "no";
            if(isset($_POST["httpenable"]))
                $httpenable = ($_POST["httpenable"] == "Enable") ? "yes" : "no";
            if(isset($_POST["nfsenable"]))
                $nfsenable = ($_POST["nfsenable"] == "Enable") ? "yes" : "no";
            if(isset($_POST["rsyncdenable"]))
                $rsyncdenable = ($_POST["rsyncdenable"] == "Enable") ? "yes" : "no";
            if(isset($_POST["targetenable"]))
                $targetenable = ($_POST["targetenable"] == "Enable") ? "yes" : "no";
            if(isset($_POST["stmfenable"]))
                $stmfenable = ($_POST["stmfenable"] == "Enable") ? "yes" : "no";

            if(isset($_POST["ftpenable"]))
                if($ftpenable == "yes") $this->enable($ftparg);
                else $this->disable($ftparg);
            if(isset($_POST["smbenable"]))
                if($smbenable == "yes") $this->enable($smbarg);
                else $this->disable($smbarg);
            if(isset($_POST["sshenable"]))
                if($sshenable == "yes") $this->enable($ssharg);
                else $this->disable($ssharg);
            if(isset($_POST["httpenable"]))
                if($httpenable == "yes") $this->enable($httparg);
                else $this->disable($httparg);
            if(isset($_POST["nfsenable"]))
                if($nfsenable == "yes") $this->enable($nfsarg);
                else $this->disable($nfsarg);
            if(isset($_POST["rsyncdenable"])){
                if($rsyncdenable == "yes")
                    $shell->exec('pfexec rsync --daemon');
                else {
                    $process = $shell->exec('pfexec ps aux |egrep \'rsync --daemon\'');
                    $processInfo = preg_split("/[\s]+/", $process[0]);
                    $pid = $processInfo[1];
                    $stop = $shell->exec('pfexec kill',$pid);
                }
            }
            if(isset($_POST["targetenable"]))
                if($targetenable == "yes") $this->enable($targetarg);
                else $this->disable($targetarg);
            if(isset($_POST["stmfenable"]))
                if($stmfenable == "yes") $this->enable($stmfarg);
                else $this->disable($stmfarg);
        }
        $svcsname = array();
        array_push($svcsname, "network/ftp");
        array_push($svcsname, "network/samba");
        array_push($svcsname, "network/ssh");
        array_push($svcsname, "network/http");
        array_push($svcsname, "network/nfs/server");

        $status = $shell->exec("pfexec svcs");
        $oftpstatus = "off";
        $osmbstatus = "off";
        $osshstatus = "off";
        $ohttpstatus = "off";
        $onfsstatus = "off";
        foreach($status as $line) {
            if(strstr($line, $ftparg) && strstr($line, "online")) $oftpstatus = "on";
            if(strstr($line, $smbarg) && strstr($line, "online")) $osmbstatus = "on";
            if(strstr($line, $ssharg) && strstr($line, "online")) $osshstatus = "on";
            if(strstr($line, $httparg) && strstr($line, "online")) $ohttpstatus = "on";
            if(strstr($line, $nfsarg) && strstr($line, "online")) $onfsstatus = "on";
            if(strstr($line, $targetarg) && strstr($line, "online")) $otargetstatus = "on";
            if(strstr($line, $stmfarg) && strstr($line, "online")) $ostmfstatus = "on";
        }

        $rsyncd = $shell->exec('pfexec ps aux|egrep \'rsync --daemon\'');
        #var_dump($rsyncd);
        if(empty ($rsyncd))
            $orsyncdstatus = 'off';
        else
            $orsyncdstatus = 'on';

        $view->assign("oftpstatus", $oftpstatus);
        $view->assign("osmbstatus", $osmbstatus);
        $view->assign("osshstatus", $osshstatus);
        $view->assign("ohttpstatus", $ohttpstatus);
        $view->assign("onfsstatus", $onfsstatus);
        $view->assign("otargetstatus", $otargetstatus);
        $view->assign("ostmfstatus", $ostmfstatus);
        $view->assign("orsyncdstatus",$orsyncdstatus);


        $view->assign('subaction', 'status');
        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile', 'element/status.html');
        $view->addTitle('status');
        $this->display();
    }
}
?>
