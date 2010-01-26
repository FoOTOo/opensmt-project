<?php

class browserController extends K980K_Controller_Action_Smarty {
        public function dirAction() {
            //var_dump(sha1('admin'));
            $path =  realpath($_GET['dir']) .DIRECTORY_SEPARATOR;
            //var_dump($path);
            if(!is_dir($path)){
                $path = '/';
            }
            $list = array();
            $list2 = array();
            $dir_handle = @opendir($path) or die("Unable to open $path");
            while($file = readdir($dir_handle)) {

                if($file[0] == '.' and $file[1] != '.' and isset($file[1]))
                    continue;


                $item = array();
                if($file == "." || $file == "..") {
                    
                } //ignore these
                $tmp_file = realpath($path. $file);
                //var_dump($tmp_file);
                if (is_file($tmp_file)) {
                    $item['name'] = $file;
                    $item['path'] = $tmp_file;
                    array_push($list, $item);
                    $list2[$file] = $tmp_file;
                }
                else if(!is_file( $file)){
                        $item['name'] = $file;
                        $item['path'] = realpath($path . $file) . DIRECTORY_SEPARATOR;
                        array_push($list, $item);
                        $list2[$file] = realpath($path . $file) . DIRECTORY_SEPARATOR;
                    }
                

            }
            ksort($list2);
            //var_dump($list2);
            //var_dump($path, $list);
            $view = $this->getViewInstance();
            $viewOptions = $this->getViewOptions();
            $view->assign('path',$path);
            $view->assign('dirSEP',DIRECTORY_SEPARATOR);
            $view->assign('list',$list);
            $view->assign('list2', $list2);
            $view->assign('_baseUrl', $viewOptions['template']['baseUrl']);
            $a =  $view->fetch('element/browserdir.html');
            echo $a;die();
            $view->addTitle('diskinfo');
            $this->display();
        }
}