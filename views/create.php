<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Crud Application - Create Student</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css' ?>">
	<style type="text/css">
		.form-group{
			padding-top: 10px;
		}
	</style>
</head>
<body>
	<div class="navbar navbar-dark bg-dark">
		<div class="container">
			<a href="#" class="navbar-brand">CRUD APPLICATION</a>
		</div>
	</div>
	<div class="container" style="padding-top: 15px;">
		<h3>Registration Form</h3>
        <hr>
        <form method="POST" name="creaStudent" action="<?php echo base_url().'index.php/student/create';?>">
        	<div class="row">
	     		<div class="col-md-6">
	     			<div class="form-group">
		                <label for="first_name">First Name:</label>
		                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo set_value('first_name'); ?>">
		                <?php echo form_error('first_name'); ?>
		            </div>
		            <div class="form-group">
		                <label for="last_name">Last Name:</label>
		                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo set_value('last_name'); ?>">
		                <?php echo form_error('last_name'); ?>
		            </div>
		            <div class="form-group">
		                <label for="email">Email:</label>
		                <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>">
		                <?php echo form_error('email'); ?>
		            </div>
		            <div class="form-group">
		                <label for="country">Country:</label>
		                <select class="form-control" id="country" name="country">
		                    <option value="">--Select Country--</option>
    						
    						<?php foreach ($countries as $country): ?>
					            <option value="<?php echo $country['CountryId']; ?>" <?php echo set_select('country', $country['CountryId'], ($country == $country['CountryId'])); ?> >
    							<?php echo $country['CountryName']; ?>
    						</option>
					        <?php endforeach; ?>

		                </select>
		                <?php echo form_error('country'); ?>
		            </div>
		            <div class="form-group">
		                <label for="state">State:</label>
		                <select class="form-control" id="state" name="state"></select>
		                <?php echo form_error('state'); ?>
		            </div>
		            <div class="form-group">
		                <label for="city">City:</label>
		                <select class="form-control" id="city" name="city"></select>
		                <?php echo form_error('city'); ?>
		            </div>
		            <div class="form-group">
		                <button class="btn btn-primary">Submit</button>
		                <a href="<?php echo base_url().'index.php/student/index';?>" class="btn btn-secondary">Cancel</a>
		            </div>
	        	</div>
     		</div> 
        </form>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
	    $(document).ready(function(){
	        $('#country').change(function(){
	        	
	            var country_id = $(this).val();
	            if(country_id != ''){
	                $.ajax({
	                    url: "<?php echo base_url('index.php/student/get_states_by_country');?>",
	                    method: "POST",
	                    data: {country_id:country_id},
	                    dataType : 'json',
	                    success:function(data){
	                        $('#state').empty();
	                        $('#state').append('<option value="">--Select State--</option>');
			                
			                for (var i = 0; i < data.length; i++) {
							    
							    $('#state').append('<option value="'+data[i].StateId+'">'+data[i].StateName+'</option>');
							}
	                    }
	                    
	                });
	            }
	        });

	        $('#state').change(function(){
	            var state_id = $(this).val();
	            if(state_id != ''){
	                $.ajax({
	                    url: "<?php echo base_url('index.php/student/get_cities_by_state');?>",
	                    method: "POST",
	                    data: {state_id:state_id},
	                    dataType : 'json',
	                    success:function(data){
	                        $('#city').empty();
	                        $('#city').append('<option value="">--Select City--</option>');
			                for (var i = 0; i < data.length; i++) {
							    
							    $('#city').append('<option value="' + data[i].CityId + '">' + data[i].CityName + '</option>');
							}
	                    }
	                });
	            }
	        });
	    });
	</script>
</body>
</html>