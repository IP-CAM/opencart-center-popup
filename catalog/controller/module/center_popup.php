<?php  
class ControllerModuleCenterPopup extends Controller {
	protected function index($setting) {
		//print_r($setting);
		$this->language->load('module/center_popup');
		$this->data['close'] = $this->language->get('close');
		$this->data['image_url'] = $this->config->get('center_popup_image');
		$this->data['image_width'] = $this->config->get('center_popup_width');
		$this->data['image_height'] = $this->config->get('center_popup_height');
		$this->data['image_link'] = $this->config->get('center_popup_link');
		$this->data['image_title'] = $this->config->get('center_popup_title');

		
		/*		$ymarray = explode(",", $this->config->get('center_popup_code'));
		$this->data['popuptarget'] = "";
		foreach($ymarray as $ymid){
			$this->data['popuptarget'] .= '<a href="ymsgr:sendim?'.trim($ymid).'" ><img src="http://opi.yahoo.com/online?u='.trim($ymid).'&amp;t='.$setting['image'].'" alt="'.trim($ymid).'"></a>';
			if($setting['listview']=="0")
				$this->data['popuptarget'] .= "_blank";
			else
				$this->data['popuptarget'] .= "&nbsp;&nbsp;";
		}
*/
		//$this->id = 'center_popup';

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/center_popup.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/center_popup.tpl';
		} else {
			$this->template = 'default/template/module/center_popup.tpl';
		}

		$this->render();
	}
}
?>