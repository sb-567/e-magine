<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {

	
	public function getAllMedia()
	{
		return $this->db->get("tbl_media")->result_array();
		
	}
	public function getSetting($variable,$jsonConvert = false)
	{
		$data =  $this->db->where("variable",$variable)->get("tbl_settings")->row_array();
		// return $data["value"];
		return $jsonConvert ? json_decode($data['value'],true) : $data['value'];
		
	}
	public function getAllTaxes(){
		return $this->db->get("tbl_taxes")->result_array();
	}
}
