<?php
class PluginFollower_ModuleTopic_EntityTopic extends PluginFollower_Inherit_ModuleTopic_EntityTopic {

    public function getText(){
        $sText = parent::getText();
        if(Config::Get('plugin.follower.permanent_outredir')){
            return $sText;
        }
        if(Config::Get('plugin.follower.enable_outredir')){
            return $this->PluginFollower_ModuleText_MakeOut($sText);
        }
        return $sText;
    }

    public function getTextShort(){
        $sText = parent::getTextShort();
        if(Config::Get('plugin.follower.permanent_outredir')){
            return $sText;
        }
        if(Config::Get('plugin.follower.enable_outredir')){
            return $this->PluginFollower_ModuleText_MakeOut($sText);
        }
        return $sText;
    }

}
?>