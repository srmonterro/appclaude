<?
    //header('Content-Type: application/json');
    //include_once './funciones.php';
    //include_once 'http://gestion.esfocc.com/app/functions/funciones.php';
    //include_once 'http://diplomas.esfocc.com/app/functions/funciones.php';

    //LISTADO DE VACACIONES DISFRUTADAS
    $link = connect('2016');

    if( isset($_POST[listar_datos]) ){
        
        listar_datos($_POST[codigo], $link);
        
    }

    function listar_datos($codigo, $link){

        $sql = 'SELECT * FROM diplomas_codigos WHERE codigo LIKE "'.$codigo.'"';

        $sql = mysqli_query($link, $sql) or die('error: Busqueda codigo - '. mysqli_error($link));

        $num_rows = $sql->num_rows;

        $row = mysqli_fetch_array($sql);

        if ( $num_rows > 0 ) {

            $sql = 'SELECT DISTINCT 
                al.documento, 
                concat_ws(" ", al.nombre, al.apellido, al.apellido2) as Alumno,
                e.cif, 
                e.razonsocial,
                a.denominacion, 
                a.modalidad, 
                m.fechaini, 
                m.fechafin, 
                a.horastotales,
                concat_ws("-", m.horariomini, m.horariomfin) as horariom,
                concat_ws("-", m.horariotini, m.horariotfin) as horariot            
                FROM matriculas m, acciones a, grupos_acciones ga, alumnos al, mat_alu_cta_emp ma, empresas e
                WHERE m.id_accion = a.id
                AND m.id_grupo = ga.id
                AND m.id = ma.id_matricula
                AND ma.id_alumno = al.id
                AND ma.id_empresa = e.id
                AND m.id = '.$row['id_matricula'].' AND al.id = '.$row['id_alumno'];
            
            //echo $sql;

            $sql = mysqli_query($link, $sql) or die('error: Busqueda Datos Diploma - ' . mysqli_error($link));

            $row = mysqli_fetch_array($sql);

            $nif = $row[documento];
            $alumno = $row[Alumno];
            $cif = $row[cif];
            $razonsocial = $row[razonsocial];
            $denominacion = $row[denominacion];
            $modalidad = $row[modalidad];
            $fechaini = formateaFecha($row[fechaini]);
            $fechafin = formateaFecha($row[fechafin]);
            $horastotales = $row[horastotales];
            if ( $row[horariom] != "-" ){
                $horariom = $row[horariom];
            } else {
                $horariom = "";
            }
            if ( $row[horariot] != "-" ){
                $horariot = $row[horariot];
            } else {
                $horariot = "";
            }
            
            echo '<label class="control-label" for="codigo_verificar">Datos del Alumno:</label>

            <div class="clearfix"></div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="txtNIF">NIF:</label>
                    <input disabled type="text" value="'.$nif.'" id="txtNIF" class="form-control" />
                </div>
            </div>

            <div class="col-md-5">
                <div class="form-group">
                    <label class="control-label" for="txtAlumno">Alumno:</label>
                    <input disabled type="text" value="'.$alumno.'" id="txtAlumno" class="form-control" />
                </div>
            </div>

            <div class="clearfix"></div>

            <br>

            <label class="control-label" for="codigo_verificar">Datos de la Empresa:</label>

            <div class="clearfix"></div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="txtCIF">CIF:</label>
                    <input disabled type="text" value="'.$cif.'" id="txtCIF" class="form-control" />
                </div>
            </div>

            <div class="col-md-5">
                <div class="form-group">
                    <label class="control-label" for="txtNombre">Nombre:</label>
                    <input disabled type="text" value="'.$razonsocial.'" id="txtNombre" class="form-control" />
                </div>
            </div>             

            <div class="clearfix"></div>

            <br>

            <label class="control-label" for="codigo_verificar">Datos de la acción formativa:</label>

            <div class="clearfix"></div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="txtDenominacion">Denominación:</label>
                    <input disabled type="text" value="'.$denominacion.'" id="txtDenominacion" class="form-control" />
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="txtModalidad">Modalidad:</label>
                    <input disabled type="text" value="'.$modalidad.'" id="txtModalidad" class="form-control" />
                </div>
            </div>

            <div class="clearfix"></div>

            <br>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="txtFechaInicio">Fecha Inicio:</label>
                    <input disabled type="text" value="'.$fechaini.'" id="txtFechaInicio" class="form-control" />
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="txtFechaFin">Fecha Fin:</label>
                    <input disabled type="text" value="'.$fechafin.'" id="txtFechaFin" class="form-control" />
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="txtNumHoras">Numero de horas:</label>
                    <input disabled type="text" value="'.$horastotales.'" id="txtNumHoras" class="form-control" />
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="txtHorariom">Horario de Mañana:</label>
                    <input disabled type="text" value="'.$horariom.'" id="txtHorariom" class="form-control" />
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="txtHorariot">Horario de Tarde:</label>
                    <input disabled type="text" value="'.$horariot.'" id="txtHorariot" class="form-control" />
                </div>
            </div>';

        } else {

            $codigoNoEncontradoMsg = 'El código introducido no ha sido entrontrado en nuestra Base de Datos.';
            echo '
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="txtHorariot">'.$codigoNoEncontradoMsg.'</label>
                </div>
            </div>';
        }

    }

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