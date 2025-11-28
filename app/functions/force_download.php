<?php
header("Content-type:application/pdf");

// It will be called downloaded.pdf
header("Content-Disposition:attachment;filename='".$_GET[nombre]."'");

// The PDF source is in original.pdf
readfile($_GET[file]);
?>
