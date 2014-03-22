<?php
class PluginFollower_ModuleTopic_EntityContentValues extends PluginFollower_Inherit_ModuleTopic_EntityContentValues {
    public function GetValue(){
        $sValue = parent::GetValue();
        if(Config::Get('plugin.follower.enable_outredir')){
            if(in_array($this->getFieldType(),array('textarea','input'))){
                $sValue = $this->PluginFollower_ModuleText_MakeOut($sValue);
            }
        }

        return $sValue;
    }
}
?>