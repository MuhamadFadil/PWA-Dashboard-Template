<?php

echo view('parts/header'); 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="manifest" href="/manifest.json">
</head>

<body id="page-top">

	<div id="wrapper">
	    
	    <div id="content-wrapper">

			<div class="container-fluid">

				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('ShareTarget/add') ?>"><i class="fas fa-plus"></i> Add New</a>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Name</th>
										<th>Type</th>
										<th>Image</th>
										<th>Created At</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($files as $product): ?>
									<tr>
										<td width="150">
											<?php echo $product->name ?>
										</td>
										<td>
											<?php echo $product->type ?>
										</td>
										<td>
											<img src="<?php echo base_url('uploads/files'.$product->image) ?>" width="64" />
										</td>
										<td class="small">
											<?php echo substr($product->created_at, 0, 120) ?>...</td>
										<td width="250">
											<a href="<?php echo site_url('ShareTarget/edit/'.$product->id) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
											<a onclick="deleteConfirm('<?php echo site_url('ShareTarget/delete/'.$product->id) ?>')"
											 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
										</td>
									</tr>
									<?php endforeach; ?>

								</tbody>
							</table>
						</div>
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
<?php

echo view('parts/footer'); 

?>