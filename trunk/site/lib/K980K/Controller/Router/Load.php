<?php
/* 
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_Controller_Router_Load {
    private $_options;
    private $_mapOptions;
    private $_route;
    private $_separation = '@';
    private $_defaultModuleName;
    private $_defaultModuleIdentify = 'Module';
    private $_defaultControllerName;
    private $_defaultControllerIdentify = 'Controller';
    private $_defaultActionName;
    private $_defaultActionIdentify = 'Action';
    private $_userControllerPath = array();
    private $_userControllerMap = array('Map.php');
    private $_userControllerFileExt = array(
    '.php'
    );
    private $_userControllerFileRule = array(  
    '\\\1\\\0\\\2'    
    );
/*    private $_userControllerMapRule = array(
     '\\\1\\\0\\\2'
    );    
    private $_userControllerClassRule = array(
    '\\\2'
    );
    private $_userControllerMethodRule = array(
    '\\\3',
    '_\\\3'
    );*/
    private $_userControllerMapRule = array(
	         '\\\1\\\0etc\\\0\\\2Controller',
		      '\\\1\\\0\\\2Controller',
		           '\\\1Module\\\0etc\\\0\\\2Controller',
			        '\\\1Module\\\0\\\2Controller',
				     
				    );    
        private $_userControllerClassRule = array(
		    '\\\2Controller',
		        '\\\1\\\2Controller',
			    '\\\2'
			        );
        private $_userControllerMethodRule = array(
		    '\\\3',
		        '_\\\3',
			    '\\\3Action'
			        );
    private $_userControllerOptions = array();
    private $_userControllerClassHandler = null;
    /**
     * 用户控制器的返回值
     * @var <type>
     */
    private $_userControllerReturn = null;
    /**
     * 构造函数
     * @param <type> $route
     * @param <type> $options
     * @param <type> $defaultUserControllerConfig
     */
    public function  __construct($route, $options = null, $defaultUserControllerConfig = array()) {        
        $this->_options = $options;
        $this->_route = $route;
        list(
            $this->_defaultModuleName,
            $this->_defaultControllerName,
            $this->_defaultActionName
            ) = $defaultUserControllerConfig;
        $this->loadSystemOptions();
        $this->loadUserControllerMap();
        $this->loadUserControllerFile();
        $this->loadUserControllerClass();
        $this->_userControllerReturn = $this->loadUserControllerMethod();
        
    }
    /**
     *　返回用户控制器所返回的值
     * @return <type>
     */
    public function getUserControllerRetrun(){
        return $this->_userControllerReturn;
    }
    /**
     * 实例化用户控制器中所定义的类
     */
    private function loadUserControllerClass() {
        $userControllerRoute = $this->_route;
        $userControllerModule = $userControllerRoute->getRouteModule();
        $userControllerName = $userControllerRoute->getRouteController();
        $userControllerAction = $userControllerRoute->getRouteAction();
        $userControllerClassRule = $this->_userControllerClassRule;
        $userControllerClassNames = array();
        foreach($userControllerClassRule as $rule) {
            $className = $this->parseRule($rule);
            array_push($userControllerClassNames, $className);
        }
        //var_dump($userControllerClassNames);
        foreach($userControllerClassNames as $className) {
            if(class_exists($className, null)) {
                break;
            }
            $className = null;
        }
        if($className === null ) {
            require_once 'K980K/Exception.php';
            throw new K980K_Exception('控制器类没有定义，请参数相关数据', 0, $userControllerClassNames);
        }
        //这里也可以使用递归的合并方面,但目前只使用了普通的合并函数来完成
       
        $options = $this->arrayMerge($this->getOptions(), $this->getMapOptions());

        $route = $this->_route;
        $extendData = $route->getExtendData();
        
        $userControllerClass = new $className($options, $extendData);
        $this->_userControllerClassHandler = $userControllerClass;
    }
    private function arrayMerge(){
        $args = func_get_args();
        $num  = func_num_args();
        if($num <= 1){
            return func_get_arg(0);
        }
       
        $return  =array_pop(array_reverse($args));
        foreach($args as $value){
            foreach($value as $key => $var){
                if(is_array($var) and isset($return[$key]) and is_array($return[$key])){
                    $return[$key] = $this->arraymerge($return[$key],$var);
                }else{
                    if(isset($return[$key])){
                        
                    }else{
                        $return[$key] = array();
                    }
                    if(is_array($var)){
                        $return[$key] = array_merge($return[$key],$var);
                    }else{
                      
                        $return[$key] = $var;
                    }
                }
            }
        }
       return $return;
        
        //return array_merge();
    }
    /**
     * 运行用户控制器中定义的类中的一个方法
     */
    private function loadUserControllerMethod() {
        $userControllerRoute = $this->_route;
        $userControllerMethodRule = $this->_userControllerMethodRule;
        $userControllerModule = $userControllerRoute->getRouteModule();
        $userControllerName = $userControllerRoute->getRouteController();
        $userControllerAction = $userControllerRoute->getRouteAction();
        $userControllerClassHandler = $this->_userControllerClassHandler;
		$userControllerQueryMethod = $userControllerRoute->getquerymethod();
		$methodNameList = array();
		if(!$userControllerQueryMethod == null){
			$temp = $userControllerMethodRule;			
			foreach($temp as $index => $value){
				array_push($userControllerMethodRule, $userControllerQueryMethod . $value);
			}
			unset($temp);
		}
        foreach($userControllerMethodRule as $rule) {			
            $methodName = $this->parseRule($rule);
            array_push($methodNameList, $methodName);
        }
        
        foreach($methodNameList as $methodName) {
            if(method_exists($userControllerClassHandler, $methodName)) {
                break;
            }
            $methodName = null;
        }
        if($methodName === null ) {
            require_once 'K980K/Exception.php';
            throw new K980K_Exception('控制器中没有找到相关方法,请参照相关数据', 0, $methodNameList);
        }
        call_user_func_array(array($userControllerClassHandler,$methodName), null);
    }
    /**
     * 加载由路由信息生成的控制器文件
     * @return <type>
     */
    private function loadUserControllerFile() {
        $userControllerPath = $this->_userControllerPath;
        $userControllerFileRule = $this->_userControllerFileRule;
        $userControllerFileExt = $this->_userControllerFileExt;
        $userControllerFileList = array();
        $fileName = null;
        foreach($userControllerPath as $path) {
            foreach($userControllerFileRule as $fileRule) {
                foreach($userControllerFileExt as $fileExt) {
                    $fileName = $path . $this->parseRule($fileRule) . $fileExt;
                    array_push($userControllerFileList, $fileName);
                }
            }
        }
        foreach($userControllerFileList as $fileName) {
            if(is_file($fileName)) {
                break;
            }else {
                $fileName = null;
            }
        }
        //var_dump($userControllerFileList);
        if($fileName === null) {
            require_once 'K980K/Exception.php';
            throw new K980K_Exception('控制器文件没有找到，请参照相关数据',0,$userControllerFileList);
        }
       
        return include $fileName;
    }
    private function filterRule($ruleString){
       
        return preg_replace(
            array(
                "/({$this->_defaultModuleIdentify})+/s",
                "/({$this->_defaultControllerIdentify})+/s",
                "/({$this->_defaultActionIdentify})+/s"
            ), array(
                $this->_defaultModuleIdentify,
                $this->_defaultControllerIdentify,
                $this->_defaultActionIdentify
            ),
            $ruleString
        );
    }
    /**
     * 解析一条规则
     * @param <type> $ruleString
     * @return <type>
     */
    private function parseRule($ruleString) {
       
        $userControllerRoute = $this->_route;
        $userControllerModule = $userControllerRoute->getRouteModule();        
        $userControllerName = $userControllerRoute->getRouteController();
        $userControllerAction = $userControllerRoute->getRouteAction();

        return $this->filterRule(str_replace(
        array(
        '\\\0',
        '\\\1',
        '\\\2',
        '\\\3'
        ),
        array(
        DIRECTORY_SEPARATOR,
        $userControllerModule . $this->_defaultModuleIdentify,
        $userControllerName . $this->_defaultControllerIdentify,
        $userControllerAction . $this->_defaultActionIdentify
        ),
        $ruleString
        ));
    }
    /**
     * 将用户自定义的配置合并到类成员中
     * @return <type>
     */
    private function loadUserControllerMap() {
        $userControllerPath = $this->_userControllerPath;
        $userControllerMap = $this->_userControllerMap;
        $userControllerMapRule = $this->_userControllerMapRule;
        
        $mapFileList = array();
        foreach($userControllerPath as $path) {
            foreach($userControllerMap as $file) {
                foreach($userControllerMapRule as $rule) {
                    $fileName = $path. $this->parseRule($rule) . $file;
                    array_push($mapFileList, $fileName);
                }
            }
        }
        $config = array();
        
        foreach($mapFileList as $file) {
            if(is_file($file)) {
                $config = new K980K_Config_Ini($file);
                $config = $config->_toArray();
            }
        }
        //var_dump($mapFileList);
        $this->_mapOptions = $config;
        $options = $this->getUserControllerMapOptions();       
        $this->setOptions($options);
        return $this;
    }
    /**
     * 将配置信息合并到类成员中
     * @param <type> $options
     */
    private function setOptions($options) {
        $separation = $this->_separation;
        
        if($options !== null and is_array($options)) {
            foreach($options as $key => $config) {
                if(property_exists($this, '_userController' . $key)) {
                    $thisKey = $this->getKey('_userController' . $key);
                    if(is_array($thisKey)) {
                        $config = explode($separation, $config);
                        $config = array_merge_recursive($thisKey, $config);
                    }                    
                    $this->setKey('_userController' . $key, $config);
                }else {
                    $this->_userControllerOptions[$key] = $config;
                }
            }
        }
    }
    /**
     * 从系统配置中读取相关配置并合并到类的配置数据中
     * @return <type>
     */
    private function loadSystemOptions() {
        $userControllerOptions = $this->getUserControllerOptions();        
        return $this->setOptions($userControllerOptions);
    }
    /**
     * 设置类成员的值
     * @param <type> $key
     * @param <type> $value
     * @return <type>
     */
    private function setKey($key, $value) {
        $this->$key = $value;
        return $this;
    }
    /**
     * 读取一个类成员的值
     * @param <type> $key
     * @return <type>
     */
    private function getKey($key) {
        return $this->$key;
    }
    /**
     * 取得系统默认配置
     * @return <type>
     */
    private function getOptions() {
        return $this->getKey('_options');
    }
    /**
     * 取得用户自定义的配置
     * @return <type>
     */
    private function getMapOptions() {
        return $this->getKey('_mapOptions');
    }
    /**
     * 从用户自定义的配置文件中读取用户控制器相关的配置信息
     * @return <type>
     */
    private function getUserControllerMapOptions() {
        $options = $this->getMapOptions();
       
        if(array_key_exists('controller', $options)) {
            $options = $options['controller'];
            if(array_key_exists('options', $options)) {
                $options = $options['options'];
                if(array_key_exists('userController', $options)) {
                    return $options['userController'];
                }
            }
        }
        return null;
    }
    /**
     * 从系统配置中过滤出用户控制器的参数
     * @return <type> 
     */
    private function getUserControllerOptions() {
        $options = $this->getOptions();
        
        if(array_key_exists('controller', $options)) {
            $options = $options['controller'];
            if(array_key_exists('options', $options)) {
                $options = $options['options'];
                if(array_key_exists('userController', $options)) {
                    return $options['userController'];
                }
            }
        }
        return null;
    }
}

