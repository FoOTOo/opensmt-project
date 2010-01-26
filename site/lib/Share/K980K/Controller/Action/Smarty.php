<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class K980K_Controller_Action_Smarty extends K980K_Controller_Action {
    protected $_viewInstance = null;
    protected $_viewOptions = array();
    public $menucurrent = '__index__';
    public $menuopen = '__index__';
    public function  __construct($options,$extendData) {
        parent::__construct($options, $extendData);
        if(isset($options['view'])) {
            $this->_viewOptions = $options['view'];
            $this->initView($this->_viewOptions);
        }
    }
    private function initView($options) {
        if(isset($options['className'])) {
            $viewObject = new $options['className'];
            $this->setViewInstance($viewObject);
            $this->setViewConfig($options);
        }
    }
    public function setViewInstance($viewObject = null) {
        if(is_object($viewObject)) {
            $this->_viewInstance = $viewObject;
            return $this->_viewInstance;
        }else {
            return false;
        }
    }
    public function getViewInstance() {
        return $this->_viewInstance;
    }
    public function getViewOptions() {
        return $this->_viewOptions;
    }
    public function setViewConfig($viewOptions=array()) {
        $viewInstance = $this->getViewInstance();
        $viewInstance->compile_check = true;
        $viewInstance->force_compile=true;
        $viewInstance->caching=true;
        $viewInstance->debugging = !true;
        $viewInstance->error_reporting=!true;
        $viewInstance->template_dir = $viewOptions['template']['path'] . $viewOptions['template']['name'];
        $viewInstance->compile_dir= $viewOptions['template']['compile'];
        $viewInstance->cache_dir= $viewOptions['template']['cache'];
        $viewInstance->left_delimiter = '<{';
        $viewInstance->right_delimiter = '}>';
        $viewInstance->assign('webUrl',dirname($_SERVER['SCRIPT_NAME']));
        $viewInstance->assign('_baseUrl',$viewOptions['template']['baseUrl']);
        $authCheck = K980K_Registry::get('authCheck');

        if($authCheck == true){
            $userInfo =K980K_Registry::get('userInfo');
            $viewInstance->assign('cue_user_name',$userInfo['userId']);
        }
        $viewInstance->assign('authCheck',K980K_Registry::get('authCheck'));
        if(isset($this->_options['adminmenu'])) {
            $viewInstance->assign('adminmenu',$this->_options['adminmenu']);
        }
        $systemError = $_SESSION['systemError'];        
        $viewInstance->assign('systemError',$systemError);
        $_SESSION['systemError'] = null;
        $viewInstance->assign('menucurrent',$this->menucurrent);
        $viewInstance->assign('menuopen',$this->menuopen);
        return;
        echo '<pre>';
        print_r($this->_options['adminmenu']);
        echo '</pre>';
    }
    public function display($fileName = 'layout.html') {
        $viewInstance = $this->getViewInstance();
        //var_dump($viewInstance);
        $viewInstance->display($fileName);
    }
}
?>
