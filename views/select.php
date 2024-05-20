<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Crud Application - Student List</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css' ?>">
</head>
<body>
	<div class="navbar navbar-dark bg-dark">
		<div class="container">
			<a href="#" class="navbar-brand">CRUD APPLICATION</a>
		</div>
	</div>
	
	<div class="container" style="padding-top: 15px;">
		<div class="row">
			<div class="col-md-12">
				<?php  
					$success = $this->session->userdata('success');
					if($success !=""){
					?>
					<div class="alert alert-success"><?php echo $success; ?></div>
					<?php 
					}
				?>
				<?php  
					$failure = $this->session->userdata('failure');
					if($failure !=""){
					?>
					<div class="alert alert-success"><?php echo $failure; ?></div>
					<?php 
					}
				?>
			</div>
		</div>
        <div class="row">
			<div class="col-10"><h3>Students List</h3></div>
			<div class="col-2">
				<a href="<?php echo base_url().'index.php/student/create';?>" class="btn btn-primary">Create</a>
			</div>
		</div>
		<hr>
    	<div class="row">
     		<div class="col-md-12">
     			<table class="table table-striped" id="student_table">
					<thead>
						<tr>
							<th>SrNo.</th>
							<th>FirstName</th>
							<th>LastName</th>
							<th>Country</th>
							<th>State</th>
							<th>City</th>
							<th>Email</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
							
					</tbody>
				</table>
     		</div>
     	</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var table = $('#student_table').DataTable({
				"ajax" : "<?php echo site_url('student/get_students'); ?>",
				"type":"post",
				"columns": [
		            { 
		            	"data": null,
			            "render": function(data, type, full, meta) {
			                return meta.row + 1;
			            } 
		            },
		            { "data": "FirstName" },
		            { "data": "LastName" },
		            { "data": "Email" },
		            { "data": "CountryName" },
		            { "data": "StateName" },
		            { "data": "CityName" },
		            { 
		            	"data": "Id",
		            	"render": function(data) {
		              	var actionData='<a href="update/'+data+'" class="btn btn-success" style="margin-right:10px;">Update</a>';
		              		actionData += '<a href="#" onclick="confirmDelete('+data+')" class="btn btn-danger">Update</a>';
	                  	return actionData;
		              }
		            }
		        ]
			});
		});
		
		function confirmDelete(id) {
	        if (confirm('Are you sure you want to delete this record?')) {
	            window.location.href = 'delete/' + id; // Redirect to the delete URL
	        }
	    }
	</script>
</body>
</html>