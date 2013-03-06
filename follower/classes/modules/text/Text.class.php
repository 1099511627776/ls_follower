<?php

class PluginFollower_ModuleText extends PluginFollower_Inherit_ModuleText
{
	public function LoadJevixConfig($sType='default',$bClear=true) {
		parent::LoadJevixConfig($sType,$bClear);
		if($oUser = $this->User_GetUserCurrent()){
			if($autofollow = Config::Get('plugin.follower.autofollow')){
				if(in_array($oUser->getId(),$autofollow)){
					$this->oJevix->cfgSetTagParamDefault('a','rel','',true);
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
			"<a href=\"$3\" $2 $4>",$sResult);
		$sResult = preg_replace(
			"/<a\s+href=[\"'](.*?".$sDomain.".*?)[\"'](.*?)rel=[\"](.*?)[\"](.*?)>/mi",
			"<a href=\"$1\" $2 $4>",$sResult);
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