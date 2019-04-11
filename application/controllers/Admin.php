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

	function register_db()
	{
		$this->load->view("Admin/register-db");
	}

	function add_db()
	{
		$data = array();

		if(!empty($_POST)):

			if($_POST['password1'] == $_POST['password2']):
				$data['msg'] = $this->_users->add_user($_POST);
				$this->load->view("Admin/register-db",$data);
			else:
				$data['msg'] = 'password_mismatch';
				$this->load->view("Admin/register-db",$data);
			endif;
			
		endif;
	}

	function logout()
	{
		//$this->session->sess_destroy();
		//redirect("Login/index");
	}
}