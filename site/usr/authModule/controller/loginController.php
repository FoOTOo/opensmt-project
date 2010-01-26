<?php

class loginController extends K980K_Controller_Action_Smarty {
    public function defaultAction() {
        $request = new K980K_Request();
        $view = $this->getViewInstance();
        $viewOptions = $this->getViewOptions();
        if($request->isPost()) {
           
            $auth = K980K_Registry::get('authenticator');
            $userId = $_POST['log'];
            $userPass = $_POST['pwd'];
             
            if($auth->checkPass($userId,$userPass)){
                $auth->saveAuth($userId);
                
               
            }else{
                $_SESSION['systemError'] = 'invalid user or password';
            }
            header("location: /site/index.php");
            
        }
    }
    public function logoutAction() {
        $auth = K980K_Registry::get('authenticator');
        $auth->clearAuth();
        header("location: /site/index.php");
    }
}