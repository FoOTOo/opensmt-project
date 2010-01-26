<?php
/* 
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
function dump($var) {
    echo '<pre>',print_r($var),'</pre>';
}
function getmicrotime() {
    list($usec, $sec) = explode(" ",microtime());
    return ((float)$usec + (float)$sec);
}
session_start();
$time_start = getmicrotime();
header('Content-type: text/html; charset=utf-8');
error_reporting(E_ALL);
set_include_path('./lib/' . PATH_SEPARATOR . './lib/Share/' . PATH_SEPARATOR . get_include_path());
define('ROOT',dirname(__FILE__) . DIRECTORY_SEPARATOR . 'usr' . DIRECTORY_SEPARATOR);

require 'K980K/Loader.php';
K980K_Loader::registerAutoLoad();
$config = new K980K_Config_Ini('./data/etc/config.inc.php');
K980K_Registry::set('config',$config);

$controller =  new K980K_Controller();
$router = new K980K_Controller_Router();
$userRouter1 = new K980K_Controller_Router_Adapter_Rewrite(
    '*',
    'test/(\d+).html',
    array('module'=>'test','controller'=>'blog','action'=>'printr'),
    array(1=>'id','user'=>'5')
);
$userRouter2 = new K980K_Controller_Router_Adapter_Static(
    'get',
    'diagnostics/',
    array('module'=>'diagnostics','controller'=>'default','action'=>'ping'),
    array('userid'=>'kaede')
);
$userRouter3 = new K980K_Controller_Router_Adapter_Static(
    '*',
    '/',
    array('module'=>'status','controller'=>'system','action'=>'default'),
    array('userid'=>'kaede')
    );
$userRouter4 = new K980K_Controller_Router_Adapter_Static(
    '*',
    'test/s44.html',
    array('module'=>'test2','controller'=>'image','action'=>'make'),
    array('userid'=>'kaede')
    );
$router->addRouter('test', $userRouter1);
$router->addRouter('test2', $userRouter2);
$router->addRouter('test3', $userRouter3);
$router->addRouter('test4', $userRouter4);
$controller->setRouter($router);
$controller->setOptions($config->_toArray());
$authData = new K980K_Config_Ini('./data/etc/auth.user.php');

$auth = new K980K_Auth($authData->_toArray());
K980K_Registry::set('authenticator',$auth);
$controller->start(null,$auth);
return;
//以下为测试代码
$view = new K980K_View('./view/default/','index','html');
$view->setTemplatePath('./view/default/');
$view->setTemplateFileName('index');
$view->setTemplateFileExt('html');
$view->assgin('data', date("Y-m-d H:i:s",time()));
$view->assgin('time', time());
$view->assgin('userid', 'kaede');
$view->assgin('content','text');
$view->assgin('list',array(
        'is','all','for','code','test','error'=>0,'message'=>'干啥呢'
    ));

$view->startAdapter();


/**/
$time_end = getmicrotime();
$time = $time_end - $time_start;
echo $time;
return;
//var_dump(K980K_Registry::get('config'),K980K_Registry::get('c'));
