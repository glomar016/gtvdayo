<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {

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
		$this->load->view('admin/request');
	}

	public function show_request()
	{
		$data['data'] = $this->database_model->show_request();

		echo json_encode($data);
	}
	
	public function add_request()
	{
		echo 'test';
		$requestApplicantName = $this->input->post('requestApplicantName');
		$requestTeamName = $this->input->post('requestTeamName');
		$requestDate = $this->input->post('requestDate');
		$requestBarangay = $this->input->post('requestBarangay');
		$requestCity = $this->input->post('requestCity');
		$requestEmail = $this->input->post('requestEmail');

		echo $requestApplicantName;
		echo $requestTeamName;

		$this->database_model->add_request($requestApplicantName, $requestTeamName, $requestBarangay, $requestCity, $requestEmail, $requestDate);
		
	}

	public function delete_request()
	{
		$id = $this->input->post('id');
		echo $id;
		$this->database_model->delete($id, "requestStatus", "t_request");
	}

	public function send_message()
	{
		$id = $this->input->post('sendID');
		$address = $this->input->post('sendAddress');
		$time = $this->input->post('sendTime');
		$time = date('h:i A', strtotime($time));

		$approvedData = array(
			'approvedRequestID' => $id,
			'approvedUserID' => $this->session->userdata['logged_in']['userID']
		);

		$this->database_model->create($approvedData, 't_approved');
		$this->database_model->approved($id, 'requestStatus', 't_request');
		
        $data = $this->database_model->get_request_info($id);
		$date = date('F d, Y', strtotime($data[0]->requestDate));

        $filename = base_url().'resources/img/emailLogo.png';
        $this->email->attach($filename);
        $cid = $this->email->attachment_cid($filename);
        
        $htmlContent = ' 
        <html> 
            <head> 
                <title>Daniel GTV Dayo Series</title> 
            </head> 
            <body style="background-color: #121111; max-width:700px; margin:auto;">  
                <div style="text-align: center;">
                    <img src="cid:' .$cid.'">
                    <h1 style="color:#ff0000;">Congratulations '. $data[0]->requestApplicantName.'! </h1> 
					<h2 style="color:white;">Your game request has been approved</h2>
					<h2 style="color:white;">by Daniel GTV</h2>
                </div>
                <div style="color:white; background-color: white; max-width:300px; max-height: 300px; margin:auto; text-align:center; padding:10px">
                    <div style="margin:2px; background-color: maroon">
                        <br><br>
                        <h3 style="text-align: center; color:white; margin:0px;">Game Details</h3>
                        <br>
                        <h4 style="text-align: center; color:white; margin:0px;">Date: <span>'. $date. '</span></h4>
                        <h4 style="text-align: center; color:white; margin:0px;">Time: <span>'. $time. '</span></h4>
                        <h4 style="text-align: center; color:white; margin:0px;">Court Location: <span>'. $address. '</span></h4>
                        <br><br>
                    </div>
                </div>
				<div style="text-align:center; color:white">
					<p>
                            Youtube Channel: <a href="https://www.youtube.com/channel/UCoJA9tEn6zXuIVwlFbcbs9g"  target="_blank">DANIEL GTV </a>
                        </p>
                        <p >
                            Facebook Page: <a href="https://www.facebook.com/nDanielGTV" target="_blank">DANIEL GTV </a>
                        </p>
                        <p >
                            Facebook Group: <a href="https://www.facebook.com/groups/danielgtvdayo" target="_blank">DANIEL GTV DAYO (TEAM GTV) </a>
                        </p>
                        <p >
                            Facebook Gaming Page: <a href="https://www.facebook.com/danielgtvgaming" target="_blank">DANIEL GTV GAMING </a>
                        </p>
                        <p >
                            Personal Account: <a href="https://www.facebook.com/nikkidaniel.gatan" target="_blank">DANIEL GATAN </a>
                        </p>
                        <p >
                            Instagram: <a href="https://www.instagram.com/danielgtv_/" target="_blank">@DANIELGTV_ </a>
                        </p>
                        <p >
                            Tiktok: <a href="https://www.tiktok.com/@danielgtv?" target="_blank">@DANIELGTV</a>
                        </p>
				</div>
                <br><br><br>
            </body> 
        </html>';

        
        

        $this->email->from('danielgtv@gmail.com', 'Daniel GTV');
        $this->email->to($data[0]->requestEmail);

        $this->email->subject('Congratulations your request has been approved by Daniel GTV)');
        $this->email->message($htmlContent);

        $this->email->send();
	}
}
