<?php

class defaultController extends K980K_Controller_Action_Smarty {
    private static $sambaConf = '/etc/sfw/smb.conf';
    private static $sambaConfBak = '/etc/sfw/smb.conf.bak';
    private static $sharetab = '/etc/dfs/sharetab';

    public $menucurrent = 'Share';
    public $menuopen = 'Share';
    public function  __construct($options,$extendData) {
       parent::__construct($options, $extendData);
       $view = $this->getViewInstance();
       $view->addTitle('Share');
    }

    private function getNfs(){
        $sharetab = file(self::$sharetab);
//        if($sharetab == FALSE)
//            die("cannot open ".self::$sharetab);
        $nfsList = array();
        foreach($sharetab as $sharefs){
            if(strstr($sharefs, "nfs")) {
                // only nfs needed here
                $shareinfo = preg_split("/[\s]+/", trim($sharefs));
                // array $shareinfo includes the following fields:
                // path resource fstype specific_options description
                #var_dump($shareinfo);
                $specificOptions = explode(',', $shareinfo[3]);
                #var_dump($specificOptions);

                foreach($specificOptions as $option) {
                    if(strstr($option,"rw") || strstr($option,"ro")) {
                        if(strstr($option,"=")) {

                            $access = explode("=", $option);
                            $authority = $access[0];
                            $host = explode("/", $access[1]);
                            // we need "rw/ro=host1:host2:host3"
                            // listing hosts in ip address is lile this : rw=@xxx.xxx.xxx.xxx/xx
                            // $access = {rw/ro, host1:host2:host3}
                            // and we assume $access is like {rw/ro, @x.x.x.x/x}

                            $ip = substr($host[0],1);
                            $mask = $host[1];
                            $nfsList[] = array($shareinfo[0],$authority,$ip,$mask,$shareinfo[4]);
                        }
                        else {
                            $authority = $option;
                            $nfsList[] = array($shareinfo[0],$authority,'','',$shareinfo[4]);
                        }
                    }
                }
                // sharelist: path, authority, ip, mask, description
            }
        }
        return $nfsList;
    }

    public function nfsAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();
        $request = new K980K_Request();

        if($request->isPost()){
            if(isset ($_POST['editNfs'])){
                // add/edit
                $path = $_POST['path'];
                if(isset($_POST['authority']))
                    $authority = 'ro';
                else
                    $authority = 'rw';
                $ip = $_POST['ip'];
                $mask = $_POST['mask'];
                $description = $_POST['description'];
                
                $args = '-p -F nfs ';
                if( !empty($authority) ){
                    $args .= "-o $authority";
                    if(!empty($ip))
                        $args .= "=@$ip/$mask ";
                    else
                        $args .= ' ';
                }
                //if( !empty($description) )
                    $args .= "-d '$description' ";
                $args .= "$path";
                $shell = new K980K_Shell();
                #var_dump($args);
                
                $return = $shell->exec("pfexec share", $args);
             }
            else {
                // delete
                $nfsList = $this->getNfs();
                foreach ($nfsList as $nfs) {
                    if($_POST["$nfs[0]".'D']){
                        $targetPath = $nfs[0];
                        break;
                    }
                }
                $shell = new K980K_Shell();
                $return = $shell->exec("pfexec unshare -p -F nfs", $targetPath);
            }
        }

        $nfsList = $this->getNfs();
        $view->assign("nfsList",$nfsList);

