<?

	header('Content-Encoding: UTF-8');
	header("Content-type: application/vnd.ms-excel; name='excel'");
	header("Content-Disposition: filename=Seguimiento_".date("d-m-Y").".xls");  
	header("Pragma: no-cache");  
	header("Expires: 0");
	print chr(255) . chr(254) . mb_convert_encoding($_POST['datatodisplay'], 'UTF-16LE', 'UTF-8');
	exit;

	// header('Content-Encoding: UTF-8');
	// header("Content-type: text/x-vcardl");
	// header("Content-Disposition: filename=listaemails".date("d-m-Y").".vcf");  
	// mb_convert_encoding($_POST['datatodisplay'], 'UTF-16LE', 'UTF-8');
	// exit;

?>