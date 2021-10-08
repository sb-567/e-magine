<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offer extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(empty($this->session->userdata('id'))){
			redirect(base_url("Auth"));
		}
		$this->load->model("Category_model",'cm');
		$this->load->model("Media_model",'mm');
	}

	public function index()
	{
		// print_r($this->session->userdata());die;
		$data = array();
		$dt =  $this->getOffer();	
		if($dt){$data['offer'] =$dt;}
		$this->load->view('offer/offer-add',$data);
	}
	public function add()
	{
		$data = array();
		$data['media'] = $this->mm->getAllMedia();
		$data['categories'] = $this->cm->getCategories();
		$this->load->view('categories/categories-add',$data);
	}
	public function add_offer(){

		if(!empty($this->input->post('id'))){


	    	$ins = array(
	    		"text"=>$this->input->post('text'),
	    		"font_size"=>$this->input->post('font_size'),
	    		"modified"=>date("Y-m-d H:i:s"),
	    	);
	    	$this->db->where("id",$this->input->post("id"));
	    	$this->db->update("tbl_offer_text",$ins);
	    	$this->session->set_flashdata("success","Offer Updated Successfully");
		}else{
				$this->load->helper('text');
				$this->load->helper('url');
				$slug = url_title(convert_accented_characters($this->input->post('category_name')), 'dash', true);
			$ins = array(
	    		"text"=>$this->input->post('text'),
	    		"font_size"=>$this->input->post('font_size'),
	    		"modified"=>date("Y-m-d H:i:s"),
	    	);
	    	$this->db->insert("tbl_offer_text",$ins);
	    	$this->session->set_flashdata("success","Offer Added Successfully");
		}
    	redirect(base_url("Offer"));
                       
               
	}
	public function getOffer()
	{
		return $this->db->get("tbl_offer_text")->row_array();

	}
	public function delete($id){
		$this->db->where("id",$id);
		$this->db->delete("tbl_categories");
		$this->session->set_flashdata("success","Category Deleted Successfully");
		redirect(base_url("Categories"));
	}

}
