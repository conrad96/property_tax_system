<?php 
class _users extends CI_Model{

	function all_users($arg=1)
	{
		$data = array();

		switch ($arg) 
		{
			case 1:
		    	$sql = "SELECT * FROM users u WHERE u.role='user' ";
				$data['users'] = $this->db->query($sql)->num_rows();
			break;
			case 2:
				$sql = "SELECT * FROM users u ORDER BY u.role ";
				$data['users'] = $this->db->query($sql)->result();
			break;
		}
		
		return $data['users'];
	}
	function add_user($data)
	{
		$user = array(
			"names"=>$data['names'],
			"contact"=>$data['contact'],
			"email"=>$data['email'],
			"role"=>$data['role'],
			"password"=>$data['password2']
		);

		$add = $this->db->insert("users",$user);
		return ($add)? TRUE : FALSE;
	}

	function clients($arg=1)
	{
		switch($arg)
		{
			case 1:
				return $this->db->get("clients")->num_rows();
			break;
			case 2:
				$sql = "SELECT u.names as author,c.* FROM users u INNER JOIN clients c ON u.id = c.registered_by ";
				return $this->db->query($sql)->result();
			break;
		}
	}
}