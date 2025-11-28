<!DOCTYPE html>
<html>
	<head>
	    
		<title>Acciones Busqueda</title>
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


	</head>
    
    <script type="text/javascript">
        
    </script>
    
	<body>
    <br/><br/>
        
	<form action="" method="post">
     <div class="row">
       <div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="nombre">Acciones y Grupos:</label>
		    <input type="text" id="nombre" name="accion_grupo" value="ACCION/GRUPO" class="required form-control" />
		    <input type="submit" name="b_buscar" value="Buscar Empresas" class="btn btn-primary btn-md">
	    </div>
	   </div>
    </div>
    </form>
        
    <br/><br/>
        
       
	 <?php 
        //CONEXION Y INICIAMOS SESSION
        session_start();
        include ('functions/funciones.php');  
        
        //Recibimos variable con string del INPUT DE ACCION y GRUPO y lo dividimos
        $input=$_POST['accion_grupo'];
        $ar_input = explode("/", $input);
        
        //Creamos la Cookie para controlar el aviso de que no hay registros
            if(!isset($_COOKIE['contador'])) {
               setcookie('contador',0+1); 
            }else{
               setcookie('contador',$_COOKIE['contador']+1); 
            }
        
        //CONSULTA para COMPROBAR REGISTROS
            $q2 = 'SELECT e.nombrecomercial,m.estado,ga.ngrupo,a.numeroaccion,ma.finalizado,e.razonsocial,e.domiciliosocial
            FROM ptemp_mat_emp as pt
            
            inner join empresas as e
            on e.id=pt.id_empresa
            
            inner join matriculas as m
            on m.id= pt.id_matricula
            
            inner join grupos_acciones as ga
            on ga.id=m.id_grupo
            
            inner join acciones a
            on a.id=ga.id_accion
            
            inner join mat_alu_cta_emp as ma
            on ma.id_matricula=m.id
            
            WHERE ma.finalizado="1" AND a.numeroaccion="'.$ar_input[0].'" AND ga.ngrupo="'.$ar_input[1].'" 
            
            GROUP BY e.nombrecomercial';
            
            $q2 = mysqli_query($link,$q2);
            
            $numero = mysqli_num_rows($q2);
        
        if($numero>0 || isset($_POST['b_empresa'])){
            
            //EMPRESAS
            if((isset($_POST['b_buscar']) && isset($_POST['accion_grupo']) && $numero!=0) || isset($_POST['b_empresa']))  {

                //CONSULTA
                $q = 'SELECT e.nombrecomercial,m.estado,ga.ngrupo,a.numeroaccion,ma.finalizado,e.razonsocial,e.domiciliosocial
                FROM ptemp_mat_emp as pt

                inner join empresas as e
                on e.id=pt.id_empresa

                inner join matriculas as m
                on m.id= pt.id_matricula

                inner join grupos_acciones as ga
                on ga.id=m.id_grupo

                inner join acciones a
                on a.id=ga.id_accion

                inner join mat_alu_cta_emp as ma
                on ma.id_matricula=m.id

                WHERE ma.finalizado="1" AND a.numeroaccion="'.$ar_input[0].'" AND ga.ngrupo="'.$ar_input[1].'" 

                GROUP BY e.nombrecomercial';

               //Formulario SELECTOR de Empresas
               echo '<form action="" method="post">'; 
               echo ' <div class="row">';
               echo '     <div class="col-md-5">';
               echo '         <div class="form-group">';
               echo '            <label class="control-label" for="id_empresas">Empresas:</label>';
               echo '              <select id="id_empresas" name="selector_empresas" class="form-control">';

                $q = mysqli_query($link,$q);

                while ($row = mysqli_fetch_array($q)){

                    echo '<option value="'.$row['nombrecomercial'].'">'.$row['nombrecomercial'].' </option>';

                }



                echo '            </select>';
                echo '            <input type="submit" name="b_empresa" value="Buscar Alumnos" class="btn btn-primary btn-md">';
                echo '        </div>';
                echo '    </div>'; 
                echo ' </div>';             
                echo '</form>';
                echo '<br/>';
            }



            //ALUMNOS
            if(isset($_POST['b_empresa']) && $_POST['selector_empresas']!=null) {

                //CONSULTA
                $q = 'SELECT a.nombre,a.apellido,a.apellido2,a.documento
                FROM alumnos as a inner join

                mat_alu_cta_emp as ma
                on ma.id_alumno=a.id

                inner join empresas as e
                on e.id=ma.id_empresa

                WHERE ma.finalizado=1 AND e.nombrecomercial="'.$_POST['selector_empresas'].'"';

              ?> 


              <div class="row">
                   <div class="col-md-2">
                       <hr/>   
                       <p>
                           <button class="btn btn-link" id="imprime">Imprimir Tabla</button>
                       </p>
                   </div>
              </div>


                <div id="myPrintArea" >             
             <?php
                    
                   echo ' <div class="row">';
                   echo '     <div class="col-md-5">';
                   echo '         <div class="form-group">';
                   echo '            <label class="control-label" for="myPrintArea">Alumnos Finalizados:</label>';

                   echo '              <table  id="myPrintArea" class="table table-striped">';
                   echo '                       <thead>';
                   echo '                           <tr style="background-color:#8AC5E4">';
                   echo '                               <td>';
                   echo '                                 <b>Documento</b>';
                   echo '                               </td>';
                   echo '                               <td>';
                   echo '                                 <b>Nombre</b>';
                   echo '                               </td>';
                   echo '                               <td>';
                   echo '                                 <b>Apellido</b>';
                   echo '                               </td>';
                   echo '                               <td>';
                   echo '                                 <b>Apellido2</b>';
                   echo '                               </td>';
                   echo '                           </tr>'; 
                   echo '                       <thead>';

                   $q = mysqli_query($link,$q);
                   echo '                       <tbody>';

                   while ($row = mysqli_fetch_array($q)){
                        echo '</tr>';
                         echo '  <td>'.$row['documento'].'</td>';
                         echo '  <td>'.$row['nombre'].'</td>';
                         echo '  <td>'.$row['apellido'].'</td>';
                         echo '  <td>'.$row['apellido2'].'</td>';
                        echo '</tr>';

                    }

                    echo '                        </tbody>';
                    echo '            </table>';
                    echo '        </div>';
                    echo '    </div>'; 
                    echo ' </div>';             
                           
                }
            ?>

                </div>
            <?php
            
        }else{
            //Luego Comprobamos el valor
            if($_COOKIE['contador']!=0){
                echo "<div class='col-md-3 alert alert-warning'>
                        <strong>No existen Registros</strong> en la Base de Datos
                      </div>";
            } 
        }
         
     ?>
              
        
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


