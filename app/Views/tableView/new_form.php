<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="manifest" href="/manifest.json">
    
    <?php $this->load->view("parts/header.php")?>
	<?php $this->load->view("parts/upup.php")?>
	<?php $this->load->view("parts/load.php")?>
</head>

<body id="page-top">

	<div id="wrapper">
	    
	    <div id="content-wrapper">

			<div class="container-fluid">
			    
			    <?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>
				
				<!-- Card  -->
				<div class="card mb-3">
					<div class="card-header">

						<a href="<?php echo site_url('ShareTarget/') ?>"><i class="fas fa-arrow-left"></i>
							Back</a>
					</div>
					<div class="card-body">

						<form action="" method="post" enctype="multipart/form-data">
						<!-- Note: atribut action dikosongkan, artinya action-nya akan diproses 
							oleh controller tempat vuew ini digunakan. Yakni index.php/admin/products/edit/ID --->

							<input type="hidden" name="id" value="<?php echo $product->id?>" />

							<div class="form-group">
								<label for="name">Name*</label>
								<input class="form-control <?php echo form_error('name') ? 'is-invalid':'' ?>"
								 type="text" name="name" placeholder="Product name" value="<?php echo $product->name ?>" />
								<div class="invalid-feedback">
									<?php echo form_error('name') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="price">Type</label>
								<input class="form-control <?php echo form_error('price') ? 'is-invalid':'' ?>"
								 type="number" name="price" min="0" placeholder="Product price" value="<?php echo $product->price ?>" />
								<div class="invalid-feedback">
									<?php echo form_error('price') ?>
								</div>
							</div>


							<div class="form-group">
								<label for="name">Image</label>
								<input class="form-control-file <?php echo form_error('image') ? 'is-invalid':'' ?>"
								 type="file" name="image" />
								<input type="hidden" name="old_image" value="<?php echo $product->image ?>" />
								<div class="invalid-feedback">
									<?php echo form_error('image') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="name">Created At*</label>
								<textarea class="form-control <?php echo form_error('description') ? 'is-invalid':'' ?>"
								 name="description" placeholder="Product description..."><?php echo $product->description ?></textarea>
								<div class="invalid-feedback">
									<?php echo form_error('description') ?>
								</div>
							</div>

							<input class="btn btn-success" type="submit" name="btn" value="Save" />
						</form>

					</div>

					<div class="card-footer small text-muted">
						* required fields
					</div>


				</div>
				
			</div>
		</div>

			<!-- /.container-fluid -->

			<!-- Sticky Footer -->
			<?php $this->load->view("parts/footer.php") ?>

		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->

    <script>
          window.addEventListener('load', () => {
            const parsedUrl = new URL(window.location);
            const { searchParams } = parsedUrl;
            console.log("Title shared:", searchParams.get('name'));
            console.log("Text shared:", searchParams.get('description'));
            console.log("URL shared:", searchParams.get('link'));
          });
        </script>
        <script>
            function handleFileShare(event){
            event.respondwith(Response.redirect('./'));
        
            event.waitUntil(async function(){
            const data = await event.request.fromData(); 
            const client = await self.clients.get(event.resultingClintId);
            const file = data.get('file');
            client.postMessage({file});
            }());
            }
        
            navigator.serviceWorkerContainer.onmessage = (event) =>{
            const file = event.data.file;}
        </script>

</body>

</html>
