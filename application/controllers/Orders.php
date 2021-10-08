<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(empty($this->session->userdata('id'))){
			redirect(base_url("Auth"));
		}
		$this->load->model("Order_model",'om');
	}

	public function index()
	{
		// print_r($this->session->userdata());die;
		$data = array();
		$data['orders'] = $this->om->getAllOrder();	
		$this->load->view('orders/orders-list',$data);
	}
	
	public function ajaxOrderDetails(){
		$order_id = $this->input->post("order_id");
		$order_data = $this->om->getAllOrderDetails($order_id);
		$str = "";
		$total = 0;

		foreach ($order_data as $ord) {
			$str.="<tr><td>".$ord['product_name']." - ".$ord['variant_name']."</td>";
			$str.="<td>".$ord['qty']."</td>";
			$str.="<td>".$ord['special_price']."</td>";
			$str.="<td>".$ord['total_special_price']."</td></tr>";
			$total +=$ord['total_special_price'];
		}
		$str.="<tr><td colspan='3' style='text-align:right'>Total</td><td>".number_format($total,2)."</td></tr>";

		echo $str;

	}

	public function status(){
		 $id = $this->input->post("id");
		 $status = $this->input->post("status");
		 
		 $order_data = $this->om->getOrderDetailbyid($id);
		  
		 
		
        
		if($order_data[0]['status'] == $status){
			$this->session->set_flashdata("error","Already Placed Successfully...");
		 redirect(base_url("Orders"));
		}
		if($order_data[0]['status'] == $status){
			$this->session->set_flashdata("error","Already Packed Successfully...");
		 redirect(base_url("Orders"));
		}
		if($order_data[0]['status'] == $status){
			$this->session->set_flashdata("error","Already Shipped Successfully...");
		 redirect(base_url("Orders"));
		}
		if($order_data[0]['status'] == $status){
			$this->session->set_flashdata("error","Already Delivered Successfully...");
		 redirect(base_url("Orders"));
		}


		$arr=array(
			'status'=>$status
		);
		
	
		 $this->db->where("id",$id);
		 $this->db->update("tbl_orders", $arr);
		 $this->session->set_flashdata("success","Status Updated Successfully...");
		 redirect(base_url("Orders"));
		

	}
	
	public function delete($id){
		$this->db->where("id",$id);
		$this->db->delete("tbl_orders");

		$this->db->where("order_id",$id);
		$this->db->delete("tbl_order_details");
		$this->session->set_flashdata("success","Product Deleted Successfully");
		redirect(base_url("Orders"));
	}

}
