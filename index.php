<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Example of IDML</title>
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
		<style type="text/css">
		body { padding-top: 50px; }
		</style>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">BaseX IDML Proof of Concept</a>
				</div>
			</div>
		</div>

		<div class="container">
			<div>
				<h1>Prepare to be amazed.</h1>
			</div>
			<form enctype="multipart/form-data" action="upload.php" method="POST" role="form">
				<input type="hidden" name="MAX_FILE_SIZE" value="512000" />
				<div class="form-group">
					<label for="idml_file">Upload an IDML File</label>
					<input type="file" class="form-control" id="idml_file" name="idml_file">
  				</div>
				<button type="submit" class="btn btn-primary">Upload</button>
			</form>
		</div>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>	</head>
	</body>
</html>