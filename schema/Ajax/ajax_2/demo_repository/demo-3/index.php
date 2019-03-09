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
<?php 
 if(!empty($_POST))
 {
 	  /* a:2:{s:4:"name";s:4:"test";s:8:"password";s:6:"qwerty";} */
 	  // print_r(serialize($_POST));
 }
?>
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
     /* $('button').on('click'); */
     $('form').on('submit', function (e) {
     	  e.preventDefault();
          form = $(this);
          console.log(form.serialize());

          $.ajax({
	        type: 'POST',
	        url: 'test.php',
	        data: form.serialize(),
	        dataType: 'json',
	        beforeSend: function () {
	           // console.log('Sending...');
	           $('#results').html('sending...');
	           $('button').attr('disabled', true);
	        },
	        success: function (results) {
	           $('#results').html('');
	           $('body').append(results['password']);
	        }
         });

         return false;
     });
</script>
</body>
</html>