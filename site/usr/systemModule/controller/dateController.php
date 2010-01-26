<?php

class dateController extends K980K_Controller_Action_Smarty {

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
            $shell = new K980K_Shell();
            $args = sprintf("%02d", $_POST['month']) . sprintf("%02d", $_POST['day']) .
                        sprintf("%02d", $_POST['hour']) . sprintf("%02d", $_POST['minute']) .
                        sprintf("%04d", $_POST['year']) . '.00';
            #var_dump($args);
            $return = $shell->exec("pfexec date" , $args  );
            /*var_dump($return);
            if(strstr($return[0], 'invalid'))
                $execMessage = $return;
            else
                $execMessage[] = 'Update Successful';
            $view->assign('execMessage',$execMessage);*/
        }

        $shell = new K980K_Shell();
        $rawDate = $shell->exec('pfexec date');
        // e.g. Sun Jan 17 17:40:05 CST 2010
        // Week Month Day HH:MM:SS Timezone Year
        #var_dump($rawDate);
        $date = sscanf($rawDate[0], "%s %s %d %s %s %s",&$week,&$month,&$day,&$rawTime,&$timezone,&$year);
        #var_dump($time);
        #var_dump($year);
        $time = explode(':', $rawTime);  // HH MM SS
        #var_dump($time);
        $arg = "'+%F' 2>&1";
        $return = $shell->exec('/usr/gnu/bin/date', $arg);
        $date2 = sscanf($return[0], "%d-%d-%d", &$year, &$month, &$day);
        
        $view->assign('week',$week);
        $view->assign('month',$month);
        $view->assign('day',$day);
        $view->assign('year',$year);
        $view->assign('time',$time);

        $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
        $view->assign('tplfile','element/date.html');
        $view->assign('subaction', 'date');
        $view->addTitle('Date');
        $this->display();
    }

}
?>