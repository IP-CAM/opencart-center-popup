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
		if ($setting['target']=="0") {
		$this->data['target'] = '_self';
		} else {
		$this->data['target'] = '_blank';
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/center_popup.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/center_popup.tpl';
		} else {
			$this->template = 'default/template/module/center_popup.tpl';
		}

		$this->render();
	}
}
?>