<?php 
class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{  
		$this->load->view("login/index");
	}

	function authenticate()
	{

		if(!empty($_POST)):

			$sql = "SELECT * FROM users u WHERE u.email LIKE '".$_POST['email']."' AND u.password LIKE '".$_POST['pass']."' ";
			$get = $this->db->query($sql)->result();

			if(!empty($get)):

				foreach($get as $user):

					if($user->role == 'admin'):
						$set_session = array("userid"=>$user->id,"email"=>$user->email,"names"=>$user->names);
						$this->session->set_userdata($set_session);

						redirect('Admin/index');
					elseif($user->role == 'user'):
						$set_session = array("userid"=>$user->id,"email"=>$user->email,"names"=>$user->names);
						$this->session->set_userdata($set_session);

						redirect('User/index');
					endif;

				endforeach;

			else:
				$data['msg'] = 'Incorrect Email or Password';
				$this->load->view("login/index",$data);
			endif;

		endif;
	}
}
