<?php 

if (isset($this->session->userdata['logged_in'])) {
    $userID = ($this->session->userdata['logged_in']['userID']);
    $userName = ($this->session->userdata['logged_in']['userName']);
} 
else {
    header("location: ".base_url()."admin/login");
}

?>