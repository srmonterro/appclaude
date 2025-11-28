<!DOCTYPE html>
<html>
	<head>
	    
		<title>Información Pantalla</title>
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

    <style>
      * { 
        margin:0;
        padding:0;
      }
      a:link, a:visited, a:hover, a:active {
        color:#0f0;
        font-size:16px;
      }
      body {
        background:#eee;
        font-family:verdana;
      }
      h1 {
        color:#c0c;
        font-size:24px;
      }
      p {
        font-size:16px;
      }
      ul {
        list-style-type:none;
      }
      #cabecera {
        color:#ff9;
        background-color:#000;
      }
      #contenedor {
        margin:0 auto;
        width:1800px;
      }
      #contenido {
        background-color:#ddd;
        float:left;
      }
      #menu {
        background-color:#999;
        float:left;
        height:480px;
        padding:20px;
        width:180px;
      }
      #pie { 
        background-color:#bbb;
        clear:both;
        color:#900;
        padding:10px;
        text-align:center;
      }
    </style>
    <script>setTimeout('document.location.reload()',15000); </script>
	</head>  
	<body>  
    <div id="contenedor">
      <div id="cabecera">        
        <img src="img/Cabecera.png">
      </div>      
      <div id="contenido">
      <?      
      $aula = $_GET['aula'];
      if ($aula == 1){
        echo '<img src="img/aula01.png">';
      } else if ($aula == 2) {
        echo '<img src="img/aula02.png">';
      } else if ($aula == 3) {
        echo '<img src="img/aula03.png">';
      }
      ?>
      </div> 
    </div>
  </body>    
</html>