<?php
/*
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_View {
    private $activation = false;
    private $dataPool = array();
    private $templatePath = null;
    private $templateFileName = null;
    private $templateFileExt = null;
    private $leftDelimiter = '<{';
    private $rightDelimiter = '}>';
    private $varDelimiter = '$';
    private $hashDelimiter = "\033";
    private $_options = null;
    private $adapterType = 'Compiled';
    public function  __construct() {


    }
    public function setTemplatePath($templatePath){
        $this->templatePath = $templatePath;
    }
    public function setTemplateFileName($templateFileName = 'default'){
        $this->templateFileName = $templateFileName;
    }
    public function setTemplateFileExt($templateFileExt = 'html'){
        $this->templateFileExt = $templateFileExt;
    }
    public function setAdaterType($typeString){
        $this->adapterType = $typeString;
    }
    public function startAdapter() {
        $templatePath = $this->templatePath;
        $templateFileExt = $this->templateFileExt;
        $templateFileName = $this->templateFileName;
        $fileName = $templatePath .DIRECTORY_SEPARATOR . $templateFileName . '.' . $templateFileExt;
        if(is_file($fileName)) {
            $contentString = file_get_contents($templatePath .DIRECTORY_SEPARATOR . $templateFileName . '.' . $templateFileExt);
            $viewAdapterName = 'K980K_View_' . $this->adapterType . '_Adapter';
            $viewAdapter = new $viewAdapterName(
                $contentString,
                $this->hashDelimiter,
                $this->leftDelimiter,
                $this->rightDelimiter,
                $this->varDelimiter,
                $this->dataPool,
                $this->templatePath,
                $this->templateFileExt
            );
        }else {
            require_once 'K980K/Exception.php';
            throw new K980K_Exception('模板文件加载失败',array($fileName));
        }
        echo $viewAdapter->getHtml();
    }
    public function assgin($key, $value) {
        $this->dataPool[$key] = $value;
        $this->activation = true;
    }
    public function getActivation() {
        return $this->activation;
    }
    public function setOptions($options) {
        $this->_options = $options;
    }
    public function display() {
        var_dump($this->dataPool);
    }

}
?>
