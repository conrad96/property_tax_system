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
		}
		
		return $data['users'];
	}

}