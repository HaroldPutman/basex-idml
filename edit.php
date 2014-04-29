<?php
/*
 * This example shows how results from a query can be received in an iterative
 * mode and illustrated in a table.
 *
 * (C) BaseX Team 2005-12, BSD License
 */
include "BaseXClient.php";

$db = $_GET['db'];
// commands to be performed
$cmd = 'for $node in db:open("' . $db . '")//Story return <text id="{$node/@Self}">{data($node//CharacterStyleRange/Content)}</text>';
?>
<!doctype html>
<html>
	<head>
     	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Example of IDML</title>
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
	<body>
		<div class="container">
		<div class="row">
			<a href="<?php echo 'download.php?db=' . $db; ?>" class="btn btn-primary">Download IDML</a>
		</div>
<?php
echo $cmd;
try {
	// create session
	$session = new Session("localhost", 1984, "admin", "admin");

	try {
		$query = $session->query($cmd);
		$count = 0;
		while ($query->more()) {
			$next = $query->next();
			$xml = simplexml_load_string($next);
			$a = $xml->attributes();
			echo ('<form action="update.php?db=' . $db . '" class="well" role="form" method="post">' . PHP_EOL);
			echo ('  <input type="hidden" name="id" value="' . $a['id'] . '">' . PHP_EOL);
			echo ('  <div class="form-group"><textarea class="form-control" name="text">' . $xml[0] . '</textarea></div>' . PHP_EOL);
			echo ('  <button type="submit" class="btn btn-sm btn-default">Submit</button>');
			echo ('</form>');
		}
	} catch (Exception $e) {
		print $e->getMessage();
	}
	$query->close();
	$session->close();
} catch (Exception $e) {
	print $e->getMessage();
} ?>
		<div class="row">
			<a href="<?php echo 'download.php?db=' . $db; ?>" class="btn btn-primary">Download IDML</a>
		</div>
		</div>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>	</head>
	</body>
</html>