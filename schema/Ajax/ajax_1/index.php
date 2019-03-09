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
	</style>
</head>
<body>
	
 <h1>PHP & Ajax</h1>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
	setTimeout(function () {
       
         $.ajax({
	        type: 'GET',
	        url: 'test.php',
	        beforeSend: function () {
	           console.log('Sending...');
	        },
	        success: function (results) {
	           $('body').append(results);
	        }
	    });

	}, 5000); // 5s (5000 ms)
	
   
	/*
	 xmlHttpRequest 
	 $.get()
	 $.post()
	 $.load()
	*/
</script>
</body>
</html>