<?php
Class defaultController extends K980K_Controller_Action_Smarty {
    private static $rsyncdconf = '/etc/rsyncd.conf';
    private static $rsyncSyslogOption = array('auth', 'authpriv', 'cron', 'daemon', 'ftp',
        'kern', 'lpr', 'mail', 'news', 'security', 'syslog', 'user', 'uucp', 'local0', 'local1',
        'local2', 'local3', 'local4', 'local5', 'local6' , 'local7');
    public $menucurrent = 'service';
    public $menuopen = 'service';
    public function __construct($options, $extendData) {
        parent::__construct($options, $extendData);
        $view = $this->getViewInstance();
        $view->addTitle('service');
    }
    public function defaultAction() {
        $this->exec('ls', $a, $b);
    }
    //put your code here

    private function readRsyncGlobal() {
        // read global configurations
        $rsyncd = file(self::$rsyncdconf);
        if($rsyncd == FALSE)
            die('cannot open rsyncd.conf');
        foreach($rsyncd as $line) {
            $dataline = trim($line);
            $firstchar = substr($dataline, 0, 1);

            if( $firstchar == '#' or $firstchar == ';' or empty($dataline))
                continue;
            if( $firstchar == '[' )
                break;  // end of global settings
            else {
                $fields = explode('=', $dataline);
                #var_dump($fields);
                $fields[0] = trim($fields[0]);
                $fields[1] = trim($fields[1]);
                $rsyncGlobal[$fields[0]] = $fields[1];
            }
        }
        return $rsyncGlobal;
    }

    public function ftpmanagementAction() {
        $request = new K980K_Request();
        $view = $this->getViewInstance();
        $viewOptions = $this->getViewOptions();
        $shell = new K980K_Shell();

        if($request->isPost()) {
            $port = $_POST["port"];
            $clients_num = $_POST["clients_num"];
            $max_conn = $_POST["max_conn"];
            $max_login = $_POST["max_login"];
            $timeout = $_POST["timeout"];
            $permit_root_login = $_POST["permit_root_login"];
            $Banner = $_POST["Banner"];
            $execMessage = "";
            //max_login times
            $args1 = '-i \'s/^[ \t]*loginfails[ \t]*[0-9]*'
                    .'/loginfails\t'."$max_login".'/g\' /etc/ftpd/ftpaccess 2>&1';
            $return1 = $shell->exec('pfexec /usr/gnu/bin/sed',$args1);
            $execMessage .= "$return1\n";
            //timeout
            $args1 = '-i \'s/^.*timeout[ \t]*idle.*'
                    .'/timeout\t\tidle\t\t'."$timeout".'/g\' /etc/ftpd/ftpaccess 2>&1';
            $return2 = $shell->exec('pfexec /usr/gnu/bin/sed',$args1);
            $execMessage .= "$return2\n";
            //banner
            $output = $shell->exec("pfexec sed -n '/^[ \t]*banner[ \t]*/p' /etc/ftpd/ftpaccess");
            $blocks = explode("\t", $output[0]);
            $filename = trim($blocks[2]);
            $bannerfile = fopen($filename, "w");
            $newbanners = explode("\n", $_POST["Banner"]);
            foreach ($newbanners as $abanner) {
                fprintf($bannerfile, "%s\n", $abanner);
            }
            fclose($bannerfile);
            //port
            $args1 = '-i \'s/^[ \t]*ftp[ \t]*[0-9]*\/tcp'
                    .'/ftp\t\t'."$port".'\/tcp'.'/g\' /etc/services 2>&1';
            $return3 = $shell->exec('pfexec /usr/gnu/bin/sed',$args1);
            $execmessage .= "$return3\n";
            $shell->exec('pfexec svcadm restart ftp');
        }

        $timeoutLines = $shell->exec("pfexec sed -n '/^.*timeout[ \t]*idle/p' /etc/ftpd/ftpaccess");
        $otimeoutLine = explode("\t", $timeoutLines[0]);
        $otimeout = $otimeoutLine[4];
        $view->assign('otimeout', $otimeout);

        $loginLines = $shell->exec("pfexec sed -n '/^[ \t]*loginfails[ \t]*/p' /etc/ftpd/ftpaccess");
        $originLogins = explode("\t", $loginLines[0]);
        $originLogin = trim($originLogins[1]);
        $view->assign('originLogin',$originLogin);

        $output = $shell->exec("pfexec sed -n '/^[ \t]*banner[ \t]*/p' /etc/ftpd/ftpaccess");
        $blocks = explode("\t", $output[0]);
        $filename = trim($blocks[2]);
        $bannerfile = fopen($filename, "r");
        $obanners = "";
        while(true) {
            $line = fgets($bannerfile, 1024);
            if(!$line) break;
            $obanners .= $line;
        }

        $output = $shell->exec("pfexec sed -n '/^[ \t]*ftp[ \t]*[0-9]*\/tcp/p' /etc/services");
        $blocks1 = explode("\t", $output[0]);
        $blocks2 = explode("/", $blocks1[2]);
        $oport = trim($blocks2[0]);
        $view->assign('oport', $oport);
        $view->assign("obanners", $obanners);
        $view->assign('subaction', 'ftpmanagement');
        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile', 'element/ftpmanagement.html');
        $view->addTitle('ftpmanagement');
        $this->display();
    }

    public function sshmanagementAction() {
        $request = new K980K_Request();
        $view = $this->getViewInstance();
        $viewOptions = $this->getViewOptions();
        $shell = new K980K_Shell();

        if($request->isPost()) {
            $port = $_POST["port"];
            $permit_root_login = ($_POST["permit_root_login"]) ? "yes" : "no";
            $password_authentication = $_POST["password_authentication"] ? "yes" : "no";
            $tcp_forwarding = $_POST["tcp_forwarding"] ? "yes" : "no";
            $compression = $_POST["compression"];
            $private_key = $_POST["private_key"];
            $extra_options = $_POST["extra_options"];
            $execMessage = "";
            $args1 = '-i \'s/^[ \t]*PermitRootLogin[ \t]*.*'
                    .'/PermitRootLogin\t'."$permit_root_login".'/g\' /etc/ssh/sshd_config 2>&1';
            $return1 = $shell->exec('pfexec /usr/gnu/bin/sed', $args1);
            $execMessage .= $return1;

            $args2 = '-i \'s/^[ \t]*PasswordAuthentication[ \t]*.*'
                    .'/PasswordAuthentication '."$password_authentication".'/g\' /etc/ssh/sshd_config 2>&1';
            $return2 = $shell->exec('pfexec /usr/gnu/bin/sed', $args2);
            $execMessage .= $return2;

            $args3 = '-i \'s/^[ \t]*AllowTcpForwarding[ \t]*.*'
                    .'/AllowTcpForwarding '."$tcp_forwarding".'/g\' /etc/ssh/sshd_config 2>&1';
            $return3 = $shell->exec('pfexec /usr/gnu/bin/sed', $args3);
            $execMessage .= $return3;

            if($private_key != "") {
                $output = $shell->exec("pfexec sed -n '/[ \t]*HostKey.*rsa/p' /etc/ssh/sshd_config");
                $blocks = explode(" ", $output[0]);
                $filename = trim($blocks[1]);
                $file = fopen($filename, "w");
                $num = fprintf($file, "%s", $private_key);
                fclose($file);
            }
            $shell->exec('pfexec svcadm restart shh');
        }

        $output = $shell->exec("pfexec sed -n '/[ \t]*PermitRootLogin[ \t]*.*/p' /etc/ssh/sshd_config");
        $blocks = explode("\t", $output[0]);
        $opermit_root_login = trim($blocks[1]);
        $view->assign("opermit_root_login", $opermit_root_login);

        $output = $shell->exec("pfexec sed -n '/^[ \t]*PasswordAuthentication[ \t]*.*/p' /etc/ssh/sshd_config");
        $blocks = explode(" ", $output[0]);
        $opassword_authentication = trim($blocks[1]);
        $view->assign("opassword_authentication", $opassword_authentication);

        $output = $shell->exec("pfexec sed -n '/^[ \t]*AllowTcpForwarding[ \t]*.*/p' /etc/ssh/sshd_config");
        $blocks = explode(" ", $output[0]);
        $otcp_forwarding = trim($blocks[1]);
        $view->assign("otcp_forwarding", $otcp_forwarding);

        $view->assign("subaction", 'sshmanagement');
        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile', 'element/sshmanagement.html');
        $view->addTitle('sshmanagement');
        $this->display();
    }

    public function smbmanagementAction() {
        $request = new K980K_Request();

        $view = $this->getViewInstance();
        $viewOptions = $this->getViewOptions();

        if($request->isPost()) {
            $shell = new K980K_Shell();
            $netbios = $_POST["netbios"];
            $workgroup = $_POST["workgroup"];
            $security = $_POST["security"];
            $uCharset = $_POST["unixCharset"];
            $dCharset = $_POST["dosCharset"];
            $disCharset = $_POST["displayCharset"];
            $guestAccount = $_POST["guestAccount"];

            $oNetbios = $_POST["originNetbios"];
            $oWorkgroup = $_POST["originWorkgroup"];
            $oSecurity = $_POST["originSecurity"];
            $oUnixcharset = $_POST["originUnixcharset"];
            $oDoscharset = $_POST["originDoscharset"];
            $oDisplaycharset = $_POST["originDisplaycharset"];
            $oGuestaccount = $_POST["originGuestaccount"];

            $execMessage = "";
            if($netbios != $oNetbios) {
                $args1 = '-i \'s/^[ \t]*netbios[ \t]*=[ \t]*'."$oNetbios"
                        .'/    netbios = '."$netbios".'/g\' /etc/sfw/smb.conf 2>&1';
                $return1 = $shell->exec('pfexec /usr/gnu/bin/sed',$args1);
                if ($return1 != null)
                    $execMessage .= "$return1\n";
            }


            if($workgroup != $oWorkgroup) {
                $args2 = '-i \'s/^[ \t]*workgroup[ \t]*=[ \t]*'."$oWorkgroup"
                        .'/    workgroup = '."$workgroup".'/g\' /etc/sfw/smb.conf';
                $return2 = $shell->exec('pfexec /usr/gnu/bin/sed',$args2);
                if ($return2 != null)
                    $execMessage .= "$return2\n";
            }

            if($security != $oSecurity) {
                $args3 = '-i \'s/^[ \t]*security[ \t]*=[ \t]*'."$oSecurity"
                        .'/    security = '."$security".'/g\' /etc/sfw/smb.conf';
                $return3 = $shell->exec('pfexec /usr/gnu/bin/sed',$args3);
                if ($return3 != null)
                    $execMessage .= "$return3\n";
            }

            if($uCharset != $oUnixcharset) {
                $args4 = '-i \'s/^[ \t]*unix charset[ \t]*=[ \t]*'."$oUnixcharset"
                        .'/    unix charset = '."$uCharset".'/g\' /etc/sfw/smb.conf';
                $return4 = $shell->exec('pfexec /usr/gnu/bin/sed',$args4);
                if ($return4 != null)
                    $execMessage .= "$return4\n";
            }

            if($dCharset != $oDoscharset) {
                $args5 = '-i \'s/^[ \t]*dos charset[ \t]*=[ \t]*'."$oWorkgroup"
                        .'/    dos charset = '."$workgroup".'/g\' /etc/sfw/smb.conf';
                $return5 = $shell->exec('pfexec /usr/gnu/bin/sed',$args5);
                if ($return5 != null)
                    $execMessage .= "$return5\n";
            }

            if($disCharset != $oDisplaycharset) {
                $args6 = '-i \'s/^[ \t]*display charset[ \t]*=[ \t]*'."$oDisplaycharset"
                        .'/    display charset = '."$disCharset".'/g\' /etc/sfw/smb.conf';
                $return6 = $shell->exec('pfexec /usr/gnu/bin/sed',$args6);
                if ($return6 != null)
                    $execMessage .= "$return6\n";
            }

            if($guestAccount != $oGuestaccount) {
                $args7 = '-i \'s/^[ \t]*[ \t]*guest account=[ \t]*'."$oGuestaccount"
                        .'/    guest account = '."$guestAccount".'/g\' /etc/sfw/smb.conf';
                $return7 = $shell->exec('pfexec /usr/gnu/bin/sed',$args7);
                if ($return7 != null)
                    $execMessage .= "$return7\n";
            }

            if(empty ($execMessage))
                $execMessage = "Restart Done!";
            $view->assign('execMessage', $execMessage);
            $shell->exec('pfexec svcadm restart samba');
        }

        $shell = new K980K_Shell();
        $doscharset = array('UTF-8','CP936','ASCII');
        $unixcharset = array('UTF-8','gbk','gb2312','ASCII');
        $displaycharset = array('UTF-8','gbk','gb2312','ASCII');
        $view->assign('doscharset',$doscharset);
        $view->assign('unixcharset',$unixcharset);
        $view->assign('displaycharset',$displaycharset);


        $netbiosLines = $shell->exec("pfexec sed -n '/^[ \t]*netbios[ \t]*=/p' /etc/sfw/smb.conf");
        $originNetbioss = explode("=", $netbiosLines[0]);
        $originNetbios = trim($originNetbioss[1]);
        $view->assign('originNetbios',$originNetbios);
        #var_dump($originNetbios);
        // now originnetbios[1] is the value we want. The following arguments are of the same way.

        $workgroupLines = $shell->exec("pfexec sed -n '/^[ \t]*workgroup[ \t]*=/p' /etc/sfw/smb.conf");
        $originWorkgroups = explode("=", $workgroupLines[0]);
        $originWorkgroup = trim($originWorkgroups[1]);
        $view->assign('originWorkgroup',$originWorkgroup);
        #var_dump($originWorkgroup);

        $securityLines = $shell->exec("pfexec sed -n '/^[ \t]*security[ \t]*=/p' /etc/sfw/smb.conf");
        $originSecurities = explode("=", $securityLines[0]);
        $originSecurity = trim($originSecurities[1]);
        $view->assign('originSecurity',$originSecurity);
        #var_dump($originSecurity);

        $doscharsetLines = $shell->exec("pfexec sed -n '/^[ \t]*dos charset[ \t]*=/p' /etc/sfw/smb.conf");
        $originDoscharsets = explode("=", $doscharsetLines[0]);
        $originDoscharset = trim($originDoscharsets[1]);
        $view->assign('originDoscharset',$originDoscharset);
        #var_dump($originDoscharset);

        $unixcharsetLines = $shell->exec("pfexec sed -n '/^[ \t]*unix charset[ \t]*=/p' /etc/sfw/smb.conf");
        $originUnixcharsets = explode("=", $unixcharsetLines[0]);
        $originUnixcharset = trim($originUnixcharsets[1]);
        $view->assign('originUnixcharset',$originUnixcharset);

        $displaycharsetLines = $shell->exec("pfexec sed -n '/^[ \t]*display charset[ \t]*=/p' /etc/sfw/smb.conf");
        $originDisplaycharsets = explode("=", $displaycharsetLines[0]);
        $originDisplaycharset = trim($originDisplaycharsets[1]);
        $view->assign('originDisplaycharset',$originDisplaycharset);

        $guestaccountLines = $shell->exec("pfexec sed -n '/^[ \t]*guest account[ \t]*=/p' /etc/sfw/smb.conf");
        $originGuestaccounts = explode("=", $guestaccountLines[0]);
        $originGuestaccount = trim($originGuestaccounts[1]);
        $view->assign('originGuestaccount',$originGuestaccount);
        #var_dump($originGuestaccount);


        $view->assign('subaction', 'smbmanagement');
        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile', 'element/smbmanagement.html');
        $view->addTitle('smbmanagement');
        $this->display();
    }

    public function nfsmanagementAction() {
        $request = new K980K_Request();
        $view = $this->getViewInstance();
        $viewOptions = $this->getViewOptions();
        $shell = new K980K_Shell();

        if($request->isPost()) {
            $nfs_server_versmax = $_POST["nfs_server_versmax"];
            $nfs_server_versmin = $_POST["nfs_server_versmin"];
            $nfs_client_versmax = $_POST["nfs_client_versmax"];
            $nfs_client_versmin = $_POST["nfs_client_versmin"];

            $args1 = '-i \'s/.*NFS_SERVER_VERSMAX.*'
                    .'/NFS_SERVER_VERSMAX='."$nfs_server_versmax".'/g\' /etc/default/nfs';
            $return1 = $shell->exec('pfexec /usr/gnu/bin/sed',$args1);

            $args2 = '-i \'s/.*NFS_SERVER_VERSMIN.*'
                    .'/NFS_SERVER_VERSMIN='."$nfs_server_versmin".'/g\' /etc/default/nfs';
            $return2 = $shell->exec('pfexec /usr/gnu/bin/sed',$args2);

            $args3 = '-i \'s/.*NFS_CLIENT_VERSMAX.*'
                    .'/NFS_CLIENT_VERSMAX='."$nfs_client_versmax".'/g\' /etc/default/nfs';
            $return3 = $shell->exec('pfexec /usr/gnu/bin/sed',$args3);

            $args4 = '-i \'s/.*NFS_CLIENT_VERSMIN.*'
                    .'/NFS_CLIENT_VERSMIN='."$nfs_client_versmin".'/g\' /etc/default/nfs';
            $return4 = $shell->exec('pfexec /usr/gnu/bin/sed',$args4);
            $shell->exec('pfexec svcadm restart nfs/server');
        }

        $nfs_server_versmax_lines = $shell->exec("pfexec sed -n '/.*NFS_SERVER_VERSMAX.*/p' /etc/default/nfs");
        #var_dump($nfs_server_versmax_lines);
        $nfs_server_versmax_line = explode("=", $nfs_server_versmax_lines[0]);
        $onfs_server_versmax = trim($nfs_server_versmax_line[1]);
        $view->assign("onfs_server_versmax", $onfs_server_versmax);

        $nfs_server_versmin_lines = $shell->exec("pfexec sed -n '/.*NFS_SERVER_VERSMIN.*/p' /etc/default/nfs");
        $nfs_server_versmin_line = explode("=", $nfs_server_versmin_lines[0]);
        $onfs_server_versmin = trim($nfs_server_versmin_line[1]);
        $view->assign("onfs_server_versmin", $onfs_server_versmin);

        $nfs_client_versmax_lines = $shell->exec("pfexec sed -n '/.*NFS_CLIENT_VERSMAX.*/p' /etc/default/nfs");
        $nfs_client_versmax_line = explode("=", $nfs_client_versmax_lines[0]);
		$onfs_client_versmax = trim($nfs_client_versmax_line[1]);
		//var_dump($onfs_client_versmax);
        $view->assign("onfs_client_versmax", $onfs_client_versmax);

        $nfs_client_versmin_lines = $shell->exec("pfexec sed -n '/.*NFS_CLIENT_VERSMIN.*/p' /etc/default/nfs");
        $nfs_client_versmin_line = explode("=", $nfs_client_versmin_lines[0]);
        $onfs_client_versmin = trim($nfs_client_versmin_line[1]);
        $view->assign("onfs_client_versmin", $onfs_client_versmin);

        $view->assign('subaction', 'nfsmanagement');
        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile', 'element/nfsmanagement.html');
        $view->addTitle('nfsmanagement');
        $this->display();
    }
    public function httpmanagementAction() {
        $request = new K980K_Request();
        $view = $this->getViewInstance();
        $viewOptions = $this->getViewOptions();
        $shell = new K980K_Shell();

        if($request->isPost()) {
            $port = $_POST["port"];
            $documentRoot = $_POST["document_root"];
            $args1 = '-i \'s/^Listen.*'
                    .'/Listen '."$port".'/g\' /etc/apache2/2.2/httpd.conf';
            $return1 = $shell->exec('pfexec /usr/gnu/bin/sed',$args1);

            #var_dump(is_dir($documentRoot));

            if( is_dir($documentRoot) ){
                for($i = 0; $i < strlen($documentRoot); $i++){
                    if($documentRoot[$i] == '/')
                        $newDocumentRoot .= '\\';
                    $newDocumentRoot .= $documentRoot[$i];
                }
                #var_dump($newDocumentRoot);
                $args2 = '-i \'s/^DocumentRoot.*'
                        .'/DocumentRoot '."$newDocumentRoot".'/g\' /etc/apache2/2.2/httpd.conf';
                $return2 = $shell->exec('pfexec /usr/gnu/bin/sed',$args2);
            }
            #var_dump($args1);
            #var_dump($args2);
            $shell->exec('pfexec svcadm disable svc:/network/http:apache22');
            $shell->exec('pfexec svcadm enable svc:/network/http:apache22');
        }
        $port_lines = $shell->exec("pfexec sed -n '/^Listen.*/p' /etc/apache2/2.2/httpd.conf");
        $port_line = explode(" ", $port_lines[0]);
        $oport = trim($port_line[1]);
        $view->assign("oport", $oport);

        $document_root_lines = $shell->exec("pfexec sed -n '/^DocumentRoot.*/p' /etc/apache2/2.2/httpd.conf");
        $document_root_line = explode(" ", $document_root_lines[0]);
        $odocument_root = trim($document_root_line[1]);
        $view->assign("odocument_root", $odocument_root);

        $view->assign('subaction', 'httpmanagement');
        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile', 'element/httpmanagement.html');
        $view->addTitle('httpmanagement');
        $this->display();
    }

    public function rsyncmanagementAction() {
        $view = $this->getViewInstance();
        $viewOptions = $this->getViewOptions();
        $request = new K980K_Request();

        if($request->isPost()) {
            $global = $this->readRsyncGlobal();
            $oldMaxConnections = $global['max connections'];
            $oldLogFile = $global['log file'];
            $oldPidFile = $global['pid file'];
            $oldSyslog = $global['syslog facility'];

            $maxConnections = $_POST['maxConnections'];
            $logFile = $_POST['logFile'];
            $pidFile = $_POST['pidFile'];
            $syslog = $_POST['syslog'];

            $shell = new K980K_Shell();

            if($maxConnections != $oldMaxConnections){
                $args1 = '-i \'s/^[ \t]*max connections[ \t]*=[ \t]*'."$oldMaxConnections"
                        .'/    max connections = '."$maxConnections".'/g\' '.self::$rsyncdconf;
                $return1 = $shell->exec('pfexec /usr/gnu/bin/sed',$args1);
            }
            if($logFile != $oldLogFile){
                $args1 = '-i \'s/^[ \t]*log file[ \t]*=[ \t]*'."$oldLogFile"
                        .'/    log file = '."$logFile".'/g\' '.self::$rsyncdconf;
                $return1 = $shell->exec('pfexec /usr/gnu/bin/sed',$args1);
            }
            if($pidFile != $oldPidFile){
                $args1 = '-i \'s/^[ \t]*pid file[ \t]*=[ \t]*'."$oldPidFile"
                        .'/    pid file = '."$pidFile".'/g\' '.self::$rsyncdconf;
                $return1 = $shell->exec('pfexec /usr/gnu/bin/sed',$args1);
            }
            if($syslog != $oldSyslog){
                $args1 = '-i \'s/^[ \t]*syslog facility[ \t]*=[ \t]*'."$oldSyslog"
                        .'/    syslog facility = '."$syslog".'/g\' '.self::$rsyncdconf;
                $return1 = $shell->exec('pfexec /usr/gnu/bin/sed',$args1);
            }
        }

        $global = $this->readRsyncGlobal();
        #var_dump($global);
        $maxConnections = $global['max connections'];
        $logFile = $global['log file'];
        $pidFile = $global['pid file'];
        $syslog = $global['syslog facility'];

        $view->assign('maxConnections',$maxConnections);
        $view->assign('logFile',$logFile);
        $view->assign('pidFile',$pidFile);
        $view->assign('syslog',$syslog);
        $view->assign('syslogOption',self::$rsyncSyslogOption);

        if(empty($syslog))
            $syslogEmptyFlag = TRUE;
        $view->assign('syslogEmptyFlag',$syslogEmptyFlag);
        
        $view->assign('subaction', 'rsyncmanagement');
        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile', 'element/rsyncmanagement.html');
        $view->addTitle('rsyncmanagement');
        $this->display();
    }
}	
?>
