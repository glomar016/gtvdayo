<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userrole extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('admin/userrole');
	}

	public function add_user()
	{
		$userName = $this->input->post('userName');
		$userPassword = $this->input->post('userPassword');


		$this->database_model->add_user($userName, $userPassword);
	}

	public function show_user()
	{
		$data['data'] = $this->database_model->show_user();

		echo json_encode($data);
	}
	
	public function delete_user()
	{
		// loading model that needed
		$this->load->model('database_model');

		$id = $this->input->get('id');
		$this->database_model->delete($id, "userStatus", "t_user");
	}

	public function activate_user()
	{
		// loading model that needed
		$this->load->model('database_model');

		$id = $this->input->get('id');
		$this->database_model->activate($id, "userStatus", "t_user");
	}
}
