    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./css/bootstrap.css" rel="stylesheet">
        <script src="js/jquery-1.10.2.js"></script>
    </head>

<?

    include ('./functions/funciones.php');

	$link = connectCongreso();

    $q = 'SELECT buyer_info, created
    FROM imevent_payments i';
    
    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

    $reemplazo = array('&lt;strong&gt;', '&lt;/strong&gt;');
    $reemplaza = array('', '');

    $i = 0;

    echo '
    <div class="container" style="margin-top: 30px">
    <form id="lala" action="functions/exportarexcel_seguimientoe.php" method="post" target="_blank">
        <input type="hidden" id="datatodisplay" name="datatodisplay" />
    <a id="listadoExcelCongreso" style="margin-bottom: 20px" class="pull-left btn btn-primary btn-default">
    <span class="glyphicon glyphicon-list-alt"></span> EXCEL</a>
    <div id="listado-seguimiento">
    <table id="participantes" class="table table-stripped" >
    <thead>
    	<th>#</th>
    	<th>Nombre y Apellidos</th>
    	<th>Email</th>
    	<th>Teléfono</th>
    	<th>Empresa</th>
    	<th>Cargo</th>
        <th>Fecha Inscripción</th>
    </thead>
    <tbody>';

    while ( $row = mysqli_fetch_array($q) ) {

        // print_r($row);
    	$i++;

    	$t = str_replace('&lt;br/&gt;', '<BR>', $row[buyer_info]);
		$t = str_replace($reemplazo, $reemplaza, $t);		

    	echo "<tr>";       
    	echo "<td>". $i ."</td>";
    	
    	$nombre = explode('Apellidos:', $t);
    	$nombre = explode('Email:', $nombre[1]);
    	echo "<td>". $nombre[0] ."</td>";
    	
    	$email = explode('Email:', $t);
    	$email = explode('Número de Teléfono:', $email[1]);
    	echo "<td>". str_replace('&nbsp;', '', $email[0]) ."</td>";

    	$tlf = explode('Número de Teléfono:', $t);
    	$tlf = explode('Empresa:', $tlf[1]);
    	echo "<td>". $tlf[0] ."</td>";

    	$emp = explode('Empresa:', $t);
    	$emp = explode('Cargo:', $emp[1]);
    	echo "<td>". $emp[0] ."</td>";

    	$cargo = explode('Cargo:', $t);
    	echo "<td>". $cargo[1] ."</td>";

        echo "<td>". date('d/m/Y', $row[created]) ."</td>";
        // echo "ey";
        echo "</tr>";
               
        
        
    }
    echo "</tbody></table></div></form>";

    // print_r($row);

?>

</html>

<script type="text/javascript">
    
    $(document).on("click", "#listadoExcelCongreso", function(event) {

        // var td = $("#participantes").find('tr:empty');
        // if ( tr.length > 0 ) $(this).remove();

        var datatodisplay = $('#listado-seguimiento').html();
        // alert(datatodisplay);
        $('#datatodisplay').val(datatodisplay);
        document.getElementById("lala").submit(datatodisplay);

    });

</script>