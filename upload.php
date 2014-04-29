<?php
include "BaseXClient.php";

$uploaddir = dirname(__FILE__) . '/upload/';

$uploadfile = $uploaddir . basename($_FILES['idml_file']['name']);
if (!move_uploaded_file($_FILES['idml_file']['tmp_name'], $uploadfile)) {
	die("Upload Failed.");
}
$idmlname = basename($_FILES['idml_file']['name'], '.idml');
$idmldir = dirname(__FILE__) . '/idml/' . $idmlname;
mkdir($idmldir, 0755, true);
$zip = new ZipArchive;
$res = $zip->open($uploadfile);
if ($res !== true) {
	die ("Unzip failed");
}
$zip->extractTo($idmldir);
$zip->close();
try {
	// create session
	$session = new Session("localhost", 1984, "admin", "admin");

	try {
		$query = $session->query($cmd);
		$session->execute("CREATE DATABASE $idmlname $idmldir");
		header('location:edit.php?db=' . $idmlname);
	} catch (Exception $e) {
		print ('create exception: ');
		print $e->getMessage();
	}
	$query->close();
	$session->close();
} catch (Exception $e) {
	print ('session exception: ');
	print $e->getMessage();
} 
