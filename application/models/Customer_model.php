<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

	
	public function getAllCustomer()
	{
		return $this->db->get("tbl_users")->result_array();
		
	}
}
