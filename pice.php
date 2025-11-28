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

	// $link = connectCongreso();

 //    $q = 'SELECT *
 //    FROM wp_cf7dbplugin_submits i';

    $link=connectDesayuno();
    
    $q ='SELECT field_name,field_val from wp_cformsdata 
          WHERE sub_id >= 1415 ORDER BY f_id DESC';

    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

    $reemplazo = array('&lt;strong&gt;', '&lt;/strong&gt;');
    $reemplaza = array('', '');

    $i = 0;
    $contador = 0;

    echo '

    <div class="container" style="margin-top: 30px">
    LISTADO PICE
    <form id="listarExcel" action="functions/exportarexcel_seguimientoe.php" method="post" target="_blank">
        <input type="hidden" id="datatodisplay" name="datatodisplay" />
    
    <a id="listadoExcelCongreso" style="margin-bottom: 20px" class="pull-left btn btn-primary btn-default">
    <span class="glyphicon glyphicon-list-alt"></span> EXCEL</a>

    <br /><br /><br />
    
    <div id="listado-seguimiento">

    <table id="participantes" class="table table-stripped" >
    <thead>
        <th>Nº</th>
    	<th>Curso</th>
    	<th>Nombre y Apellidos</th>
    	<th>Teléfono</th>
    </thead>
    <tbody>';

    $i=0;
    $datos=array();
    while ($row = mysqli_fetch_array($q)){

      $datos[$i][$row["field_name"]]=$row["field_val"]; 
      
      if($row["field_val"]=="http://esfocc.com/PICE/"){
         $i++; 
      }
    }

    $j = 1;
    $max = sizeof($datos)+1;

    // $max = 30;
    // echo "max: ".$max;
    // arrayText($datos);
    // for ($i=0; $i < 30; $i++) { 

    foreach($datos as $valor) {
      
      if ( $j == $max-1 )
        $fin = 'id="fin"';
      else 
        $fin = '';

      if ( isset($valor['Nombre y Apellidos']) ) {
          echo '                           <tr>'; 
          echo '<td '.$fin.'>' . $j . '</td>';
          echo '<td id="nombre'.$j.'">' . $valor['Nombre y Apellidos'] . '</td>';
          //echo '<td id="apellidos'.$j.'">' . $valor['Apellidos'] . '</td>';
          echo '<td id="email'.$j.'">' . $valor['Email'] . '</td>';
          echo '<td id="tlf'.$j.'">' . $valor['Teléfono'] . '</td>';
          echo '<td id="empresa'.$j.'">' . $valor['Empresa'] . '</td>';
          echo '                           </tr>'; 
      } 
      $j++;                      
    // }
    }
    echo '</tbody></table></div></form></div>';

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