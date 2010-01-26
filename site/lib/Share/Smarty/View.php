<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require dirname(realpath(__FILE__)) . DIRECTORY_SEPARATOR . 'Smarty.class.php';
class Smarty_View extends Smarty{
    private $_pageTitle = array();
    public function addTitle($string){
        $this->_pageTitle[] = $string;
    }
    public function display($fileName){
        $this->assign('pageTitle',$this->_pageTitle);
        parent::display($fileName);
    }
}
?>

?>
