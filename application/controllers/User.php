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
		$property_details = $this->_properties->get_property($id);

		if(!empty($property_details)):
			foreach($property_details as $property):
				$data = json_decode($property->data);

				$html = "
			<table>
				<tr>
					<td>
						<table cellspacing='3' cellpadding='2'>
							<tr>
							<td>&nbsp;</td>
							<td>
								<h4>PROPERTY TAX RATES</h4>
							</td>
							<td>&nbsp;</td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							<td><h6>(Demand Note Invoice Statement)</h6></td>
							<td>&nbsp;</td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							</tr>
							<tr>
								<td>
								<table>
									<tr>
										<td>P.O Box 25749</td>
									</tr>
									<tr>
										<td>Kampala</td>
									</tr>
									<tr>
										<td>TIN No: 1000151480</td>
									</tr>
								</table>
								</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td>
								<table border='1' >
								<tr>
									<td>Town Clerk:</td>
									<td>0414696923</td>
								</tr>
								<tr>
									<td>Head of Finance:</td>
									<td>0414696718</td>
								</tr>
									<tr>
										<td>Rates Desk:</td>
										<td>0414696719</td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>Date: ".date("d/m/Y")."</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>
									<table>
										<tr>
											<th><strong>Bill to:</strong></th>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td colspan='2'>
											<table>
												<tr>
													<td>Tax Payer:</td>
													<td>".$data->owner_title.". ".$data->surname_contact." ".$data->firstname_contact."</td>
												</tr>
												<tr>
													<td>Zone:</td>
													<td>".(!empty($data->parish_property) || !empty($data->village_property)? $data->parish_property.','.$data->village_property : "Not provided."  )."</td>
												</tr>
												<tr>
													<td>Val No:</td>
													<td>502-0".$property->id."</td>
												</tr>
												<tr>
													<td>Prom No:</td>
													<td>502-05".$property->id."</td>
												</tr>
												<tr>
													<td>Description:</td>
													<td>".$data->property_type."</td>
												</tr>
											</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				</tr>
				<tr>
				<td>
					<table>
						<tr>
							<td><strong>Date</strong></td>
							<td><strong>Details</strong></td>
							<td><strong>Assessment</strong></td>
							<td><strong>Balance</strong></td>
						</tr>
						<tr>
						<td>&nbsp;</td>
						</tr>";
						//logic to calculate taxes
						if(!empty($data->numberof_units) && !empty($data->rent_amount)):
							$rentper_unit = $data->rent_amount;
							$annual = 12 * $rentper_unit;
							$ratable = (80/100) * $annual;
							$tax = (4/100) * $ratable;


							$html .= "<tr>
									<td>".$property->dateadded."</td>
									<td></td>
									</tr>";
						endif;

			$html .="
					</table>
					</td>
				</tr>
			</table>
			";
			endforeach;
			
		//$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("Conrad");
		$pdf->SetTitle("test");
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
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->Output('test.pdf', 'I');
		
		endif;
	}

	function all_clients()
	{
		$data['clients'] = $this->_users->clients(2);
		$this->load->view("User/clients",$data);
	}

	function deposit()
	{
		$data['properties'] = $this->_properties->view();
		if(!empty($_POST)):
			//save deposit entrys
			$deposit = array(
				"property_id" =>$this->input->post("property_id"),
				"amount" => $this->input->post("deposit_amount"),
				"financial_year" =>$this->input->post("financial_year"),
				"author" =>$this->session->userid,
				"details" =>$this->input->post("details")
			);

			$data['msg'] = ($this->_properties->deposit($deposit))? TRUE : FALSE;
			
		endif;
		$this->load->view("User/deposit",$data);
	}
}