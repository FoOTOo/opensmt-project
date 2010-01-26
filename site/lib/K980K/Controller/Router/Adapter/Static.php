<?php
/* 
 * @copyright 2007-2009 opensmt.footoo.org All rights reserved.
 * See cpyright.txt for copyright notices and details.
 */
class K980K_Controller_Router_Adapter_Static extends K980K_Controller_Router_Adapter {
	public function _matching($reQuestUrl) {
		if(!$this->checkReQueryMethod()){
			return false;
		}
        $reQuestUrl = $this->getQuestUrl(null, $reQuestUrl);
        $reQuestUrl = $this->_trim($reQuestUrl);
        $ruleString =$this->_trim($this->ruleString);
        if($reQuestUrl == $ruleString) {
			
            return $this;
        }
        return false;
    }
}
