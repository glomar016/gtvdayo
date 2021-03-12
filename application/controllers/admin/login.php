<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->load->view('admin/login');
    }
	
	public function submit()
	{
		$this->load->model('auth_model');

		$userName = $this->input->post('userName');
		$userPassword = $this->input->post('userPassword');

		$this->form_validation->set_rules('userName', 'Username', 'required');
		$this->form_validation->set_rules('userPassword', 'Password', 'required');

			if ($this->form_validation->run() == FALSE) {
				if(isset($this->session->userdata['logged_in'])){
					redirect(base_url().'admin/dashboard', 'refresh');
				}
				else{
					$this->load->view('admin/login');
				}
			} 
			else {
				$data = array(
					'userName' => $this->input->post('userName'),
					'userPassword' => $this->input->post('userPassword')
					);
				$result = $this->auth_model->login($data);

				
				if ($result == TRUE) {
					$userName = $this->input->post('userName');
					$userPassword = $this->input->post('userPassword');
					
					$result = $this->auth_model->read_user_information($userName, $userPassword);
						if ($result != FALSE) {
							$session_data = array(
								'userName' => $result[0]->userName,
								'userID' => $result[0]->id
								);
						// Add user data in session
						$this->session->set_userdata('logged_in', $session_data);
                        $data['result'] = 'Success';
                        echo json_encode($data);
						
					}
				} 
				else {
					$data['result'] = 'Error';
					echo json_encode($data);
				}
			}
	}

	
    

}
