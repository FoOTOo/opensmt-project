<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class userInfo{
    public $username;
    public $uid;
    public $userGid;
    public $comment;
    public $homeDir;
    public $shell;

    function  __construct($n, $id, $gid, $c, $dir, $sh){
	$this->username = $n;
	$this->uid = $id;
        $this->userGid = $gid;
	$this->comment = $c;
	$this->homeDir = $dir;
	$this->shell = $sh;
    }

    public function getMember() {
        $return = array();
        array_push($return, $this->username);
        array_push($return, $this->uid);
        array_push($return, $this->userGid);
        array_push($return, $this->comment);
        array_push($return, $this->homeDir);
        array_push($return, $this->shell);
        return $return;
    }
}

class defaultController extends K980K_Controller_Action_Smarty {
    public $menucurrent = 'access';
    public $menuopen = 'access';

    public function  __construct($options,$extendData) {       
       parent::__construct($options, $extendData);
       $view = $this->getViewInstance();
       $view->addTitle('access');
    }

    private function getUsers() {
        $USERS_PRE = array();
        $USERS_PRE = file("/etc/passwd");
            // the lines in /etc/passwd are like this
            // username:passwd:UID:GID:Comment:HOME dir:shell
        $USERS = array();
        $userTemp = array();
        for ($lineCount = 1; $lineCount <= count($USERS_PRE); $lineCount++ ){
            if($lineCount >= 22){
                $userTemp = explode(":", $USERS_PRE[$lineCount]);
                $userTemp[count($userTemp)-1] = substr($userTemp[count($userTemp)-1], 0, -1);
                $userInstance = new userInfo($userTemp[0],$userTemp[2],$userTemp[3],$userTemp[4],$userTemp[5],$userTemp[6]);
                $USERS[] = $userInstance->getMember();
            }
        }
        return $USERS;
    }

    private function getUser($username){
        $userInfo = $this->getUsers();
        foreach( $userInfo as $ui )
            if( $ui[0] == $username )
                return $ui;
    }

    private function getUsernames() {
        $userInfo = $this->getUsers();
        $names = array();
        foreach( $userInfo as $ui)
            $names[] = $ui[0];
        return $names;
    }

    private function getGroups() {
        $GROUPS_PRE = array();
	$GROUPS_PRE = file("/etc/group");
	if ( empty( $GROUPS_PRE ) )
		die("sth is wrong with open /etc/group");

	$GROUP = array();
	$groupTemp = array();
	foreach ( $GROUPS_PRE as $groupDetail ){
		$groupTemp = explode(":", $groupDetail);
                $groupTemp[count($groupTemp)-1] = substr($groupTemp[count($groupTemp)-1], 0, -1);
		// the lines in /etc/group are like this
		// groupname:group-password:GID:username-list
                $GROUP[$groupTemp[0]] = $groupTemp[2];
	}
        return $GROUP;
    }

