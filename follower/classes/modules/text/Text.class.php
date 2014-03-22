<?php

function make_out_callback($matches){
    $bOk = true;
    if($domains = Config::Get('plugin.follower.domains')){
        foreach($domains as $domain){
            if(preg_match('/^'.$domain.'/misuU',$matches[2])){
                $bOk = false;
                break;
            }
        }
    }
    if(preg_match('/^(!?\/).*?/mi',$matches[2])){
        $bOk = false;
    }
    if($bOk){
        $sUrl = Config::Get('plugin.follower.use_encoding') ? base64_encode($matches[2]) : $matches[2];
        return "<a ".$matches[1]." href=\"".Router::GetPath('out')."?l=".$sUrl."\" ".$matches[3].">";
    }
    return "<a ".$matches[1]." href=\"".$matches[2]."\" ".$matches[3].">";
}
class PluginFollower_ModuleText extends PluginFollower_Inherit_ModuleText
{
    public function LoadJevixConfig($sType='default',$bClear=true) {
        parent::LoadJevixConfig($sType,$bClear);
        if($oUser = $this->User_GetUserCurrent()){
            if($autofollow = Config::Get('plugin.follower.autofollow')){
                if(isset($this->oJevix->tagsRules['a'])) {
                    if(in_array($oUser->getId(),$autofollow)){
                        $this->oJevix->cfgSetTagParamDefault('a','rel','',true);
                    }
                }
            }
        }
    }

    protected function FollowDomain($sText,$sDomain){
        $sResult = $sText;
        $sResult = preg_replace(
            "/<\s*a(.*?)href=[\"'](.*?".$sDomain.".*?)[\"'](.*?)>/misuU",
            "<a $1 href=\"$2\" $3>",$sText);
        $sResult = preg_replace(
            "/<a\s+rel=[\"'](.*?)[\"'](.*?)href=[\"'](.*".$sDomain.".*?)[\"'](.*?)>/misuU",
            "<a href=\"$3\" $2 $4>",$sResult);
        $sResult = preg_replace(
            "/<a\s+href=[\"'](.*?".$sDomain.".*?)[\"'](.*?)rel=[\"](.*?)[\"](.*?)>/misuU",
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

    public function MakeOut($sText){
        $sResult = $sText;
        $sResult = preg_replace_callback("/<\s*a(.*?)href=[\"'](.*?)[\"'](.*?)>/misuU",'make_out_callback',$sText);
        return $sResult;
    }

    public function Parser($sText) {
        $sResult = parent::Parser($sText);
        if(Config::Get('plugin.follower.permanent_nofollow')){
            $sResult = $this->FollowDomains($sResult);
        }
        if(Config::Get('plugin.follower.permanent_outredir') && Config::Get('plugin.follower.enable_outredir')){
            $sResult = $this->MakeOut($sText);
        }
        return $sResult;
    }
}

?>