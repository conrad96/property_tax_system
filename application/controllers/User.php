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
		$id = 0;

		if(!empty($_POST)):

			$_POST['photos']['images'] = array();
			$id = $_POST['property_id'];
			//upload images
			if(!empty($_FILES)):
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
			else:
				//get original files
				$sql_1 = "SELECT rp.data FROM registered_properties rp WHERE rp.id = '".$id."' ";
				$orig_images = $this->db->query($sql_1)->result();
				if(!empty($orig_images)):
					foreach($orig_images as $orig_image):
						$files = json_decode($orig_image->data);
						$photos = $files->photos->images; 
						foreach($photos as $photo):
							array_push($_POST['photos']['images'] ,$photo);	
						endforeach;
						//autocad files
						$_POST['autocad_file'] = !empty($files->autocad_file)? $files->autocad_file : "";
					endforeach;
				endif;
			endif;

			$fields = json_encode($_POST);
			
			$property = array(
				"title"=>!empty($_POST['property_title'])? $_POST['property_title'] : 'undefined property',
				"data"=>$fields,
				"author"=>$this->session->userid
			);
			
			$add_property = $this->_properties->edit($id,$property);
			$data['msg'] = ($add_property)? 'success' : 'fail';
		endif;

		$data['property'] = $this->_properties->get_property($id);
		$this->load->view("User/property",$data);
	}

	function export_invoice($id)
	{
		// get record
		$data['property'] = $this->_properties->get_property($id);

		/*
		//$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor($paper[0]['author']);
		$pdf->SetTitle($paper[0]['title']);
		$pdf->SetSubject('Objective Paper');
		$pdf->SetKeywords('Objective, PDF, Export');

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' ', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setFooterData(array(0,64,0), array(0,64,128));

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		$pdf->setFontSubsetting(true);

		$pdf->SetFont('dejavusans', '', 12, '', true);

		$pdf->AddPage();

		$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

		//$pdf->writeHTMLCell(0, 0, '', '', $layout, 0, 1, 0, true, '', true);
		$pdf->writeHTML($layout, true, false, true, false, '');

		$pdf->Output($paper[0]['title'].'.pdf', 'I');
		*/
		$this->load->view("User/view",$data);
	}

	function all_clients()
	{
		$data['clients'] = $this->_users->clients(2);
		$this->load->view("User/clients",$data);
	}
}