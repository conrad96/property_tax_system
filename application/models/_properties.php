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
		return ($this->db->insert("registered_properties",$data))? TRUE : FALSE;
	}
}