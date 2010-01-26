<?php
/* 
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_Controller_Router_Adapter_Rewrite extends K980K_Controller_Router_Adapter {
	public function _matching($reQuestUrl) {
		if(!$this->checkReQueryMethod()){
			return false;
		}
        $reQuestUrl = $this->getQuestUrl(null, $reQuestUrl);
        $reQuestUrl = $this->_trim($reQuestUrl);
        $ruleString =$this->_trim($this->ruleString);
        $ruleString = str_replace('/', '\/', $ruleString);
        $regString = '/^' . $ruleString . '/';
        $dataString = preg_replace($regString, '', $reQuestUrl);
        if(preg_match($regString, $reQuestUrl, $matches) != false) {
            $extendData = $this->extendData;
            foreach($matches as $key => $value) {
                if(isset($extendData[$key])) {
                    $extendData[($extendData[$key])] = $value;
                    unset($extendData[$key]);
                }
            }
            $this->extendData = $extendData;
            return $this;
        }
        return false;
    }
}

