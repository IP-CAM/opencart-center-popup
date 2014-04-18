<?php
class ControllerModuleCenterPopup extends Controller {
	private $error = array(); 

	public function index() {
/* load language */
	$this->load->language('module/center_popup');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting('center_popup', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
/* text for module */
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		$this->data['entry_title'] = $this->language->get('entry_title');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_width'] = $this->language->get('entry_width');
		$this->data['entry_height'] = $this->language->get('entry_height');
		$this->data['entry_link'] = $this->language->get('entry_link');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_target'] = $this->language->get('entry_target');
		$this->data['text_blank'] = $this->language->get('text_blank');
		$this->data['text_self'] = $this->language->get('text_self');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['code'])) {
			$this->data['error_code'] = $this->error['code'];
		} else {
			$this->data['error_code'] = '';
		}
/* breadcrums */
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'href' 		=> $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'text' 		=> $this->language->get('text_home'),
			'separator' => FALSE
		);

		$this->data['breadcrumbs'][] = array(
			'href'		=> $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			'text' 		=> $this->language->get('text_module'),
			'separator' => ' -> '
		);

		$this->data['breadcrumbs'][] = array(
			'href' 		=> $this->url->link('module/center_popup', 'token=' . $this->session->data['token'], 'SSL'),
			'text' 		=> $this->language->get('heading_title'),
			'separator' => ' -> '
		);
/* breadcrums end */
/* button link */
		$this->data['action'] = $this->url->link('module/center_popup', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
/* option */
		if (isset($this->request->post['center_popup_image'])) {
			$this->data['center_popup_image'] = $this->request->post['center_popup_image'];
		} else {
			$this->data['center_popup_image'] = $this->config->get('center_popup_image');
		}
		if (isset($this->request->post['center_popup_width'])) {
			$this->data['center_popup_width'] = $this->request->post['center_popup_width'];
		} else {
			$this->data['center_popup_width'] = $this->config->get('center_popup_width');
		}
		
		if (isset($this->request->post['center_popup_height'])) {
			$this->data['center_popup_height'] = $this->request->post['center_popup_height'];
		} else {
			$this->data['center_popup_height'] = $this->config->get('center_popup_height');
		}
		
		if (isset($this->request->post['center_popup_link'])) {
			$this->data['center_popup_link'] = $this->request->post['center_popup_link'];
		} else {
			$this->data['center_popup_link'] = $this->config->get('center_popup_link');
		}
		
		if (isset($this->request->post['center_popup_title'])) {
			$this->data['center_popup_title'] = $this->request->post['center_popup_title'];
		} else {
			$this->data['center_popup_title'] = $this->config->get('center_popup_title');
		}
		

/* option end */
/* position */
		$this->data['modules'] = array();
		if (isset($this->request->post['center_popup_module'])) {
			$this->data['modules'] = $this->request->post['center_popup_module'];
		} elseif ($this->config->get('center_popup_module')) { 
			$this->data['modules'] = $this->config->get('center_popup_module');
		}
/* position end */
		$this->load->model('design/layout');
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/center_popup.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);

		$this->response->setOutput($this->render());

		/*
		
		$this->template = 'module/center_popup.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
		*/
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/center_popup')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['center_popup_image']) {
			$this->error['code'] = $this->language->get('error_code');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>