        $view->assign('subaction','nfs');
        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile', 'element/nfs.html');
        $view->addTitle('nfs');
        $this->display();
    }

    public function editnfsAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        // add and edit nfs share here
        if(isset($_POST["addnfs"]))
            // add nfs, nothing to set
            ;
        else {
            // edit nfs share
            $nfsList = $this->getNfs();
            foreach( $nfsList as $nfs ) {
                if(isset($_POST[$nfs[0]]) ) {
                    $targetPath = $nfs[0];
                    $nfsArg = $nfs;
                    // array => {path, authority, ip, mask, description}
                }
            }
            $view->assign('nfsArg',$nfsArg);
            //var_dump($nfsArg);
        }

        $view->assign('subaction','editnfs');
        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile', 'element/editnfs.html');
        $view->addTitle('editnfs');
        $this->display();
    }

    private function getSambaConf(){
        $smbconf = file(self::$sambaConf);

        if($smbconf == FALSE)
            die('sth is wrong when open smb.conf');

        $sharedDirSect = FALSE;
        foreach ($smbconf as $line) {
            $dataline = trim($line);
            $firstchar = substr($dataline, 0, 1);

            // skip all comments
            if( $firstchar == '#' or $firstchar == ';' or empty($dataline))
                continue;
            // deal with all sections head like [global] or [sthYouLike]
            if( $firstchar == '[') {
                // get section name, strip all '[' and ']'
                $sectionName = ltrim($dataline, '[');
                $sectionName = rtrim($sectionName, ']');
                // skip system conf
                if( $sectionName == 'global' or $sectionName == 'homes' or
                        $sectionName == 'printers') {
                    $sharedDirSect = FALSE;
                    continue;
                }
                // now the samba share directoris conf we need
                else {
                    $sharedDirSect = TRUE;
                    $smbshares[$sectionName] = array();
                }
            }
            elseif ( $sharedDirSect ) {
                $fields = explode('=', $dataline);
                $fields[0] = trim($fields[0]);
                $fields[1] = trim($fields[1]);

                $smbshares[$sectionName][$fields[0]] = $fields[1];
            }
        }
        return $smbshares;
    }
    
    public function sambaAction() {
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        $request = new K980K_Request();

        if($request->isPost()){
            if(isset ($_POST['editSamba'])){
                // add or edit
                $name = $_POST['name'];
                $comment = $_POST['comment'];
                $path = $_POST['path'];
                $smbconf = file("/etc/sfw/smb.conf");

                if($smbconf == FALSE)
                    die('sth is wrong when open smb.conf...');
                $sharedDirSect = FALSE;
                foreach ($smbconf as $line) {
                    $dataline = trim($line);
                    $firstchar = substr($dataline, 0, 1);

                    // skip all comments
                    if( $firstchar == '#' or $firstchar == ';' or empty($dataline))
                        $newfile .= $line;
                    elseif( $firstchar == '[') {
                        // get section name, strip all '[' and ']'
                        $sectionName = ltrim($dataline, '[');
                        $sectionName = rtrim($sectionName, ']');
                        #var_dump($sectionName);
                        if( $sectionName == $name ) {
                            $sharedDirSect = TRUE;
                        }
                        else{
                            $newfile .= $line;
                            #var_dump($line);
                            if($sharedDirSect)
                                $sharedDirSect = FALSE;
                        }
                    }
                    elseif ( !$sharedDirSect ) {
                        $newfile .= $line;
                        #var_dump($line);
                    }
                }
                
                $newfile .= "[$name]\n"."comment = $comment\n"."path = $path\n";
                if(isset ($_POST['readonly']))
                    $newfile .= "readonly = yes\n";
                else
                    $newfile .= "readonly = no\n";
                if(isset ($_POST['browseable']))
                    $newfile .= "browseable = yes\n";
                else
                    $newfile .= "browseable = no\n";
                if(isset ($_POST['public']))
                    $newfile .= "public = yes\n";
                else
                    $newfile .= "public = no\n";
                if(isset ($_POST['guestok']))
                    $newfile .= "guest ok = yes\n";
                else
                    $newfile .= "guest ok = no\n";
                $newfile .= "create mask = 0777\n"."directory mask = 0777\n";

                $shell = new K980K_Shell();
                $shell->exec("pfexec cp",self::$sambaConf.' '.self::$sambaConfBak);

                $writeSamba = fopen(self::$sambaConf, 'w');
                $writeReturn = fwrite($writeSamba, $newfile);

                $shell->exec('pfexec svcadm restart svc:/network/samba:default');

            }
            else {
                // delete
                $smbshare = $this->getSambaConf();
                foreach($smbshare as $name => $conf) {
                    if(isset ($_POST[$name.'D'])) {
                        $targetName = $name;
                        break;
                    }
                }
                $smbconf = file("/etc/sfw/smb.conf");

                if($smbconf == FALSE)
                    die('sth is wrong when open smb.conf...');

                $sharedDirSect = FALSE;
//                read a line
//                    if comments -> write back
//                    if [xxx] -> if xxx is target, open flag
//                                if xxx not target -> if flag -> write back && !flag
//                                                     if !flag -> write back
//
//                    if normal conf line -> if flag -> ignore
//                                           if !flag -> write back

                foreach ($smbconf as $line) {
                    $dataline = trim($line);
                    $firstchar = substr($dataline, 0, 1);

                    // skip all comments
                    if( $firstchar == '#' or $firstchar == ';' or empty($dataline))
                        $newfile .= $line;
                    elseif( $firstchar == '[') {
                        // get section name, strip all '[' and ']'
                        $sectionName = ltrim($dataline, '[');
                        $sectionName = rtrim($sectionName, ']');
                        #var_dump($sectionName);
                        if( $sectionName == $targetName ) {
                            $sharedDirSect = TRUE;
                        }
                        else{
                            $newfile .= $line;
                            #var_dump($line);
                            if($sharedDirSect)
                                $sharedDirSect = FALSE;
                        }
                    }
                    elseif ( !$sharedDirSect ) {
                        $newfile .= $line;
                        #var_dump($line);
                    }
                }
                // now write $newfile back, backup first
                #var_dump($newfile);
                $shell = new K980K_Shell();
                $shell->exec("pfexec cp",self::$sambaConf.' '.self::$sambaConfBak);

                $writeSamba = fopen(self::$sambaConf, 'w');
                $writeReturn = fwrite($writeSamba, $newfile);
                $shell->exec('pfexec svcadm restart svc:/network/samba:default');
            }
        }


        $smbshare = $this->getSambaConf();
        $view->assign('smbshare',$smbshare);
        #var_dump($smbshare);

        $comm = 'comment';
        $pa = 'path';
        $browse = 'browseable';
        $view->assign('comm',$comm);
        $view->assign('pa',$pa);
        $view->assign('browse',$browse);

        $view->assign('subaction','samba');
        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile', 'element/samba.html');
        $view->addTitle('samba');
        $this->display();
    }
    

    public function editsambaAction() {
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();
        $request = new K980K_Request();

        // normally there are several fields here, including "comment", "path", "public"...
        // and "create mask", "directory mask"
        if(isset ($_POST['addsamba'])){
            // add, read nothing
        }
        else {
            // edit
            $shares = $this->getSambaConf();
            foreach($shares as $name => $conf) {
                if(isset ($_POST[$name])) {
                    $targetName = $name;
                    $targetConf = $conf;
                    break;
                }
            }
            $view->assign('targetName', $targetName);
            $view->assign('targetConf', $targetConf);
        }

        $comment = "comment";
        $path = "path";
        $public = "public";
        $readonly = "readonly";
        $browseable = "browseable";
        $guestok = "guest ok";
        $view->assign('comment', $comment);
        $view->assign('path', $path);
        $view->assign('public', $public);
        $view->assign('readonly', $readonly);
        $view->assign('guestok', $guestok);

        $view->assign('subaction','editsamba');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/editsamba.html');
	$view->addTitle('editsamba');
	$this->display();
    }
}
?>
