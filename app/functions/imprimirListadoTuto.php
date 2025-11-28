<head>

	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bootstrap.css" rel="stylesheet"><link href="css/esfocc.css" rel="stylesheet">
	<style>@media print { th { font-size: 12px } } </style>

</head>

<div id="content">

	<?
		if ( isset($_POST[contenido]) )
			echo $_POST[contenido];
	?>

</div>

<script type="text/javascript">
window.onload = function () {
    window.print();
}
</script>