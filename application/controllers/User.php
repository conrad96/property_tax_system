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
		$doc_title = "";

		if(!empty($property_details)):
			foreach($property_details as $property):
				$data = json_decode($property->data);
				$doc_title = str_replace(' ','_',$property->title);

				$html = "<table>
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
							";

						$html .= " 
							<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>Date: ".date("d/m/Y")."</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							";

						$html .= "
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
				";

				$html .= "
				<tr>
				<td>
					<table border='1.0' cellspacing='5'>
						<tr>
							<td><strong>Date</strong></td>
							<td><strong>Details</strong></td>
							<td><strong>Assessment</strong></td>
							<td><strong>Balance</strong></td>
						</tr>
						<tr>
						<td>&nbsp;</td>
						</tr>
						";

						//logic to calculate taxes
						if(!empty($data->numberof_units) && !empty($data->rent_amount)):
							$rentper_unit = $data->rent_amount;
							$annual = 12 * $rentper_unit * $data->numberof_units;
							$ratable = (80/100) * $annual;
							$tax = (4/100) * $ratable;

							//get deposited amount
							$deposited = $this->db->query("SELECT dp.amount as deposit,u.names as registered_by,dp.details,dp.dateadded FROM deposits dp INNER JOIN registered_properties rp INNER JOIN users u ON u.id = dp.author WHERE rp.id = '".$property->id."' ")->result();	

							if(!empty($deposited)):

								foreach($deposited as $deposit):

									$html .= "
									<tr>
									<td>".$deposit->dateadded."</td>
									<td colspan='2'>".$deposit->details."</td>
									<td>".$ratable."</td>
									<td>".($ratable - $deposit->deposit)."</td>
									</tr>
									";

								endforeach;
							endif;

						endif;

				$html .= "
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
		$pdf->SetTitle($doc_title);
		$pdf->SetSubject('Invoice');
		$pdf->SetKeywords('Invoice, PDF, Export');

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
		$pdf->writeHTML($html, true, false, false, false, '');

		$pdf->Output($doc_title.'.pdf', 'I');
		
		endif;
	}

	function export_excel($id)
	{
		$this->load->library("PHPExcel");

		$property_details = $this->_properties->get_property($id);
		$doc_title = "";
		$i = 8;

		if(!empty($property_details)):

			// Create new PHPExcel object
			$objPHPExcel = new PHPExcel();

			// Set document properties
			$objPHPExcel->getProperties()->setCreator("Conrad")
										->setLastModifiedBy("Conrad")
										->setTitle("Property Invoice Export")
										->setSubject("Property Sheet")
										->setDescription("Export Property Details")
										->setKeywords("Excel Sheet")
										->setCategory("Conrad");

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);

			// Add column headers
			$objPHPExcel->getActiveSheet()
						->setCellValue('A1', 'Property')
						->setCellValue('A2', 'Owner')
						->setCellValue('A3', 'Zone')
						->setCellValue('A4', 'Description')
						->setCellValue('A5', 'Val No.');

			$objPHPExcel->getActiveSheet()->mergeCells("A7:B7");
			$objPHPExcel->getActiveSheet()->mergeCells("D7:G7");
			$objPHPExcel->getActiveSheet()->mergeCells("D14:E14");

			$objPHPExcel->getActiveSheet()->setCellValue("A7","PROPERTY DETAILS");
			$objPHPExcel->getActiveSheet()->setCellValue("D7","PROPERTY TAXES");
			//property taxes fields
			$objPHPExcel->getActiveSheet()->setCellValue("D8","Rent Amount")
										  ->setCellValue("D9","Number of Units")
										  ->setCellValue("D10","Annual Total Rent")
										  ->setCellValue("D11","Taxable")
										  ->setCellValue("D12","Tax")
										  ->setCellValue("D14","Deposits")
										  ->setCellValue("D15","Date")
										  ->setCellValue("E15","Details")
										  ->setCellValue("F15","Assessment")
										  ->setCellValue("G15","Deposit(Ugx)")
										  ->setCellValue("H15","Balance");										  


			$bold_cell_style = array('fill' =>
													array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' =>
														array('rgb' => 'FFFF99'))
									);

			$taxes_cell_style = array('fill' =>
													array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' =>
														array('rgb' => '0080FF')),
									  'borders' => array(
								            'allborders' => array(
								                'style' => PHPExcel_Style_Border::BORDER_THIN,
								                'color' => array('rgb' => 'OOOOOO')
								            ))
									);


			$objPHPExcel->getActiveSheet()->getStyle('A1:A5')->applyFromArray($bold_cell_style);
			$objPHPExcel->getActiveSheet()->getStyle('A1:A5')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('D7:H20')->applyFromArray($taxes_cell_style);

			$objPHPExcel->getActiveSheet()->getStyle('A7:B7')->applyFromArray($bold_cell_style);
			$objPHPExcel->getActiveSheet()->getStyle("A7:B7")->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle("A7:B7")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle("D7:G7")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle("D14:E14")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			//set properties attributes

			foreach($property_details as $property):
				$doc_title = $property->title;
				$data = json_decode($property->data);

				if(!empty($data)):
					$objPHPExcel->getActiveSheet()->setCellValue('B1',$property->title)
												  ->setCellValue('B2',$data->surname_contact.' '.$data->firstname_contact)
												  ->setCellValue('B3',(!empty($data->parish_property) || !empty($data->village_property)? $data->parish_property.','.$data->village_property : "Not provided."  ))
												  ->setCellValue('B4',$data->property_type)
												  ->setCellValue('B5','502-0'.$property->id);

				//write properties attributes and values to active sheet
					
					foreach($data as $key=>$value):

						if(is_object($value)):

							foreach($value as $other):
								$str = implode(',', $other);
								$objPHPExcel->getActiveSheet()->setCellValue("A".$i,$key)
													  ->setCellValue("B".$i,$str);
							endforeach;
							
						else:
							$objPHPExcel->getActiveSheet()->setCellValue("A".$i,$key)
													  ->setCellValue("B".$i,$value);
						endif;
						
						$i++;
					endforeach;

					if(!empty($data->rent_amount) && !empty($data->numberof_units)):

						$rentper_unit = !empty($data->rent_amount)? $data->rent_amount : 0;
						$units = !empty($data->numberof_units)? $data->numberof_units : 0;
						$annual = 12 * $rentper_unit * $units;
						$ratable = (80/100) * $annual;
						$tax = (4/100) * $ratable;

						//get deposited amount
						$deposited = $this->db->query("SELECT dp.amount as deposit,u.names as registered_by,dp.details,dp.dateadded FROM deposits dp INNER JOIN registered_properties rp INNER JOIN users u ON u.id = dp.author WHERE rp.id = '".$property->id."' ")->result();	

						$objPHPExcel->getActiveSheet()->setCellValue("E8",$rentper_unit)
															  ->setCellValue("E9",$units)
															  ->setCellValue("E10",$annual)
															  ->setCellValue("E11",$ratable)
															  ->setCellValue("E12",$tax);

						if(!empty($deposited)):
							$k = 16;
	
							foreach($deposited as $deposit):
								
								$objPHPExcel->getActiveSheet()->setCellValue("D".$k,$deposit->dateadded)
															  ->setCellValue("E".$k,$deposit->details)
															  ->setCellValue("F".$k,$ratable)
															  ->setCellValue("G".$k,$deposit->deposit)
															  ->setCellValue("H".$k,($ratable - $deposit->deposit));

								$k++;
							endforeach;
						endif;

					endif;

				endif;

				$objPHPExcel->getActiveSheet()->getStyle('A8:A'.$i)->applyFromArray(
					array('fill' =>array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' =>
														array('rgb' => '99FFFF'))
									));
									  
			endforeach;

			// Set worksheet title
			$objPHPExcel->getActiveSheet()->setTitle($doc_title);

			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $doc_title . '.xls"');
			header('Cache-Control: max-age=0');

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');

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