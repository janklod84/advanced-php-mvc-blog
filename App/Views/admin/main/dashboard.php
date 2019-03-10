<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="<?= assets('/admin/bootstrap/css/bootstrap.min.css'); ?>">
</head>
<body>
	
<div class="container" style="margin-top: 30px;">
	 <h1 class="text-center">Dashboard</h1>
	 <div class="row">
	 	 <div class="col-md-4 col-md-offset-4">
		 	 <form action="<?php echo url('/admin/submit'); ?>" method="post" enctype="multipart/form-data">
				 <div class="form-group">
				 	 <label for="">Email</label>
				     <input type="text" name="email" class="form-control">
				 </div>
				 <div class="form-group">
				 	 <label for="">Password</label>
				     <input type="password" name="password" class="form-control">
				 </div>
				 <div class="form-group">
				 	<label for="">Confrim Password</label>
				    <input type="password" name="confirm_password" class="form-control">
				 </div>
				 <div class="form-group">
				 	<label for="">Full Name</label>
				    <input type="text" name="fullname" class="form-control">
				 </div>
				 <div class="form-group">
				 	 <input type="file" name="image" class="form-control">
				 </div>
				 <button class="btn btn-primary">Send</button>
			</form>
	 	 </div> <!-- end col-md-4 -->
	 </div> <!-- end row -->
</div>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
	/*
  $('form').on('submit' , function(e){
        e.preventDefault();
         
        var form = $(this);
        var sentData = new FormData(form[0]);

        $.ajax({
           url: form.attr('action'),
           type: 'post',
           data: sentData,
           dataType: 'json',
           success: function(response){
           	   $('body').append(response.name);
           },
           cache: false,
           processData: false,
           contentType: false,
        });
  });
*/
</script>
</body>
</html>

<!--
<script src="https://code.jquery.com/jquery-3.3.1.js"
integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
crossorigin="anonymous"></script>
-->