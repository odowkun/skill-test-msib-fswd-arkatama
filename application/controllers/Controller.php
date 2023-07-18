<?php
class Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Input');
	}

	function index()
	{
		$this->load->view('template/Landing/index');
	}

	function proses()
	{
		$data['hasil'] = $this->Model_Input->input();
		$this->load->view('template/Landing/index');
	}
}
