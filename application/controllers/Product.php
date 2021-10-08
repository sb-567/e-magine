<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(empty($this->session->userdata('id'))){
			redirect(base_url("Auth"));
		}
		$this->load->model("Product_model",'pm');
		$this->load->model("Media_model",'mm');
		$this->load->model("Category_model",'cm');
	}

	public function index()
	{
		// print_r($this->session->userdata());die;
		$data = array();
		$data['products'] = $this->pm->getAllProducts();	
		$this->load->view('products/products-list',$data);
	}
	public function add()
	{
		$data = array();
		$data['media'] = $this->mm->getAllMedia();
		$data['taxes'] = $this->common_model->getAllTaxes();
		$data['categories'] = $this->cm->getAllCategories();
		$this->load->view('products/products-add',$data);
	}
	public function add_product(){
		// echo "<pre>";
		// print_r($_POST);die;
		if(!empty($this->input->post('product_name'))){
		$this->load->helper('text');
		$this->load->helper('url');
		$slug = url_title(convert_accented_characters($this->input->post('product_name')), 'dash', true);

		if(!empty($this->input->post('id'))){

			if(($this->input->post('latest_product')==!null)){
				$product=1;
			}else{ 
				$product=0;
			}

			if(($this->input->post('best_seller')==!null)){
				$best_seller=1;
			}else{ 
				$best_seller=0;
			}

			if(($this->input->post('pro_on_sale')==!null)){
				$pro_on_sale=1;
			}else{ 
				$pro_on_sale=0;
			}

			if(($this->input->post('featured_pro')==!null)){
				$featured_pro=1;
			}else{ 
				$featured_pro=0;
			}	


	    	$ins = array(
	    		"category_id"=>$this->input->post('category_id'),
	    		"tags"=>$this->input->post('tags'),
	    		"tax_id"=>$this->input->post('tax_id'),
	    		"type"=>$this->input->post('type'),
	    		"name"=>$this->input->post('product_name'),
	    		"short_description"=>$this->input->post('short_description'),
	    		"latest_product"=>$product,
	    		"best_seller"=>$best_seller,
	    		"pro_on_sale"=>$pro_on_sale,
	    		"featured_pro"=>$featured_pro,
	    		"page_title"=>$this->input->post('page_title'),
	    		"meta_tags"=>$this->input->post('meta_tags'),
	    		"meta_description"=>$this->input->post('meta_description'),
	    		"description"=>$this->input->post('product_description'),
	    		"indicator"=>$this->input->post('indicator'),
	    		"image"=>$this->input->post('path'),
	    		"other_images"=>json_encode($this->input->post('extra_images')),
	    		"warranty_guarantte_text"=>$this->input->post('warantry_guarantte_text'),
	    		"made_in"=>$this->input->post('made_in'),
	    		"slug"=>$slug,
	    		"modified"=>date("Y-m-d H:i:s"),
	    	);
	    	$this->db->where("id",$this->input->post("id"));
	    	$this->db->update("tbl_products",$ins);
	    	$this->session->set_flashdata("success","Product Updated Successfully");
		}else{

			// $product=$this->input->post('latest_product');
			// $best_seller=$this->input->post('best_seller');
			// $pro_on_sale=$this->input->post('pro_on_sale');
			// $featured_pro=$this->input->post('featured_pro');

			if(($this->input->post('latest_product')==!null)){
				$product=1;
			}else{ 
				$product=0;
			}

			if(($this->input->post('best_seller')==!null)){
				$best_seller=1;
			}else{ 
				$best_seller=0;
			}

			if(($this->input->post('pro_on_sale')==!null)){
				$pro_on_sale=1;
			}else{ 
				$pro_on_sale=0;
			}

			if(($this->input->post('featured_pro')==!null)){
				$featured_pro=1;
			}else{ 
				$featured_pro=0;
			}			
				
			$ins = array(
	    		"category_id"=>$this->input->post('category_id'),
	    		"tags"=>$this->input->post('tags'),
	    		"tax_id"=>$this->input->post('tax_id'),
	    		"type"=>$this->input->post('type'),
	    		"name"=>$this->input->post('product_name'),
	    		"short_description"=>$this->input->post('short_description'),
	    		"latest_product"=>$product,
	    		"best_seller"=>$best_seller,
	    		"pro_on_sale"=>$pro_on_sale,
	    		"featured_pro"=>$featured_pro,
	    		"page_title"=>$this->input->post('page_title'),
	    		"meta_tags"=>$this->input->post('meta_tags'),
	    		"meta_description"=>$this->input->post('meta_description'),
	    		"description"=>$this->input->post('product_description'),
	    		"indicator"=>$this->input->post('indicator'),
	    		"image"=>$this->input->post('path'),
	    		"other_images"=>json_encode($this->input->post('extra_images')),
	    		"warranty_guarantte_text"=>$this->input->post('warantry_guarantte_text'),
	    		"made_in"=>$this->input->post('made_in'),
	    		"slug"=>$slug,
	    		"created"=>date("Y-m-d H:i:s"),
	    	);
	    	$this->db->insert("tbl_products",$ins);
	    	$this->session->set_flashdata("success","Product Added Successfully");
		}
		}else{
			$this->session->set_flashdata("error","Product Name cannot be empty");
		}
    	redirect(base_url("Product"));
                       
               
	}
	public function edit($id)
	{
		$data = array();
		$data['product'] = $this->pm->getSingleProduct($id);
		$data['media'] = $this->mm->getAllMedia();
		$data['taxes'] = $this->common_model->getAllTaxes();
		$data['categories'] = $this->cm->getAllCategories();
		$this->load->view('products/products-add',$data);
	}
	public function delete($id){
		$this->db->where("id",$id);
		$this->db->delete("tbl_products");
		$this->session->set_flashdata("success","Product Deleted Successfully");
		redirect(base_url("Product"));
	}
	public function variants($product_id){
		$data = array();
		$data['product'] = $this->pm->getSingleProduct($product_id);
		$data['variants'] = $this->pm->getProductVariants($product_id);
		$data['attributes'] = $this->pm->getProductAttributes($product_id);
		$data['all_attributes'] = $this->db->get("tbl_attributes")->result_array();
		$this->load->view('products/products-variant-attributes',$data);
	}
	public function add_attribute(){
		$product_id = $this->input->post("product_id");
		$attribute_id = $this->input->post("attribute_id");

		if(!empty($this->input->post("product_attribute_id"))){
			$product_attribute_id = $this->input->post("product_attribute_id");
			$ins = array(
				'attribute_id'=>$this->input->post("attribute_id"),
				'value'=>$this->input->post("attribute_value"),
				'product_id'=>$this->input->post("product_id"),
			);
			$this->db->where("id",$product_attribute_id);
			$res = $this->db->update("tbl_product_attributes",$ins);
			if($res){
				$this->session->set_flashdata("success","Attribute Updated for product.");
			}else{
				$this->session->set_flashdata("error","Error while updating attribute");

			}

		}else{

			$check = $this->db->where("attribute_id",$attribute_id)->where("product_id",$product_id)->get("tbl_product_attributes")->num_rows();
			if($check > 0){
				$this->session->set_flashdata("error","Attribute already exist for product, Please update existing");
				redirect(base_url()."Product/variants/".$product_id);
			}

			$ins = array(
				'attribute_id'=>$this->input->post("attribute_id"),
				'value'=>$this->input->post("attribute_value"),
				'product_id'=>$this->input->post("product_id"),
			);
			$res = $this->db->insert("tbl_product_attributes",$ins);
				if($res){
				$this->session->set_flashdata("success","Attribute Added to product.");
			}else{
				$this->session->set_flashdata("error","Error while adding attribute to product");

			}

		}
		
		redirect(base_url()."Product/variants/".$product_id);
	}
	function delete_attribute($id,$product_id){
		$this->db->where("id",$id);
		$this->db->delete("tbl_product_attributes");
		$this->session->set_flashdata("success","Product Attribute Deleted Successfully");
		redirect(base_url("Product/variants/".$product_id));
	}
	function add_Variant(){
		$product_id = $this->input->post("product_id");

		if(!empty($this->input->post("product_variant_id"))){
			$product_variant_id = $this->input->post("product_variant_id");
			$ins = array(
				'set_attribute'=>$this->input->post("set_attribute"),
				'variant_text'=>$this->input->post("variant_text"),
				'price'=>$this->input->post("price"),
				'special_price'=>$this->input->post("special_price"),
				'sku'=>$this->input->post("sku"),
				'stock'=>$this->input->post("stock"),
				'product_id'=>$this->input->post("product_id"),
			);
			$this->db->where("id",$product_variant_id);
			$res = $this->db->update("tbl_product_variants",$ins);
			if($res){
				$this->session->set_flashdata("success","Variant Updated for product.");
			}else{
				$this->session->set_flashdata("error","Error while updating variant");

			}

		}else{

			

			$ins = array(
				'set_attribute'=>$this->input->post("set_attribute"),
				'variant_text'=>$this->input->post("variant_text"),
				'price'=>$this->input->post("price"),
				'special_price'=>$this->input->post("special_price"),
				'sku'=>$this->input->post("sku"),
				'stock'=>$this->input->post("stock"),
				'product_id'=>$this->input->post("product_id"),
			);
			$res = $this->db->insert("tbl_product_variants",$ins);
				if($res){
				$this->session->set_flashdata("success","Variant Added to product.");
			}else{
				$this->session->set_flashdata("error","Error while adding Variant to product");

			}

		}
		
		redirect(base_url()."Product/variants/".$product_id);
	}
	function delete_variant($id,$product_id){
		$this->db->where("id",$id);
		$this->db->delete("tbl_product_variants");
		$this->session->set_flashdata("success","Product Variant Deleted Successfully");
		redirect(base_url("Product/variants/".$product_id));
	}

}
