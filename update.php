<?php
include "BaseXClient.php";
$db = $_GET['db'];

$cmd = 'replace value of node db:open("' . $db . '")//Story[@Self="' . $_POST['id'] . '"]//Content with "' . $_POST['text'] . '"';

try {
	// create session
	$session = new Session("localhost", 1984, "admin", "admin");

	try {
		$session->execute('XQUERY ' . $cmd);
	} catch (Exception $e) {
		print $e->getMessage();
	}
	$session->close();
} catch (Exception $e) {
	print $e->getMessage();
}
header('location:edit.php?db=' . $db);