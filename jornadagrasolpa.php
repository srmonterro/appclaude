<!DOCTYPE html>
<html>
	<head>
	    
		<title>Jornadas Graduados Sociales GC</title>
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv='cache-control' content='no-cache'>
		<meta http-equiv='expires' content='0'>
		<meta http-equiv='pragma' content='no-cache'>
        
		<!-- Bootstrap -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/esfocc.css" rel="stylesheet">
		<link href="css/jquery-ui.min.css" rel="stylesheet">
		<link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>
        <link rel="shortcut icon" href="esfocc.png" />
        <link type="text/css" rel="stylesheet" href="css/PrintArea.css" /> 
		
		<script src="js/jquery-1.11.2.min.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		<script src="js/additional-methods.min.js"></script>
		
		<script src="js/bootstrap.min.js"></script>
		<script src="js/validar-form.js"></script>
		<script src="js/matricula.js"></script>
		<script src="js/matricula-presencial.js"></script>
		<script src="js/facturacion.js"></script>
		<script src="js/tutorias.js"></script>
		<script src="js/misc.js"></script>		
		<script src="js/inspeccion.js"></script>
		<script src="js/matgrupales.js"></script>
		<script src="js/modernizr.js"></script>
		<script src="js/jquery.columnizer.js"></script>
		<!-- <script src="js/jquery.fittext.js"></script> -->
		<!-- <script src="js/jquery.tablesorter.min.js"></script> -->
		<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
        
    <!--Script para imprimir-->
    <script type="text/javascript" src="js/jquery.PrintArea.js"></script>
		<!-- Initialize the plugin Multiselect: -->
		<script type="text/javascript">

      $(document).ready(function() {

        $('#especialidades').multiselect({		    	
            nonSelectedText: 'Selecciona especialidades',
            nSelectedText: 'seleccionadas',	
        });		 

        $('#empresasmulti').multiselect({		    	
            nonSelectedText: 'Selecciona empresas',
            nSelectedText: 'seleccionadas',	
        });	   

        $(document).on("click","#sortear", function () {

            var r = Math.floor((Math.random() * $('#fin').text()) + 1);
            $('#mostrardatosc').modal('show');
            $('#mostrardatosc .modal-dialog').css('width','700px');
            $('#mostrardatosc .mostrartitulo').html('Ganador del Sorteo');
            $('#mostrardatosc .contenido').html("<h3 style='text-align:center'>El ganador es: <br><br>Nº "+r+": "+$('#nombre'+r).text()+" "+$('#apellidos'+r).text()+"</h3>");

        });

      });

		</script>

    <style type="text/css">

        #myPrintArea{
            font-size:13px;
        }
        .sorteo_img {
            background: url('img/FondoSorteo.png');                
            background-size: contain;
            max-width: 100%;
            height: auto;
            overflow: hidden;
        }

        tbody > tr:nth-child(odd)  {
            background-color: #f9f9f9;
        }

        tbody > tr:nth-child(even) {
            background-color: #f1f1f1;
        }

        table {
              border: 1px solid #ccc;

        }

    </style>

	</head>    
    
	<body style="overflow:auto">
    
	<?php 

    //CONEXION Y INICIAMOS SESSION
    session_start();
    include ('functions/funciones.php');
    
    $link=connectDesayuno();
    
    $q ='SELECT field_name,field_val from wp_cformsdata 
          WHERE sub_id >= 878 ORDER BY f_id DESC';
    
    //echo $q;

    $q = mysqli_query($link,$q) or die ("Error de Consulta". mysqli_error($link)) ;
    
    
    ?> 

    <div class="sorteo_img" >

      <div id="myPrintArea" >

      <p style="margin-top:8%; text-align:center">
          <!-- <a style="" id="sortear" class="btn btn-lg btn-danger" href="#">REALIZAR SORTEO</a> -->
      </p> 
          
      <?php      
      
      echo ' <div class="row">';
      echo '     <div class="col-md-8 col-md-offset-2" style="margin-top: 1%;">';
      echo '         <div class="form-group">';
      echo '            <label class="control-label" for="myPrintArea"></label>';
      echo '              <table  id="myPrintArea" class="table table-striped">';
      echo '                       <thead>'; 
      echo '                           <tr style="color:#fff; background-color:#C72026">';
      echo '                               <td style="width:5%"><b>Número</b></td>';
      echo '                               <td>';
      echo '                                 <b>Nombre y Apellidos</b>';
      echo '                               </td>';
      // echo '                               <td>';
      // echo '                                 <b>Apellidos</b>';
      // echo '                               </td>';
      echo '                               <td>';
      echo '                                 <b>Email</b>';
      echo '                               </td>';
      echo '                               <td>';
      echo '                                 <b>Teléfono</b>';
      echo '                               </td>';
      echo '                               <td>';
      echo '                                 <b>Empresa</b>';
      echo '                               </td>';
      echo '                           </tr>'; 
      echo '                       <thead>';
      echo '                       <tbody>';
                
      $i=0;
      $datos=array();
      while ($row = mysqli_fetch_array($q)){

          $datos[$i][$row["field_name"]]=$row["field_val"]; 
          
          if($row["field_val"]=="http://esfocc.com/jornadagrasolpa/"){
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
                
      echo '                        </tbody>';
      echo '            </table>';
      echo '        </div>';
      echo '    </div>'; 
      echo ' </div>';

      ?>
              
      </div>
    </div>

<script>

  //Usamos el JAVA para imprimir
  $(document).ready(function(){
      $("#imprime").click(function () {
          $("div#myPrintArea").printArea();
  })
      
  });

</script>

</body>
    
<div  class="modal fade" id="mostrardatosc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                  &times;
              </button>
              <h3 class="modal-title mostrartitulo" id="myModalLabel"></h3>
          </div>
          <div class="contenido">
          
          </div>          
          
          <div class="modal-footer">
              <button id="guardarcambios" type="button" class="btn btn-primary" data-dismiss="modal" style="display:none">
                  Guardar
              </button>
          </div>
      </div>
  </div>
</div>
    
</html>


