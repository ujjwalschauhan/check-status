<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>userform</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../style.css">
</head>
<nav class="navbar">
        <a class="navbar-brand" href="/includes/index.php"><img src="/includes/circle-cropped.png" alt="todoLogo" width="30px" height="30px"></a>
    </nav>
<body>
    <div class="container-fluid">
    <div style="margin: auto;width: 60%;">
	<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>
	<form id="fupForm" name="form1" method="post">
		<div class="form-group">
			<label for="name">Name:</label>
			<input type="text" class="form-control" id="name" placeholder="Name" name="name">
        </div>
        
		<div class="form-group">
			<label for="email">Email:</label>
			<input type="email" class="form-control" id="email" placeholder="Email" name="email">
        </div>
        
		<div class="form-group">
			<label for="phone">Phone:</label>
			<input type="text" class="form-control" id="phone" placeholder="Phone" name="phone">
        </div>
        
		<div class="form-group" >
			<label for="city">City:</label>
			<select name="city" id="city" class="form-control">
				<option value="">Select</option>
				<option value="Delhi">Delhi</option>
				<option value="Mumbai">Mumbai</option>
				<option value="Pune">Pune</option>
			</select>
        </div>

        <div class="form-group" >
			<label for="role">Choose your role:</label>
			<select name="role" id="role" class="form-control">
				<option value="">Select</option>
				<option value="Developer">Developer</option>
				<option value="Tester">Tester</option>
				<option value="Network Administrator">Network Administrator</option>
			</select>
        </div>

		<input type="button" name="save" class="btn btn-primary" value="Save to database" id="butsave">
		<div class="form-group">
		<?php include("view.php"); ?>
		</div>
	</form>
</div>
    </div>


<script>
$(document).ready(function() {
	$('#butsave').on('click', function() {
		$("#butsave").attr("disabled", "disabled");
		var name = $('#name').val();
		var email = $('#email').val();
		var phone = $('#phone').val();
        var city = $('#city').val();
        var role = $('#role').val();
		if(name!="" && email!="" && phone!="" && city!="" && role!=""){
			$.ajax({
				url: "save.php",
				type: "POST",
				data: {
					name: name,
					email: email,
					phone: phone,
                    city: city,
                    role: role,				
				},
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$("#butsave").removeAttr("disabled");
						$('#fupForm').find('input:text').val('');
						$("#success").show();
						$('#success').html('Data added successfully !'); 						
					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
});

</script>
</body>
</html>