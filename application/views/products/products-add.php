add<!DOCTYPE html>
<html lang="en">
	<head>

		<?php $this->load->view("include/head"); ?>
		
<style type="text/css">
	.rem-btn{
		   /* position: relative;
    top: 0px;
    left: 1px;*/
	}
</style>
		<!-- Internal Summernote css-->
		<link rel="stylesheet" href="<?php echo ASSETS; ?>assets/plugins/summernote/summernote-bs4.css">
	</head>

	<body class="main-body leftmenu">

		<!-- Loader -->
		<div id="global-loader">
			<img src="<?php echo ASSETS; ?>assets/img/loader.svg" class="loader-img" alt="Loader">
		</div>
		<!-- End Loader -->

		<!-- Page -->
		<div class="page">

			<?php $this->load->view("include/sidemenu"); ?>


			<?php $this->load->view("include/header"); ?>

			

			<!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Products</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
									<li class="breadcrumb-item " >Products</li>
									<li class="breadcrumb-item active"  aria-current="page">Add Product</li>
								</ol>
							</div>
							<div class="d-flex">
								<div class="justify-content-center">
									
									
								</div>
							</div>
							
						</div>
					

						<!-- Row -->
						<div class="row row-sm">
							<div class="col-md-12">
								<?php if($this->session->flashdata('error')){ ?>
								<div class="alert alert-danger" role="alert">
										<button aria-label="Close" class="close" data-dismiss="alert" type="button">
											<span aria-hidden="true">&times;</span>
										</button>
									<?php echo $this->session->flashdata('error'); ?>
								</div>
								<?php } ?>

								<?php if($this->session->flashdata('success')){ ?>
								<div class="alert alert-success" role="alert">
									<button aria-label="Close" class="close" data-dismiss="alert" type="button">
										<span aria-hidden="true">&times;</span>
									</button>
									<?php echo $this->session->flashdata('success'); ?>
								</div>
								<?php } ?>
							</div>
							
								<div class="col-lg-12">
									<form action="<?php echo base_url(); ?>Product/add_product" method="POST" enctype="multipart/form-data" id="myForm">
										<div class="card custom-card">
											<div class="card-body">
												<div class="row row-sm">
													<div class="col-md-12">
														<div class="form-group">
															<p class="mg-b-10">Product Name</p>
															<input type="text" class="form-control " name="product_name" id="product_name" placeholder="Product Name" value="<?php if(isset($product)){ echo $product['name'];} ?>">
															<?php if(isset($product)){ ?>
															<input type="hidden" class="form-control " name="id" id="id" placeholder="Product Name" value="<?php if(isset($product)){ echo $product['id'];} ?>">
														<?php } ?>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<p class="mg-b-10">Short Description</p>
															<textarea rows="3" class="form-control " name="short_description" id="short_description" placeholder="Short Description"  ><?php if(isset($product)){ echo $product['short_description'];} ?></textarea>
														</div>
													</div>
													<!-- <div class="col-md-12"> -->
														<div class="col-md-4">
															<div class="form-group">
																<p class="mg-b-10">Categories</p>
																<select name="category_id" id="category_id" class="form-control select2">
																	<option value="0">Select Category</option>
																	<?php foreach ($categories as $cat) { ?>
																		
																	<option value="<?php echo $cat['id']; ?>" <?php if(isset($product) && $product['category_id'] == $cat['id']){ echo 'selected'; } ?> ><?php echo $cat['name']; ?></option>
																	<?php } ?>
																</select>
																
															</div>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<p class="mg-b-10">Tags (used for better search result)</p>
																<input type="text" class="form-control " name="tags" id="tags" placeholder="Tags (comma seperated)" value="<?php if(isset($product)){ echo $product['tags'];} ?>">
																
															</div>
														</div>
													<!-- </div> -->

												</div>
												<div class="row row-sm">
													
												</div>
												<div class="row row-sm">
													<div class="col-md-4">
														<div class="form-group">
															<p class="mg-b-10">Tax</p>
															<select name="tax_id" id="tax_id" class="form-control select2">
																<option value="0">Select Tax</option>
																<?php foreach ($taxes as $tax) { ?>
																	
																<option value="<?php echo $tax['id']; ?>"  <?php if(isset($product) && $product['tax_id'] == $tax['id']){ echo 'selected'; } ?> ><?php echo $tax['tax_name']; ?></option>
																<?php } ?>
															</select>
															
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<p class="mg-b-10">Indicator</p>
															<select name="indicator" id="indicator" class="form-control select2">
																<option value="none" <?php if(isset($product) && $product['tax_id'] == 'none'){ echo 'selected'; } ?> >None</option>
																<option value="veg" <?php if(isset($product) && $product['tax_id'] == 'veg'){ echo 'selected'; } ?> >Veg</option>
																<option value="non veg" <?php if(isset($product) && $product['tax_id'] == 'non veg'){ echo 'selected'; } ?> >Non veg</option>
															</select>
															
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<p class="mg-b-10">Country Of Origin</p>
															<input type="text" class="form-control " name="made_in" id="made_in" placeholder="Made In Country" value="<?php if(isset($product)){ echo $product['made_in'];} ?>">
															
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<p class="mg-b-10">Guarantee/Waranty text</p>
															<input type="text" class="form-control " name="warantry_guarantte_text" id="warantry_guarantte_text" placeholder="Made In Country" value="<?php if(isset($product)){ echo $product['warranty_guarantte_text'];} ?>">
															
														</div>
													</div>
													
												</div>

												<div class="row row-sm">
													<div class="col-md-3">
														

														<div class="form-group">
															<p class="mg-b-10">Is Latest product ?</p>
															<?php if(!empty($product['latest_product'])){?>
															<label class="custom-switch">
																<span class="custom-switch-description">NO</span> 
																<input type="checkbox" name="latest_product" class="custom-switch-input" checked>
																<span class="custom-switch-indicator"></span>
																<span class="custom-switch-description">Yes</span>
															</label>
														<?php }else{ ?>
															<label class="custom-switch">
																<span class="custom-switch-description">NO</span> 
																<input type="checkbox" name="latest_product" class="custom-switch-input" >
																<span class="custom-switch-indicator"></span>
																<span class="custom-switch-description">Yes</span>
															</label>
														<?php } ?>
															
														</div>
													</div>
													
													<div class="col-md-3">
														
														<div class="form-group">
															<p class="mg-b-10">Is Best Seller ?</p>
															<?php if(!empty($product['best_seller'])){?>
															<label class="custom-switch">
																<span class="custom-switch-description">NO</span> 
																<input type="checkbox" name="best_seller" class="custom-switch-input" checked>
																<span class="custom-switch-indicator"></span>
																<span class="custom-switch-description">Yes</span>
															</label>
														<?php }else{ ?>
															<label class="custom-switch">
																<span class="custom-switch-description">NO</span> 
																<input type="checkbox" name="best_seller" class="custom-switch-input" >
																<span class="custom-switch-indicator"></span>
																<span class="custom-switch-description">Yes</span>
															</label>
														<?php } ?>
															
														</div>
															
														
													</div>

													<div class="col-md-3">
														

														<div class="form-group">
															<p class="mg-b-10">Is Product On Sale ?</p>
															<?php if(!empty($product['pro_on_sale'])){?>
															<label class="custom-switch">
																<span class="custom-switch-description">NO</span> 
																<input type="checkbox" name="pro_on_sale" class="custom-switch-input" checked>
																<span class="custom-switch-indicator"></span>
																<span class="custom-switch-description">Yes</span>
															</label>

														<?php }else{ ?>

															<label class="custom-switch">
																<span class="custom-switch-description">NO</span> 
																<input type="checkbox" name="pro_on_sale" class="custom-switch-input">
																<span class="custom-switch-indicator"></span>
																<span class="custom-switch-description">Yes</span>
															</label>

														<?php } ?>
															
														</div>
													</div>

													<div class="col-md-3">
														<div class="form-group">
															<p class="mg-b-10">Is Featured Product ?</p>
															<?php if(!empty($product['featured_pro'])){?>
															<label class="custom-switch">
																<span class="custom-switch-description">NO</span> 
																<input type="checkbox" name="featured_pro" class="custom-switch-input" checked>
																<span class="custom-switch-indicator"></span>
																<span class="custom-switch-description">Yes</span>
															</label>

														<?php }else{ ?>
															<label class="custom-switch">
																<span class="custom-switch-description">NO</span> 
																<input type="checkbox" name="featured_pro" class="custom-switch-input">
																<span class="custom-switch-indicator"></span>
																<span class="custom-switch-description">Yes</span>
															</label>
														<?php } ?>
															
														</div>
													</div>
												
													
												</div>
												<div class="row row-sm">
													<div class="col-md-6">
														<div class="form-group" >
															<p class="mg-b-10">Main Image</p>
															<input type="text" readonly="" class="form-control " name="path" id="path"  value="<?php if(isset($product)){ echo $product['image'];} ?>" >
															<br>
															<a class="btn ripple btn-secondary" data-target="#scrollmodal" data-toggle="modal" href="" onclick="setCurrentFlag('main')">Select Image</a>
														</div>
														
													</div>
													<div class="col-md-6">
														<div class="form-group row justify-content-center mb-0">
															 <?php if(isset($product)){  ?>

															<img  id="img-preview" src="<?php echo base_url().$product['image']; ?>" height="75">
															 	<?php }else{ ?>
															<img src="" id="img-preview" style="display:none" height="75">
															 	<?php } ?>
														</div>
														
													</div>
												</div>
												<div class="row row-sm">
													<div class="col-md-6">
														<div class="form-group" >
															<p class="mg-b-10">Extra Images</p>
															
															<br>
															<a class="btn ripple btn-secondary" data-target="#scrollmodal" data-toggle="modal" href="" onclick="setCurrentFlag('extra')">Select Image</a>
														</div>
														
													</div>
													<div class="col-md-6" id="extra-images">
														<?php if(isset($product)){ 
											$extra_image_array = json_decode($product['other_images']);
															 	foreach($extra_image_array as $extra){

															  ?>
															  <div class="col-sm-4" > <button class="rem-btn" type="button">X</button><img  id="img-preview1" src="<?php echo base_url().$extra; ?>" height="75"><input type="hidden" name="extra_images[]" value="<?php echo $extra; ?>"></div>
															
															 	
															 	<?php } } ?>
														
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<p class="mg-b-10">Product Type </p>
															<select name="type" id="type" class="form-control select2">
																<option value="simple_product" <?php if(isset($product) && $product['type'] == 'simple_product'){ echo 'selected'; } ?>>Simple</option>
																<option value="variable_product" <?php if(isset($product) && $product['type'] == 'variable_product'){ echo 'selected'; } ?>>Variable</option>
															</select>
															
														</div>
														
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<p class="mg-b-10">Page Title </p>
															<textarea class="form-control"  name="page_title" rows="3"><?php if(isset($product)){ echo $product['page_title'];} ?></textarea>
															
														</div>
														
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<p class="mg-b-10">Meta Tags </p>
															<textarea class="form-control"  name="meta_tags" rows="3"><?php if(isset($product)){ echo $product['meta_tags'];} ?></textarea>
															
														</div>
														
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<p class="mg-b-10">Meta Description </p>
															<textarea class="form-control"  name="meta_description" rows="3"><?php if(isset($product)){ echo $product['meta_description'];} ?></textarea>
															
														</div>
														
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<p class="mg-b-10">Product Description </p>
															<textarea id="product_description" name="product_description"><?php if(isset($product)){ echo $product['description'];} ?></textarea>
															
														</div>
														
													</div>
												</div>
												<div class="form-group row justify-content-end mb-0">
														<div class="col-md-8 pl-md-2">
															<input type="hidden" name="current_image_section" id="current_image_section">
															<button class="btn ripple btn-secondary pd-x-30" type="reset">Cancel</button>
															<button class="btn ripple btn-primary pd-x-30 mg-r-5" type="submit">Submit</button>
														</div>
													</div>
											</div>
										</div>
									</form>
							</div>

						</div>
						<!-- End Row -->

						
					</div>
				</div>
			</div>
			<!-- End Main Content-->

			<!-- Scroll with content modal -->
			<div class="modal" id="scrollmodal">
				<div class="modal-dialog modal-dialog-scrollable" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">Select Image</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<table class="table table-stripped table-bordered">
								<?php foreach($media as $m){ ?>
								<tr>
									<td>
										<img src="<?php echo base_url().$m['path']; ?>" height="75">
										<?php echo $m['title']; ?>
									</td>
									<td>
										<button class="btn btn-success" onClick="selectImage('<?php echo $m['id']; ?>','<?php echo $m['path']; ?>')">Select</button>
									</td>
								</tr>
							<?php } ?>
							</table>
						</div>
						<div class="modal-footer">
							<!-- <button class="btn ripple btn-primary" type="button">Save changes</button> -->
							<button class="btn ripple btn-info" data-dismiss="modal" type="button">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!--End Scroll with content modal -->

			<?php $this->load->view("include/footer"); ?>
			<?php $this->load->view("include/leftsidemenu"); ?>

			

		</div>
		<!-- End Page -->

		<?php $this->load->view("include/script"); ?>
		<!-- Internal Summernote js-->
		<script src="<?php echo ASSETS; ?>assets/plugins/summernote/summernote-bs4.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){
				$("#myForm").validate({
					rules: {
						category_name: {
							required: true,
						},
						path: {
							required: true,
						},
						order: {
							required: true,
							number: true,
							min: 1,
						}
					}
				});

				$('.select2').select2({
					placeholder: 'Choose one',
					searchInputPlaceholder: 'Search',
					 width: '100%'
				});
				$('#product_description').summernote({
					placeholder: 'Product Description',
					tabsize: 3,
					height: 300
				});
			})
			function selectImage(id,path){
				var flg = $("#current_image_section").val();
				console.log(flg)
					$("#scrollmodal").modal("hide");
				if(flg == 'main'){
					$("#img-preview").attr("src","<?php echo base_url(); ?>"+path);
					$("#img-preview").show();
					$("#path").val(path);
				}else if(flg == 'extra'){
					$("#extra-images").append('<div class="col-sm-4" > <button class="rem-btn" type="button">X</button><img  id="img-preview1" src="<?php echo base_url(); ?>'+path+'" height="75"><input type="hidden" name="extra_images[]" value="'+path+'"></div>');
					// $("#img-preview").show();
					// $("#path").val(path);
				}
			}
			function setCurrentFlag(path){
				$("#current_image_section").val(path);
			}
			function removeDiv(div){
				$("#"+div).remove()
			}
		</script>

	</body>
</html>