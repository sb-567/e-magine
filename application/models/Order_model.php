<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

	
	public function getAllOrder()
	{
		$this->db->select("o.*,u.username as customer_name");
		$this->db->order_by("id","DESC");
		$this->db->join("tbl_users u","u.id=o.user_id","left");
		return $this->db->get("tbl_orders o")->result_array();
		
	}
	public function getCategories(){
		return $this->db->where('parent_id','0')->get("tbl_categories")->result_array();
	}
	function getSingleCategory($id){
			$this->db->where("id",$id);
		return $this->db->get("tbl_categories")->row_array();
	}
	public function getAllOrderDetails($order_id)
	{
		// $this->db->select("o.*,u.username as customer_name");
		$this->db->where("order_id",$order_id);
		$this->db->order_by("id","ASC");
		return $this->db->get("tbl_order_details")->result_array();
		
	}
	function getOrderDetailbyid($order_id){
			// $this->db->select("id");
			$this->db->where("id",$order_id);
		return $this->db->get("tbl_orders")->result_array();
	}
}
