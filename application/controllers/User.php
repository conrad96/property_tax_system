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

		if(!empty($_POST) && !empty($_FILES)):

			$_POST['photos']['images'] = array();
			//upload images
				$uploads_dir = $_SERVER['DOCUMENT_ROOT'].'/project/assets/uploads/property_images/';

				$file_str = str_replace(',','_',str_replace(' ','_',$_FILES['photos']['name']));

			foreach($_FILES["photos"]["error"] as $key => $error):
			
			    if ($error == UPLOAD_ERR_OK):

			        $tmp_name = $_FILES["photos"]["tmp_name"][$key];
				    $name = str_replace(',','_',str_replace(' ','_',basename($_FILES["photos"]["name"][$key])));

				        move_uploaded_file($tmp_name, "$uploads_dir/$name");

				        array_push($_POST['photos']['images'], $name);
			    endif;

			endforeach;

			//upload AUTOCAD design
			$autocad_file_name = $_FILES['autocad_file']['name'];
			$autocad_file = $_SERVER['DOCUMENT_ROOT'].'/project/assets/uploads/property_designs/'.$autocad_file_name;
			$file_str_cad = str_replace(',','_',str_replace(' ','_',$_FILES['autocad_file']['name']));
			move_uploaded_file($_FILES['autocad_file']['tmp_name'],$autocad_file);

			$_POST['autocad_file'] = !empty($autocad_file_name)? $autocad_file_name : "No File uploaded";

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

	function all_properties()
	{
		$data['properties'] = $this->_properties->view();
		$this->load->view("User/view-property",$data);
	}

	function property($property_id)
	{
		$data['property'] = $this->_properties->get_property($property_id);

		$this->load->view("User/property",$data);
	}

	function edit_property()
	{
		$data = array();

		if(!empty($_POST)):

			$_POST['photos']['images'] = array();
			//upload images
				$uploads_dir = $_SERVER['DOCUMENT_ROOT'].'/project/assets/uploads/property_images/';

				$file_str = str_replace(',','_',str_replace(' ','_',$_FILES['photos']['name']));

			foreach($_FILES["photos"]["error"] as $key => $error):
			
			    if ($error == UPLOAD_ERR_OK):

			        $tmp_name = $_FILES["photos"]["tmp_name"][$key];
				    $name = str_replace(',','_',str_replace(' ','_',basename($_FILES["photos"]["name"][$key])));

				        move_uploaded_file($tmp_name, "$uploads_dir/$name");

				        array_push($_POST['photos']['images'], $name);
			    endif;

			endforeach;

			//upload AUTOCAD design
			$autocad_file_name = $_FILES['autocad_file']['name'];
			$autocad_file = $_SERVER['DOCUMENT_ROOT'].'/project/assets/uploads/property_designs/'.$autocad_file_name;
			$file_str_cad = str_replace(',','_',str_replace(' ','_',$_FILES['autocad_file']['name']));
			move_uploaded_file($_FILES['autocad_file']['tmp_name'],$autocad_file);

			$_POST['autocad_file'] = !empty($autocad_file_name)? $autocad_file_name : "";

			$fields = json_encode($_POST);
			$id = $_POST['property_id'];

			$property = array(
				"title"=>!empty($_POST['property_title'])? $_POST['property_title'] : 'undefined property',
				"data"=>$fields,
				"author"=>$this->session->userid
			);
			
			$add_property = $this->_properties->edit($id,$property);
			$data['msg'] = ($add_property)? 'success' : 'fail';
		endif;
	}
}