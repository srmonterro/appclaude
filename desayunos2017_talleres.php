<!DOCTYPE html>
<html>
	<head>
	    
		<title>Competencia Digital</title>
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
        
        $q ='SELECT field_name, field_val from wp_cformsdata 
              WHERE sub_id >= 1556 and sub_id IN (SELECT sub_id from wp_cformsdata where sub_id >= 1556 and field_val like "/talleres-competencias-digitales/") 
              ORDER BY f_id DESC';
        //625
              
        $q = mysqli_query($link,$q) or die ("Error de Consulta". mysqli_error($link)) ;
        
        
        ?> 

            <div class="container">
               <div class="row">
                   <div class="col-md-2">
                       <p>
                           <button class="btn btn-link" id="imprime">Imprimir Tabla</button>
                       </p>
                       <hr/>   
                   </div>
              </div>
       
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
                   echo '                                 <b>Número</b>';
                   echo '                               </td>';
                   echo '                               <td>';
                   echo '                                 <b>Nombre y Apellidos</b>';
                   echo '                               </td>';                   
                   echo '                               <td>';
                   echo '                                 <b>Email</b>';
                   echo '                               </td>';
                   echo '                               <td>';
                   echo '                                 <b>Taller</b>';
                   echo '                               </td>';
                   echo '                               <td>';
                   echo '                                 <b>¿Qué formación has realizado?</b>';
                   echo '                               </td>';
                   echo '                               <td>';
                   echo '                                 <b>¿En los últimos dos años has realizado formación relacionada con los contenidos del programa formativo?</b>';
                   echo '                               </td>';
                   echo '                               <td>';
                   echo '                                 <b>¿Tienes experiencia previa aplicando en aula estrategias metodológicas relacionadas con los contenidos?</b>';
                   echo '                               </td>';
                   echo '                               <td>';
                   echo '                                 <b>¿En qué nivel educativo ejerces docencia?</b>';
                   echo '                               </td>';
                   echo '                               <td>';
                   echo '                                 <b>¿En qué centro de enseñanza trabajas?</b>';
                   echo '                               </td>';
                   echo '                               <td>';
                   echo '                                 <b>¿En qué área de conocimiento?</b>';
                   echo '                               </td>';
                   echo '                               <td>';
                   echo '                                 <b>¿Cuántos años de experiencia tienes como docente?</b>';
                   echo '                               </td>';                   
                   echo '                           </tr>'; 
                   echo '                       <thead>';                   
                   echo '                       <tbody>';
                  
                  $i=0;
                  $datos=array();
                  while ($row = mysqli_fetch_array($q)){

                      $datos[$i][$row["field_name"]]=$row["field_val"]; 
                      
                      //if($row["field_val"]=="http://esfocc.com/desayuno-fuerteventura/"){
                      if($row["field_val"]=="/talleres-competencias-digitales/"){
                         $i++; 
                      }
                  }

                  //   arrayText($datos);
                  $i=1;
                 foreach($datos as $valor) {
                        if ( isset($valor['Nombre']) ) {
                        echo '                           <tr>'; 
                        echo '<td>' . $i . '</td>';
                        echo '<td>' . $valor['Nombre'] . ' ' . $valor['Apellidos'] .'</td>';
                        echo '<td>' . $valor['Correo electrónico'] . '</td>';
                        echo '<td>' . $valor['Selecciona Taller'] . '</td>';
                        echo '<td>' . $valor['¿Que formación has realizado ?'] . '</td>';
                        echo '<td>' . $valor['¿En los últimos dos años has realizado formación relacionada con los contenidos del programa formati'] . '</td>';
                        echo '<td>' . $valor['¿Tienes experiencia previa aplicando en aula estrategias metodológicas relacionadas con los contenid'] . '</td>';
                        echo '<td>' . $valor['¿En qué nivel educativo ejerces docencia?'] . '</td>';
                        echo '<td>' . $valor['¿En qué centro de enseñanza trabajas?'] . '</td>';
                        echo '<td>' . $valor['¿En qué área de conocimiento?'] . '</td>';
                        echo '<td>' . $valor['¿Cuántos años de experiencia tienes como docente?'] . '</td>';
                        echo '                           </tr>'; 
                      $i++;
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


