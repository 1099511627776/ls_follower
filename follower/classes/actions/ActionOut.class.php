<?php
class PluginFollower_ActionOut extends ActionPlugin {

    public function Init(){
    }

    protected function RegisterEvent() {
        //$this->AddEventPreg('/^[\w\-\_]+$/i','EventRedirectOut');
        $this->AddEvent('','EventRedirectOut');
    }

    public function EventRedirectOut(){
        $this->setTemplateAction('out');
        $sUrl = Config::Get('plugin.follower.use_encoding') ? base64_decode(getRequest('l')) : getRequest('l');
        if(Config::Get('plugin.follower.use_page')){
            $this->Viewer_Assign('sUrl',$sUrl);
        } else {
            header('Location: '.$sUrl,true,302);
            return;
        }
    }
}