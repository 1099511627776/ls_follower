<?php
class PluginFollower_ActionOut extends ActionPlugin {

    public function Init(){
    }

    protected function RegisterEvent() {
        //$this->AddEventPreg('/^[\w\-\_]+$/i','EventRedirectOut');
        $this->AddEvent('','EventRedirectOut');
    }

    public function EventRedirectOut(){
        $sUrl = getRequest('l');
        $this->Viewer_Assign('sUrl',$sUrl);
        $this->setTemplateAction('out');
    }
}