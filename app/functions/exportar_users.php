<?
	header('Content-Encoding: UTF-8');
	header("Content-type: application/vnd.ms-excel; name='excel'");
	header("Content-Disposition: filename=tablausers.xls");  
	header("Pragma: no-cache");  
	header("Expires: 0");
	print chr(255) . chr(254) . mb_convert_encoding($_POST['tablausers'], 'UTF-16LE', 'UTF-8');
	exit;
?>