    public function userAction() {
	$view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();
        $request = new K980K_Request();

        if($request->isPost()){
            if(isset($_POST["editUser"])){
                // add or edit
                $username = $_POST["username"];
                $originusername = $_POST["originusername"];
                $userid = $_POST["userid"];
                $password = $_POST["password"];
                $passwordConfirm = $_POST["passwordConfirm"];
                $pGroup = $_POST["pGroup"]; // gid
                $comment = $_POST["comment"];
                $homedir = $_POST["homedir"];
                $defaultShell = $_POST["defaultShell"];
                $additionalgroup = $_POST["additionalgroup"];

                if($password != $passwordConfirm) {
                    $execMessage = 'Password don\'t match.';
                    $view->assign('execMessage', $execMessage);
                }
                else{
                    $shell = new K980K_Shell();
                    $userInfo = $this->getUsers();
                    foreach( $userInfo as $ui )
                        if( $ui[0] == $originusername )
                            $userModified = $ui;
                    #var_dump($userModified);
                    if( $userModified[0] ) {
                        // edit
                        $modify = false;
                        if($userid != $userModified[1]) {
                            $modify = true;
                            $usermodArgs .= "-u $userid ";
                        }
                        if($pGroup != $userModified[2]) {
                            $modify = true;
                            $usermodArgs .= "-g $pGroup ";
                        }
                        if($comment != $userModified[3]) {
                            $modify = true;
                            $usermodArgs .= "-c '$comment' ";
                        }
                        if($homedir != $userModified[4]) {
                            $modify = true;
                            $usermodArgs .= "-d $homedir ";
                            if( is_dir($userModified[4]))
                                $usermodArgs .= '-m';
                        }
                        if($defaultShell != $userModified[5]) {
                            $modify = true;
                            $usermodArgs .= "-s $defaultShell ";
                        }
                        if(! empty($additionalgroup) ) {
                            $modify = true;
                            for( $i = 0; $i < count($additionalgroup); $i++ ) {
                                if($i == (count($additionalgroup)-1))
                                    $agroups .= "$agroup";
                                else
                                    $agroups .= "$agroup,";
                            }
                            $usermodArgs .= "-G $agroups ";
                        }
                        $usermodArgs .= "$userModified[0]";
                        #var_dump($usermodArgs);

                        if($password != 'apassword')
                            $shell->exec("pfexec /usr/local/bin/password.sh $username $password");
                        if($modify) {
                            $return = $shell->exec('pfexec usermod', $usermodArgs);
                            if ($return != null) $execMessage = $return;
                            else $execMessage = "Modified Successful!";
                            $view->assign('execMessage', $execMessage);
                        }
                    }
                    else {
                        // add
                        $useraddFlag = TRUE;
                        $view->assign('useraddFlag',$useraddFlag);
                        if(!empty($comment))
                            $useraddArgs .= "-c '$comment' ";
                        if(!empty($homedir)) {
                            $useraddArgs .= "-d $homedir ";
                            if(!is_dir($homedir))
                                $useraddArgs .= '-m -k /etc/skel ';
                        }
                        if(!empty($pGroup))
                            $useraddArgs .= "-g $pGroup ";
                        if(! empty($additionalgroup) ) {
                            unset ($agroups);
                            for( $i = 0; $i < count($additionalgroup); $i++ ) {
                                if($i == (count($additionalgroup)-1))
                                    $agroups .= "$agroup";
                                else
                                    $agroups .= "$agroup,";
                            }
                            $usermodArgs .= "-G $agroups ";
                        }
                        if(!empty($defaultShell))
                            $useraddArgs .= "-s $defaultShell ";
                        if(!empty($userid))
                            $useraddArgs .= "-u $userid ";

                        $useraddArgs .= "$username";
                        #var_dump($useraddArgs);

                        $return1 = $shell->exec('pfexec useradd', $useraddArgs);
                        if ($return1 != null) $execMessage .= $return1;
                        else
                            $return2 = $shell->exec("pfexec /usr/local/bin/password.sh $username $password");

                        if($return2 != null) $execMessage .= $return2;
                        else    $execMessage = "Successfully Add User \"$username\"!";
                        $view->assign('execMessage', $execMessage);
                    }
                }

            }
            else {
                // delete
                $usernameList = $this->getUsernames();
                foreach ($usernameList as $name) {
                    if (isset($_POST[$name.'D'])) {
                        $targetName = $name;
                        break;
                    }
                }
                $shell = new K980K_Shell();
                //$targetinfo = $this->getUser($targetName);
                //if( is_dir($targetinfo[4]) )
                  //  $shell->exec("pfexec userdel", "-r ".$targetName);
                //else
                //
                // if we uncomment the above codes, there will be a bug.
                // Maybe the user's group has been changed and the user has no permission to operate
                // the original home dir, and it cannot be delete by 'userdel -r'
                    $shell->exec("pfexec userdel", $targetName);
            }
        }

        $users = $this->getUsers();
        array_splice($users, -1, 1);
        $view->assign('users',$users);

        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile','element/user.html');
        $view->assign('subaction', 'user');
        $view->addTitle('User Admin');
        $this->display();
    }

