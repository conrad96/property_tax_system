<?php 
class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		if(isset($this->session->userid)):
			$data = array();
			$this->load->view("User/index",$data);
		endif;
	}

	function add_property()
	{
		$data['property_types'] = $this->_properties->property_types();
		$data['accomodation_breakdowns'] = $this->_properties->accomodation_breakdown();
		$this->load->view("User/add-property",$data);
	}

	function add_new_property()
	{
		$data = array();

		if(!empty($_POST)):

			$fields = json_encode($_POST);
			$property = array(
				"title"=>!empty($_POST['property_title'])? $_POST['property_title'] : 'undefined property',
				"data"=>$fields,
				"author"=>$this->session->userid
			);
			
			$add_property = $this->_properties->add($property);
			$data['msg'] = ($add_property)? 'success' : 'fail';
		endif;

		$this->load->view("User/add-property",$data);
	}
}