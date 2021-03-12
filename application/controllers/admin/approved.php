<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approved extends CI_Controller {

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
		$this->load->view('admin/approved');
	}

    public function show_approved(){
		$data['data'] = $this->database_model->show_approved();

		echo json_encode($data);
	}

	public function delete_approved(){

		$id = $this->input->post('id');

		echo $id;
		echo 'test';

		$this->database_model->delete($id, 'approvedStatus', 't_approved');
	}
}
