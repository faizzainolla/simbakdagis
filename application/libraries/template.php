<?php
class Template {

	protected $ci_system;

	function __construct(){
		$this->ci_system = &get_instance();
		$this->ci_system->db->query('SET GLOBAL event_scheduler = ON;');
	}

	function display($source_target, $data=null, $ignore=null) {

		$site_template = $this->ci_system->config->config['template'];
		
		$data['_head'] = $this->ci_system->load->view($site_template.'/structures/head', $data, true);
		$data['_header'] = $this->ci_system->load->view($site_template.'/structures/header', $data, true);
		$data['_topside'] = $this->ci_system->load->view($site_template.'/structures/side-top', $data, true);
		$data['_leftside'] = $this->ci_system->load->view($site_template.'/structures/side-left', $data, true);
		$data['_content'] = $this->ci_system->load->view($site_template.'/sources/'.$source_target, $data, true);
		$data['_rightside'] = $this->ci_system->load->view($site_template.'/structures/side-right', $data, true);
		$data['_bottomside'] = $this->ci_system->load->view($site_template.'/structures/side-bottom', $data, true);
		$data['_footer'] = $this->ci_system->load->view($site_template.'/structures/footer', $data, true);

		$this->ci_system->load->view($site_template.'/structures/template_render', $data);

	}

	function single($source_target, $data=null, $ignore=null) {

		$site_template = $this->ci_system->config->config['template'];

		$this->ci_system->load->view($site_template.'/sources/'.$source_target, $data);
	}

	function headonly($source_target, $data=null, $ignore=null) {
		$site_template = $this->ci_system->config->config['template'];

		$data['_header'] = $data['_topside'] = $data['_leftside'] = $data['_rightside'] = $data['_bottomside'] = '';
		$data['_head'] = $this->ci_system->load->view($site_template.'/structures/head', $data, true);
		$data['_content'] = $this->ci_system->load->view($site_template.'/sources/'.$source_target, $data, true);
		$data['_footer'] = $this->ci_system->load->view($site_template.'/structures/footer', $data, true);

		$this->ci_system->load->view($site_template.'/structures/template_render', $data);
	}

}

?>
