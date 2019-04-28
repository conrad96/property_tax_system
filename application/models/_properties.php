<?php 
class _properties extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function property_types()
	{
		$sql = "
		SELECT pt.type as property_type,pc.code as property_code,pc.title as property_title FROM property_codes pc 
		INNER JOIN property_types pt ON pc.property_type_id = pt.id ";
		return $this->db->query($sql)->result();
	}

	function accomodation_breakdown()
	{
		$sql = "
		SELECT 
    		pt.type AS property_type,ab.code AS breakdown_code,ab.title AS accomodation_breakdown
    FROM accomodation_breakdown ab
		INNER JOIN property_types pt ON ab.property_type_id = pt.id";
		return $this->db->query($sql)->result();
	}

	function add($data)
	{
		if ($this->db->insert("registered_properties",$data)):
			//add client 
			if(!empty($data)):

				$content = json_decode($data['data']);

				$clientele = array(
				"client"=> $content->contact_title.' '.$content->surname_contact.' '.$content->firstname_contact,
				"physical_address"=> $content->county_owner.' '.$content->district_owner.' '.$content->subcounty_owner.' '.$content->parish_owner.' '.$content->village_owner,
				"contact"=>$content->mobile_phone,
				"registered_by"=>$this->session->userid
			);

				return ($this->db->insert("clients",$clientele))? TRUE : FALSE;
			endif;
			
		else:
			return FALSE;
		endif;
	}

	function edit($property_id,$data)
	{
		$this->db->where("id",$property_id);
		return $this->db->update("registered_properties",$data)? TRUE : FALSE;
	}

	function view()
	{
		$sql = "SELECT u.names as registered_by,rp.* FROM users u INNER JOIN registered_properties rp ON rp.author = u.id ";
		return $this->db->query($sql)->result();
	}

	function properties_counter()
	{
		return $this->db->get("registered_properties")->num_rows();
	}

	function records_counter()
	{
		return $this->db->get("registered_properties")->num_rows() + $this->db->get("clients")->num_rows() + $this->db->get("property_codes")->num_rows() + $this->db->get("property_types")->num_rows();
	}

	function get_property($property_id)
	{
		$sql = "SELECT * FROM registered_properties rp WHERE rp.id = '".$property_id."' ";
				
		return !empty($this->db->query($sql)->result())? $this->db->query($sql)->result() : array() ;
	}
}