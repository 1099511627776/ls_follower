<?
class PluginFollower_ModuleText extends PluginFollower_Inherit_ModuleText
{
	public function LoadJevixConfig($sType='default',$bClear=true) {
		if ($bClear) {
			$this->oJevix->tagsRules=array();
		}
		$aConfig=Config::Get('jevix.'.$sType);
		if (is_array($aConfig)) {
			foreach ($aConfig as $sMethod => $aExec) {
				foreach ($aExec as $aParams) {
					if (in_array(strtolower($sMethod),array_map("strtolower",array('cfgSetTagCallbackFull','cfgSetTagCallback')))) {
						if (isset($aParams[1][0]) and $aParams[1][0]=='_this_') {
							$aParams[1][0]=$this;
						}
					}
					call_user_func_array(array($this->oJevix,$sMethod), $aParams);
				}
			}
			unset($this->oJevix->entities1['&']);
			if (Config::Get('view.noindex') and isset($this->oJevix->tagsRules['a'])) {				
				$this->oJevix->cfgSetTagParamDefault('a','rel','nofollow',true);
				if($oUser = $this->User_GetUserCurrent()){
					if($autofollow = Config::Get('plugin.follower.autofollow')){
						if(in_array($oUser->getId(),$autofollow)){
							$this->oJevix->cfgSetTagParamDefault('a','rel','follow',true);
						}
					}
				}
			}
		}
	}

	protected function FollowDomain($sText,$sDomain){
		$sResult = $sText;
		$sResult = preg_replace(
			"/<\s*a(.*?)href=[\"'](.*?".$sDomain.".*?)[\"'](.*?)>/mi",
			"<a $1 href=\"$2\" $3>",$sText);
		$sResult = preg_replace(
			"/<a\s+rel=[\"'](.*?)[\"'](.*?)href=[\"'](.*".$sDomain.".*?)[\"'](.*?)>/mi",
			"<a href=\"$3\" rel=\"follow\" $2 $4>",$sResult);
		$sResult = preg_replace(
			"/<a\s+href=[\"'](.*?".$sDomain.".*?)[\"'](.*?)rel=[\"](.*?)[\"](.*?)>/mi",
			"<a href=\"$1\" $2 rel=\"follow\" $4>",$sResult);
		return $sResult;
	}
	protected function FollowDomains($sText){
	    $sResult = $sText;
		if($domains = Config::Get('plugin.follower.domains')){			
			foreach($domains as $domain){
				$sResult = $this->FollowDomain($sResult,$domain);				
			}
		}
		return $sResult;
	}
	public function Parser($sText) {
		$sResult = parent::Parser($sText);
		$sResult = $this->FollowDomains($sResult);
		return $sResult;
	}
}

?>