<?php

class PluginFollower_HookFollower extends Hook {

    /*
     * ����������� ������� �� ����
	*/
    public function RegisterHook() {
        $this->AddHook('template_footer_end', 'displayCopyright',__CLASS__);
    }
	
	public function displayCopyright(){
		$s = '<a href="http://goloskarpat.info/">goloskarpat.info</a>';
		dump($s);
        return $s;
	}
}
?>
