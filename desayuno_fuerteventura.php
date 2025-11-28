<!DOCTYPE html>
<html>
	<head>
	    
		<title>Desayuno Fuerteventura</title>
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

              });
		</script>

        <style type="text/css">
            #myPrintArea{
                font-size:13px;
            }
		</style>

	</head>
    
    
	<body>
    
	 <?php 
        //CONEXION Y INICIAMOS SESSION
        session_start();
        include ('functions/funciones.php');
        
        $link=connectDesayuno();
        
        $q ='SELECT field_name,field_val from wp_cformsdata 
              WHERE sub_id >= 625 ORDER BY f_id DESC';
              
        $q = mysqli_query($link,$q) or die ("Error de Consulta". mysqli_error($link)) ;
        
        
        ?> 

            <div class="container">
<!--               <div class="row">
                   <div class="col-md-2">
                       <p>
                           <button class="btn btn-link" id="imprime">Imprimir Tabla</button>
                       </p>
                       <hr/>   
                   </div>
              </div>
 -->        
        <div id="myPrintArea" >  
            
        <?php
        
        
        echo ' <div class="row">';
                   echo '     <div class="col-md-12listo">';
                   echo '         <div class="form-group">';
                   echo '            <label class="control-label" for="myPrintArea">Personas Inscritas:</label>';

                   echo '              <table  id="myPrintArea" class="table table-striped">';
                   echo '                       <thead>'; 
                   echo '                           <tr style="background-color:#8AC5E4">';
                   echo '                               <td>';
                   echo '                                 <b>Nombre</b>';
                   echo '                               </td>';
                   echo '                               <td>';
                   echo '                                 <b>Apellidos</b>';
                   echo '                               </td>';
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
                      
                      if($row["field_val"]=="http://esfocc.com/desayuno-fuerteventura/"){
                         $i++; 
                      }
                  }

                    // arrayText($datos);
                   
                 foreach($datos as $valor) {
                        if ( isset($valor[Nombre]) ) {
                        echo '                           <tr>'; 
                        echo '<td>' . $valor['Nombre'] . '<br /></td>';
                        echo '<td>' . $valor['Apellidos'] . '<br /></td>';
                        echo '<td>' . $valor['Email'] . '<br /></td>';
                        echo '<td>' . $valor['Teléfono'] . '<br /></td>';
                        echo '<td>' . $valor['Empresa'] . '<br /></td>';
                        echo '                           </tr>'; 
                      }                       
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
    
    
</html>


