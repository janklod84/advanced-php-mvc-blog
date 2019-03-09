<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Php - Ajax</title>
	<style>
		body{
			font-family: Helvetica,arial, sans-serif;
			font-style: normal;
		}
		hr{border: 0; border-top: 1px solid #ccc; }
	</style>
</head>
<body>
<form action="" method="POST">
	<div id="results"></div>
	<div>
		<input type="text" name="name">
	</div>
	<div>
		<input type="password" name="password">
	</div>
	<button>Send</button>
</form>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
     
     var flag = false; // or flag = 0
     
     $('form').on('submit', function (e) {
     	  e.preventDefault();
          form = $(this);
          
          if(flag === true)
          {
          	  // alert('wait:/');
     	      return false;
          }
     
          $.ajax({
	        type: 'POST',
	        url: 'test.php',
	        data: form.serialize(),
	        dataType: 'json',
	        beforeSend: function () {
	           $('#results').html('sending...');
	           $('button').attr('disabled', true);
	           flag = true;
	        },
	        success: function (results) {
	           $('#results').html('');
	           $('body').append(results['password']);
	           flag = false;
	           $('button').removeAttr('disabled');
	        }
         });

         return false;
     });

</script>
</body>
</html>