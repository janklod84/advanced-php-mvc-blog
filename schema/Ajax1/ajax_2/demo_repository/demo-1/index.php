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
	
 <h1>PHP & Ajax</h1>
 <hr>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
       
     $.ajax({
        type: 'GET',
        url: 'test.php',
        dataType: 'json',
        beforeSend: function () {
           console.log('Sending...');
        },
        success: function (results) {
           // $('body').append(results.name);
           $('body').append(results['age']);
        }
    });

</script>
</body>
</html>