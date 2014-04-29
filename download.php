<?php
include "BaseXClient.php";

$outpath = dirname(__FILE__) . '/download/';
$db = $_GET['db'];
$outdir = $outpath . $db;
mkdir($outdir, 0755, true);
$cmds = array(
	'SET EXPORTER omit-xml-declaration=no',
	'OPEN ' . $db,
	'EXPORT ' . $outdir,
	'CLOSE ');

function fillArrayWithFileNodes(DirectoryIterator $dir, $prefix = '') {
	$data = array();
	foreach ($dir as $node) {
		if ( $node->isDir() && !$node->isDot() ) {
			$data += fillArrayWithFileNodes( new DirectoryIterator( $node->getPathname() ), $node->getPathname() );
		} elseif ( $node->isFile() ) {
			$data[] = $prefix . '/' . $node->getFilename();
		}
	}
	return $data;
}

try {
	// create session
	$session = new Session("localhost", 1984, "admin", "admin");

	try {
		foreach ($cmds as $cmd) {
			$session->execute($cmd);
		}
		echo $outdir;
		$files = fillArrayWithFileNodes(new DirectoryIterator($outdir), $outdir);

		$zipname = "$db.idml";
		$zip = new ZipArchive;
		$zip->open($outpath . $zipname, ZipArchive::CREATE);
		foreach ($files as $entry) {
			$localname = substr($entry, strlen($outdir) + 1);
			$zip->addFile($entry, $localname);
		}
		$zip->close();

		header('Content-Type: application/zip');
		header('Content-Disposition: attachment; filename="' . $zipname . '"');
		header('Content-Length: ' . filesize($outpath . $zipname));
		header('Location: download/' . $zipname);
	} catch (Exception $e) {
		print $e->getMessage();
	}
	$session->close();
} catch (Exception $e) {
	print $e->getMessage();
}
