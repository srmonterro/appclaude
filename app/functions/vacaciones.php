<?
    //header('Content-Type: application/json');
    include_once './funciones.php';
    $ruta = dirname(__DIR__).'/documentacion'.$gestion.'/vacaciones/';
    
    $doc = $_POST['doc'];
    $id_vacaciones = $_POST['id_vacaciones'];
    $tipo = $_POST['tipo'];
    $registro = $_POST['registro'];

    if(isset($_POST['documento'])){
         
        $id_vac=$_POST['documento'];

        $sql = 'select vacaciones_pendientes,dni
                from nominas_usuarios
                WHERE id = "'.$id_vac.'"';

        $sql = mysqli_query($link, $sql) or die('error');

        $dni = mysqli_fetch_row($sql);
                
    }

    if(isset($_POST['id_usuario'])){
        
        $result = mysqli_query($link, 'show tables like dias_vacaciones');
        
        if($result=0){
            echo 'error';
        }else{
            $id_vac=$_POST['id_usuario'];

            $sql = 'select vacaciones_pendientes,dni
                    from nominas_usuarios
                    WHERE id = "'.$id_vac.'"';

            $sql = mysqli_query($link, $sql) or die('error');

            $dni = mysqli_fetch_row($sql);

            echo $dni[0];
        }
    }

    //AL INSERTAR DATOS EN TABLAS días_vacaciones y nominas_usuarios 
    if(isset($_POST['accion']) && $_POST['accion']=="insertar"){
      
        $sql = 'insert into dias_vacaciones  (dia_salida,dia_entrada,dias,pendiente,id_usuario,observaciones,no_computable) VALUES ("'.$_POST['f_salida'].'","'.$_POST['f_entrada'].'",'.$_POST['dias_disfrutar'].','.$_POST['dias_pendientes'].','.$_POST['id_usuario'].',"'.addslashes($_POST['observaciones']).'","'.$_POST['computable'].'")';
        
        echo $sql;
        
        mysqli_query($link, $sql) or die('error');
        
        //Actualizamos los dias de vacaciones pendientes
        $sql2 = 'UPDATE nominas_usuarios
                 SET vacaciones_pendientes='.$_POST['dias_pendientes'].'
                 WHERE id='.$_POST['id_usuario'].'';    

        mysqli_query($link, $sql2) or die('error');
        
    }

    //LISTADO DE VACACIONES DISFRUTADAS
    if(isset($_POST['accion']) && $_POST['accion']=="listar_tabla"){
        
        $id_usuario = $_POST['id_usuario'];
        
        $sql = 'select dia_salida, dia_entrada, dias, pendiente, id, observaciones
                from dias_vacaciones
                WHERE id_usuario = "'.$id_usuario.'" ORDER By dia_salida DESC';
        
        $myArrayEncode = getArraySQL($sql, $link);
        
        if($myArrayEncode)
        {
            $myArray = json_decode($myArrayEncode);

            ob_end_clean();
            echo '<br>';
            echo '<table class="table table-bordered table-striped">';
            echo '<th width="9%" style="vertical-align:middle">Día Salida</th><th width="9%" style="vertical-align:middle">Día Entrada</th><th width="7%" style="vertical-align:middle">Días Periodo</th><th width="8%" style="vertical-align:middle" hidden>Días Pendientes</th><th width="25%" style="vertical-align:middle">Observaciones</th><th width="7%" style="vertical-align:middle">Informe<br>Blanco</th><th width="10%" style="vertical-align:middle">Subir/Mostrar<br>Informe</th><th width="8%" style="vertical-align:middle">Editar</th>';
            
            foreach($myArray as $obj)
            {
                //$dia_salida = formateaFecha($obj->dia_salida);
                $dia_salida = $obj->dia_salida;
                $fecha_salida = formateaFechaDirectorio($obj->dia_salida);
                //$dia_entrada = formateaFecha($obj->dia_entrada);
                $dia_entrada = $obj->dia_entrada;
                $dias = $obj->dias;
                $pendiente = $obj->pendiente;
                $observaciones = $obj->observaciones;
                $id_vacaciones = $obj->id;
                
                $archivo = $ruta . $dni[1] . '/'  . $fecha_salida . '_ParteVacaciones' .'.pdf';
            
                if ( file_exists($archivo) ) $color = 'green'; else $color = 'red';
                
                $readmore = '... <a style="font-size: 11px;" id="obscuest" href="#" style="cursor:pointer" obs="'.$observaciones.'">Leer más</a>';
                echo '<input type="hidden" id="id_registro" value="'.$id_vacaciones.'">';
                echo '<input type="hidden" id="usuario" value="'.$id_usuario.'">';
                echo '<tr>
                <td><input type="date" id="actualizar_dia_salida'.$id_vacaciones.'" idvac="'.$id_vacaciones.'" class="form-control actualizar" value="'.$dia_salida.'"></td>
                <td><input type="date" id="actualizar_dia_entrada'.$id_vacaciones.'" idvac="'.$id_vacaciones.'" class="form-control actualizar" value="'.$dia_entrada.'"></td>
                <td><input id="actualizar_dias_disfrutar'.$id_vacaciones.'" class="form-control" type="text" disabled value="'.$dias.'"></td>
                <td hidden><input id="actualizar_dias_restantes'.$id_vacaciones.'" class="form-control" type="text" disabled value="'.$pendiente.'"></td>';
                echo '<td style="display:none" id="observacioneslarga">'.$row[observaciones].'</td>';
                echo '<td><input type="text" id="observaciones'.$id_vacaciones.'" style=";word-wrap: break-word" class="form-control" value="'.$observaciones.'" /></td>';
                /*echo '<td style="display:none" id="observacioneslarga">'.$row[observaciones].'</td>';
                echo '<td id="observaciones" style=";word-wrap: break-word">'.substr($observaciones,0, 30);
                if ( $observaciones != "" ) echo $readmore;
                echo '</td>';*/
                echo '<td><a href="./documentacion/parte_vacaciones.php?id_vacaciones='.$id_vacaciones.'" class="boton btn btn-primary" target="_blank"><span class="glyphicon glyphicon-download"></span></a></td>
                <td><a id="mostrarsubirpdfvacaciones'.$id_vacaciones.'" id_registro="'.$id_vacaciones.'" class="boton btn btn-primary" onclick="mostrarSubirPDF('.$fecha_salida.','.$id_usuario.');"><span class="glyphicon glyphicon-upload"></span></a>
                <span style="margin-top: 10px; margin-left: 5px; color: '.$color.'" class="glyphicon glyphicon-ok-circle"></span>
                </td>
                <td><a id="btnActualizarVacaciones" idvac="'.$id_vacaciones.'" class="boton btn btn-success botonactualizar" type="submit">
                <span class="glyphicon glyphicon-floppy-disk"></a></td>';
            }
            echo '</table>';
        }else{
           ob_end_clean();
        }
    }

    //SUBIR FICHERO PDF
    if(isset($_POST['accion']) && $_POST['accion']=="subirpdf"){
    
        $ruta = $ruta . $dni[1] . '/';
        
        if ($_FILES["file"]["error"] > 0) {
                
            echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
            return false;

	    } else if ( isset($_POST['tipo'] ) ) {
            
            switch ($tipo) {
                
                case 'vacaciones':
                {
                    
                    if ( !file_exists($ruta) )
                        mkdir($ruta);
                    
                    $move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . $registro . '_ParteVacaciones' .'.pdf');
                    chmod($ruta . $registro . '_ParteVacaciones' .'.pdf',0755);
                    break;   
                }
            }
        }
        
        ob_end_clean();
        
        if ( $move == 'true' ) {
            echo "bien";
        }else {
            // echo "este error";
            echo "error";
        }
    }

    //MOSTRAR UN FICHERO SUBIDO
    if(isset($_POST['accion']) && $_POST['accion']=="mostrarpdf"){
               
        $archivo = '';
        $archivo = '/app/documentacion'.$gestion.'/vacaciones/' . $dni[1] . '/' . $registro . '_ParteVacaciones' .'.pdf';
        
        ob_end_clean();
        
        echo ($archivo);    
               
    }

    //MODIFICACION HECHA POR OCTAVIO 6/4/2017
    //EJECUTA LA ACTUALIZACION DE UN REGISTRO DE VACACIONES
    if (isset($_POST['actualizar'])) {

        $id_registro = $_POST['id_registro'];
        $usuario = $_POST['usuario'];
        $fecha_salida = $_POST['fecha_salida'];
        $fecha_entrada = $_POST['fecha_entrada'];
        $dias_periodo = $_POST['dias_periodo'];
        $dias_pendientes = $_POST['dias_pendientes'];
        $observaciones = $_POST['observaciones'];
        $dias_globales = $_POST['globales'];

        $consulta = "UPDATE dias_vacaciones SET dia_salida = '".$fecha_salida."', dia_entrada = '".$fecha_entrada."', dias = ".$dias_periodo.", pendiente = ".$dias_pendientes.", observaciones = '".$observaciones."' WHERE id = ".$id_registro;

        $consulta2 = "UPDATE nominas_usuarios SET vacaciones_pendientes = ".$dias_globales." WHERE id = ".$usuario;

        /*echo $consulta;
        echo $consulta2;*/

        mysqli_query($link, $consulta);
        mysqli_query($link, $consulta2);

        echo json_encode($consulta);
    }

    if (isset($_POST['global'])) {

        $usuario = $_POST['usuario'];

        $consulta = 'SELECT vacaciones_pendientes FROM nominas_usuarios WHERE id = '.$usuario;

        $resultado = mysqli_query($link, $consulta);

        while ($fila = mysqli_fetch_assoc($resultado)) {
            $pendiente = $fila['vacaciones_pendientes'];
        }

        echo $pendiente;
    }
    //TERMINA MODIFICACION

    function getArraySQL($sql, $link)
    {
        $sql = mysqli_query($link, $sql) or die('error');
        
        $num_rows = $sql->num_rows;
        if($num_rows==0)
        {
            return false;
        }
        
        $rawdata =  array();
        $i = 0;
        
        while($row = mysqli_fetch_array($sql))
        {
            $rawdata[$i] = $row;
            $i++;           
        }
        return json_encode($rawdata);
    }

?>