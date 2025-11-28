    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./css/bootstrap.css" rel="stylesheet">
        <script src="js/jquery-1.10.2.js"></script>
    </head>

<?

    include ('./functions/funciones.php');
    include ('./functions/congreso.php');

	$link = connectCongreso();

    $q = 'SELECT *
    FROM wp_cf7dbplugin_submits i';

    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

    $reemplazo = array('&lt;strong&gt;', '&lt;/strong&gt;');
    $reemplaza = array('', '');

    $i = 0;
    $contador = 0;

    echo '
    <!-- <div class="container" style="margin-top: 30px"> -->
    <form id="listarExcel" action="functions/exportarexcel_seguimientoe.php" method="post" target="_blank">
        <input type="hidden" id="datatodisplay" name="datatodisplay" />
    <!--
    <a id="listadoExcelCongreso" style="margin-bottom: 20px" class="pull-left btn btn-primary btn-default">
    <span class="glyphicon glyphicon-list-alt"></span> EXCEL</a>

    <br /><br /><br />
    -->
    <div id="listado-seguimiento">
    <table id="participantes" class="table table-stripped" >
    <thead>
        <th>Nº</th>
    	<th>Tipo Solicitud</th>
    	<th>Nombre y Apellidos</th>
    	<th>Email</th>
    	<th>Teléfono</th>
    	<th>Empresa</th>
    	<th>Cargo</th>
        <th>Fecha Inscripción</th>
        <th></th>
        <th></th>
    </thead>
    <tbody>';

    while ( $row = mysqli_fetch_array($q) ) {

    	$i++;

        switch($row['2']){
            case 'TipoSolicitud':
                $tipoSolicitud = substr($row['3'], 0, strpos($row['3'], ' '));
                $idEstado = $row['6'];
                break;
            case 'your-name':
                $nombre = $row['3'];
                break;
            case 'PrimerApellido':
                $apellido1 = $row['3'];
                break;
            case 'SegundoApellido':
                $apellido2 = $row['3'];
                break;
            case 'your-email':
                $email = $row['3'];
                break;
            case 'telefono':
                $telefono = $row['3'];
                break;
            case 'empresa':
                $empresa = $row['3'];
                break;
            case 'cargo':
                $cargo = $row['3'];
                break;
            case 'Submitted From':
                $id = $row['0'];
                $fechaInscripcion = date('d/m/Y', $row['0']);
                break;
        }

        if ($idEstado==1){
            $estado = 'success';
        } elseif($idEstado==2){
            $estado = 'danger';
        }else{
            $estado = '';
        }

        if ($row['4'] == 10000){
            $contador++;
            echo '<tr>';
            // echo '<td class='.$estado.' registro="'.$id.'">'. $estado . '</td>';
            echo '<td class='.$estado.' registro="'.$id.'">'. $contador . '</td>';
            echo '<td class='.$estado.' registro="'.$id.'">'. $tipoSolicitud . '</td>';
            echo '<td class='.$estado.' registro="'.$id.'">'. $nombre . ' ' . $apellido1 . ' ' . $apellido2 .'</td>';
            echo '<td class='.$estado.' registro="'.$id.'">'. $email .'</td>';
            echo '<td class='.$estado.' registro="'.$id.'">'. $telefono .'</td>';
            echo '<td class='.$estado.' registro="'.$id.'">'. $empresa .'</td>';
            echo '<td class='.$estado.' registro="'.$id.'">'. $cargo .'</td>';
            echo '<td class='.$estado.' registro="'.$id.'">'. $fechaInscripcion .'</td>';
            echo '<td class="'.$estado.'" registro="'.$id.'"><a id="confirmar" registro="'.$id.'" email="'.$email.'" nombre="'.$nombre . ' ' . $apellido1 . ' ' . $apellido2 .'" tipoEntrada="'.$tipoSolicitud.'" style="margin-bottom: 20px" class="pull-left btn btn-primary btn-default btn-success" >Validar </a></td>';
            echo '<td class='.$estado. ' registro="'.$id.'"><a id="rechazar" registro="'.$id.'" email="'.$email.'" nombre="'.$nombre . ' ' . $apellido1 . ' ' . $apellido2 .'" tipoEntrada="'.$tipoSolicitud.'" style="margin-bottom: 20px" class="pull-left btn btn-primary btn-default btn-danger" >Rechazar</a></td>';
            echo '</tr>';
        }

    }
    echo '</tbody></table></div></form>';

?>

</html>

<script type="text/javascript">

    $(document).on("click", "#listadoExcelCongreso", function(event) {

        var datatodisplay = $('#listado-seguimiento').html();
        // alert(datatodisplay);
        $('#datatodisplay').val(datatodisplay);
        document.getElementById("listarExcel").submit(datatodisplay);

    });


    $(document).on("click", "#confirmar", function(event) {

        // event.preventDefault();

        registro = $(this).attr("registro");
        email = $(this).attr("email");
        nombre = $(this).attr("nombre");
        tipoEntrada = $(this).attr("tipoEntrada");

        $.ajax({
            cache: false,
            url: './functions/congreso.php',
            type: 'POST',
            data:'accion=confirmar&registro='+registro+'&email='+email+'&nombreApellidos='+nombre+'&tipoEntrada='+tipoEntrada+'',
            success: function (data) {

                if ( data == 'enviado' ) {
                    alert("Registro Confirmado correctamente.");
                    window.location.reload();

                }
                else {
                    alert("Fallo en la validación.");
                }
            }
        }); ajax.abort();


    });

     $(document).on("click", "#rechazar", function(event) {

        // event.preventDefault();

        registro = $(this).attr("registro");
        email = $(this).attr("email");
        nombre = $(this).attr("nombre");
        tipoEntrada = $(this).attr("tipoEntrada");

        $.ajax({
            cache: false,
            url: './functions/congreso.php',
            type: 'POST',
            data:'accion=rechazar&registro='+registro+'&email='+email+'&nombreApellidos='+nombre+'',
            success: function (data) {

                if ( data == 'enviado' ) {
                    alert("Registro Rechazado correctamente.");
                    window.location.reload();
                }
                else {
                    alert("Fallo en la validación.");
                }
            }
        }); ajax.abort();

    });

</script>