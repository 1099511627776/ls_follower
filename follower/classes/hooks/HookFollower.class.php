<?php

class PluginFollower_HookFollower extends Hook {

    /*
     * Регистрация событий на хуки
    */
    public function RegisterHook() {
        $this->AddHook('template_footer_end', 'displayCopyright',__CLASS__);
    }
    
    public function displayCopyright(){
        return '<a href="http://goloskarpat.info/">Голос Карпат - Новини Закарпаття</a>';
    }
}
?>