    public function edituserAction(){
        $view = $this->getViewInstance();
        $viewOptions = $this->getViewOptions();

        $groupInfo = $this->getGroups();
        $view->assign('groupInfo',$groupInfo);
        $usernameList = $this->getUsernames();
        foreach ($usernameList as $name) {
            if ( isset($_POST[$name]) ) {
                $targetName = $name;
                break;
            }
        }
        if(empty($targetName))
            $useraddFlag = TRUE;
        else
            $useraddFlag = FALSE;
        $view->assign('useraddFlag',$useraddFlag);
        #var_dump($useraddFlag);
        $userEdited = $this->getUser($targetName);
        $view->assign('userEdited',$userEdited);
        $primaryGroupid = $userEdited[2];
        #var_dump($primaryGroupid);
        #var_dump($userEdited);
        $view->assign('primaryGroupid',$primaryGroupid);

        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile','element/edituser.html');
        $view->addTitle('Edit User Profile');
        $this->display();
    }
        
    public function groupAction() {
	
	$view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        $request = new K980K_Request();

        if($request->isPost()){
            $shell = new K980K_Shell();
            if(isset($_POST["groupEdit"])){
                // add or edit group
                $groupname = $_POST["groupname"];
                $originname = $_POST["originname"];
                $originid = $_POST["originid"];
                $groupid = $_POST["groupid"];
                $isdup = $_POST["isdup"];

                $groups = $this->getGroups();
                $editFlag = FALSE;
                foreach($groups as $gName => $gid){
                    if($gName == $groupname){
                        $editFlag = TRUE;
                        break;
                    }
                }
                if($editFlag){
                    // edit
                    $modify = FALSE;
                    if($groupid != $originid) {
                        $modify = TRUE;
                        $groupmodArgs .= "-g $groupid ";
                    }

                    if($isdup) {
                        $modify = TRUE;
                        $groupmodArgs .= "-o ";
                    }

                    if($groupname != $originname) {
                        $modify = TRUE;
                        $groupmodArgs .= "-n $groupname $originname";
                    }
                    else
                        $groupmodArgs .= "$originname";
                    
                    #var_dump($modify);
                    #var_dump($groupmodArgs);
                    if($modify) {
                        $return = $shell->exec('pfexec groupmod', $groupmodArgs);
                        if ($return != null) $execMessage = $return;
                        else $execMessage = "Modified Successful!";
                        $view->assign('execMessage', $execMessage);
                    }
                }
                else{
                    // add
                    if(!empty($groupid))
                        $groupaddArgs .= "-g $groupid ";
                    if($isdup)
                        $groupaddArgs .= '-o ';
                    if(!empty($groupname))
                        $groupaddArgs .= "$groupname";
                    else
                        die('There should be a group name.');
                    $return = $shell->exec('pfexec groupadd', $groupaddArgs);
                }
            }
            else{
                // delete group
                $groups = $this->getGroups();
                //var_dump($_POST);
                foreach($groups as $gName => $gid){
                    if(isset($_POST["$gName".'D'])){
                        $shell = new K980K_Shell();
                        $return = $shell->exec("pfexec groupdel", $gName);
                        break;
                    }
                }
            }
        }

        $groups = $this->getGroups();
        $view->assign('groups',$groups);

        $view->assign('subaction', 'group');
        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile','element/group.html');
        $view->addTitle('Group Admin');
        $this->display();
//        }
    }

    public function editgroupAction(){
        $view = $this->getViewInstance();
        $viewOptions = $this->getViewOptions();

        $groups = $this->getGroups();
        foreach($groups as $groupName => $groupId){
            if(isset($_POST["$groupName"])){
                $targetName = $groupName;
                $targetId = $groupId;
            }
        }

        $view->assign("gid",$targetId);
        $view->assign("gname",$targetName);

	$view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile','element/editgroup.html');
        $view->addTitle('Edit Group');
        $this->display();
    }
}
?>
