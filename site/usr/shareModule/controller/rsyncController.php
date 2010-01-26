<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class rsyncController extends K980K_Controller_Action_Smarty {
    private static $rsyncdconf = '/etc/rsyncd.conf';
    private static $passwd = '/etc/passwd';
    private static $group = '/etc/group';

    public $menucurrent = 'Share';
    public $menuopen = 'Share';
    public function  __construct($options,$extendData) {
       parent::__construct($options, $extendData);
       $view = $this->getViewInstance();
       $view->addTitle('Share');
    }

    private function getUsers(){
        $userinfo = file(self::$passwd);
        foreach($userinfo as $line){
            $dataline = trim($line);

            $fields = explode(':', $dataline);
            $usernames[] = $fields[0];
        }
        return $usernames;
    }

    private function getGroups(){
        $groupinfo = file(self::$group);
        foreach($groupinfo as $line){
            $dataline = trim($line);

            $fields = explode(':', $dataline);
            $groups[] = $fields[0];
        }
        return $groups;
    }

    private function readRsyncSection(){
        $rsyncd = file(self::$rsyncdconf);
//conf file section like the following:
//[sol9new]
//comment = Backup of the sol9 root fs (new)
//use chroot = yes
//path = /usbbox001/backup/bnsmb/sol9new/
//numeric ids = true
//post-xfer exec = /usr/bin/create_zfs_snapshot $RSYNC_MODULE_PATH
//read only = false
//write only = false
//uid = root
//gid = root
        $module = FALSE;
        foreach($rsyncd as $line){
            $dataline = trim($line);
            $firstchar = substr($dataline, 0, 1);

            // skip all comments
            if( $firstchar == '#' or $firstchar == ';' or empty($dataline))
                continue;
            if( $firstchar == '[') {
                $module = TRUE;
                // get section name, strip all '[' and ']'
                $sectionName = ltrim($dataline, '[');
                $sectionName = rtrim($sectionName, ']');
                $rsyncSection[$sectionName] = array();
            }
            elseif( $module ) {
                $fields = explode('=', $dataline);
                $fields[0] = trim($fields[0]);
                $fields[1] = trim($fields[1]);

                $rsyncSection[$sectionName][$fields[0]] = $fields[1];
            }
        }
        return $rsyncSection;
    }

    public function defaultAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        $request = new K980K_Request();
        if($request->isPost()){
            if(isset ($_POST['editRsync'])){
                // edit or add
                $name = $_POST['name'];
                $comment = $_POST['comment'];
                $path = $_POST['path'];
                $uid = $_POST['uid'];
                $gid = $_POST['gid'];
                $rsyncd = file(self::$rsyncdconf);

                if($rsyncd == FALSE)
                    die('sth is wrong when open rsyncd.conf...');
                $sharedDirSect = FALSE;
                foreach ($rsyncd as $line) {
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
                
                $newfile .= "\n[$name]\n"."comment = $comment\n"."path = $path\n";
                if(isset ($_POST['chroot']))
                    $newfile .= "use chroot = yes\n";
                else
                    $newfile .= "use chroot = no\n";
                if(isset ($_POST['readonly']))
                    $newfile .= "readonly = true\n";
                else
                    $newfile .= "readonly = false\n";
                if(isset ($_POST['writeonly']))
                    $newfile .= "writeonly = true\n";
                else
                    $newfile .= "writeonly = false\n";
                if(isset ($_POST['list']))
                    $newfile .= "list = true\n";
                else
                    $newfile .= "list = false\n";
                
                $newfile .= "uid = $uid\ngid = $gid\n";
                
                $shell = new K980K_Shell();
                $shell->exec("pfexec cp",self::$rsyncdconf.' '.self::$rsyncdconf.'.bak');
                
                $writeRsyncd = fopen(self::$rsyncdconf, 'w');
                $writeReturn = fwrite($writeRsyncd, $newfile);
                
                $process = $shell->exec('pfexec ps aux |egrep \'rsync --daemon\'');
                $processInfo = preg_split("/[\s]+/", $process[0]);
                $pid = $processInfo[1];
                $stop = $shell->exec('pfexec kill',$pid);
                $shell->exec('pfexec rsync --daemon');
            }
            else{
                // delete
                $rsyncshare = $this->readRsyncSection();
                foreach($rsyncshare as $name => $conf) {
                    if(isset ($_POST[$name.'D'])) {
                        $targetName = $name;
                        break;
                    }
                }
                $rsyncd = file(self::$rsyncdconf);

                if($rsyncd == FALSE)
                    die('sth is wrong when open rsyncd.conf...');

                $sharedDirSect = FALSE;

                foreach ($rsyncd as $line) {
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
                $shell = new K980K_Shell();
                $shell->exec("pfexec cp",self::$rsyncdconf.' '.self::$rsyncdconf.'.bak');

                $writeRsyncd = fopen(self::$rsyncdconf, 'w');
                $writeReturn = fwrite($writeRsyncd, $newfile);

                $process = $shell->exec('pfexec ps aux |egrep \'rsync --daemon\'');
                $processInfo = preg_split("/[\s]+/", $process);
                $pid = $processInfo[1];
                $stop = $shell->exec('pfexec kill',$pid);
                $shell->exec('pfexec rsync --daemon');
            }
        }


        $rsyncSection = $this->readRsyncSection();
        #var_dump($rsyncSection);
        $view->assign('rsyncSection',$rsyncSection);
        $comm = 'comment';
        $pa = 'path';
        $xfer = 'post-xfer exec';
        $view->assign('comm',$comm);
        $view->assign('pa',$pa);
        $view->assign('xfer',$xfer);

        $view->assign('subaction','rsync');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/rsync.html');
	$view->addTitle('Rsync');
	$this->display();
    }

    public function editrsyncAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        $shell = new K980K_Shell();
//	$zfsnames = $shell->exec('pfexec zfs list -Ho name');
//	$view->assign('zfsnames',$zfsnames);
        $addFlag = FALSE;


        $usernames = $this->getUsers();
        $groups = $this->getGroups();
        #var_dump($usernames);
        #var_dump($groups);
        $view->assign('usernames',$usernames);
        $view->assign('groups',$groups);

        if(isset ($_POST['addRsync'])){
            // add, do nothing
            $addFlag = TRUE;
            $view->assign('addFlag',$addFlag);
        }
        else {
            // edit
            $rsync = $this->readRsyncSection();
            foreach($rsync as $name => $info) {
                if(isset ($_POST[$name])){
                    $targetName = $name;
                    break;
                }
            }
            #var_dump($rsync[$targetName]);

            $comment = $rsync[$targetName]['comment'];
            $chroot = $rsync[$targetName]['use chroot'];
            $path = $rsync[$targetName]['path'];
            $list = $rsync[$targetName]['list'];
            $uid = $rsync[$targetName]['uid'];
            $gid = $rsync[$targetName]['gid'];
            $readonly = $rsync[$targetName]['read only'];
            $writeonly = $rsync[$targetName]['write only'];


            $view->assign('targetName',$targetName);
            $view->assign('comment',$comment);
            $view->assign('chroot',$chroot);
            $view->assign('path',$path);
            $view->assign('list',$list);
            $view->assign('uid',$uid);
            $view->assign('gid',$gid);
            $view->assign('readonly',$readonly);
            $view->assign('writeonly',$writeonly);

        }

        $view->assign('subaction','editrsync');
	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
	$view->assign('tplfile', 'element/editrsync.html');
	$view->addTitle('RsyncEdit');
	$this->display();
    }
}
