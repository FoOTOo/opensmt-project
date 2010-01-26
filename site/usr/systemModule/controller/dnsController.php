<?php

class dnsController extends K980K_Controller_Action_Smarty {
    private static $resolv = '/etc/resolv.conf';

    public $menucurrent = 'System';
    public $menuopen = 'System';
    public function  __construct($options,$extendData) {
       parent::__construct($options, $extendData);
       $view = $this->getViewInstance();
       $view->addTitle('System');
    }

    public function defaultAction(){
        $view = $this->getViewInstance();
	$viewOptions = $this->getViewOptions();

        $request = new K980K_Request();
        if($request->isPost()){
            $resolvConf = file(self::$resolv);
            if($resolvConf == FALSE)
                die('sth is wrong when open '.self::$resolv);

            $dnscount = 0;
            #var_dump($resolvConf);
            foreach($resolvConf as $line){
                $dataline = ltrim($line);
                $contents = preg_split("/[\s]+/", $dataline);
                #var_dump($contents);
                if($contents[0] == 'nameserver'){
                    if($dnscount == 0){
                        $newfile .= 'nameserver '.$_POST['pDNS']."\n";
                        $dnscount++;
                    }
                    elseif($dnscount == 1){
                        $newfile .= 'nameserver '.$_POST['sDNS']."\n";
                        $dnscount++;
                    }
                    else
                        $newfile .= $line;
                }
                else
                    $newfile .= $line;
            }
            if($dnscount == 1 && isset ($_POST['sDNS']))
                $newfile .= 'nameserver '.$_POST['sDNS']."\n";
            #var_dump($newfile);
            $writeResolv = fopen(self::$resolv, 'w');
            if($writeResolv == FALSE)
                die('error when fopen resolv.conf');
            $return = fwrite($writeResolv, $newfile);
            if($return < 0)
                die('error when write to resolv.conf');
        }

        $resolvConf = file(self::$resolv);
        if($resolvConf == FALSE)
            die('sth is wrong when open '.self::$resolv);

        foreach($resolvConf as $line){
            $dataline = ltrim($line);
            $contents = preg_split("/[\s]+/", $dataline);
            if($contents[0] == 'nameserver')
                $dns[] = $contents[1];
        }
        #var_dump($dns);
        
        $view->assign('dns',$dns);

        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile','element/dns.html');
        $view->assign('subaction', 'dns');
        $view->addTitle('DNS');
        $this->display();
    }

}
?>