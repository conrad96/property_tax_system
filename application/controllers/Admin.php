<?php 
class Admin extends CI_Controller 
{
	function __construct()
	{
		if(!isset($this->session->userid)):
		  $this->logout();
		endif;
		parent::__construct();
	}

	function index()
	{
		$data = array();
		$this->load->view("Admin/index",$data);
	}

	function logout()
	{
		//$this->session->sess_destroy();
		//redirect("Login/index");
	}
}