<?

include_once './funciones.php';

$anio = devuelveAnioReal();
$tabla = $_POST['tabla'];
$mat = $_POST['mat'];
$tipo = $_POST['matricula'];
unset($_POST['tabla']);
unset($_POST['mat']);
unset($_POST['matricula']);

$i = 0;
$j = 0;


$sec = basename($_SERVER['HTTP_REFERER'], ".php");

// print_r($_POST);
if ($tabla == 'matriculas') {

    $i = 0;
    foreach ($_POST as $key => $value) {

        if ( $value != "" ) {

            // if ( $sec[1] = 'index.php?tutorias' ) {
                $and = ' AND ';

            // } else {
            //     $and = ' AND ';
            // }
            // echo $key."<br>";
            // if ($key == 'docente') { $key = 'd.id'; $ññol}
            if ($key == 'denominacion' ) {
                $like = ' '.$key.' LIKE '."'%".$value."%'";
                //
                $in = '';
            }

            if ( $key == 'docente' ) {

                $in = ' d.id IN '."('".$value."')";
                $like = '';
            }

            if ( $key == 'fechaini' ) {

                $in = ' '.$key.' IN '."('".$value."')";
                $like = '';
            }

            if ( $key == 'fechafin' ) {

                $in = ' '.$key.' IN '."('".$value."')";
                $like = '';
            }

            if ($key == 'numeroaccion'  ) {

                $grupot = explode("/", $value);
                $value = $grupot[0];
                if ($grupot[1] != "")
                    $grupo = ' AND ngrupo = '.$grupot[1];

                $in = ' '.$key.' IN '."('".$value."')";
                $like = '';
            }

            if ( $key == 'nombre' || $key == 'apellido' || $key == 'apellido2') {

                $in = '';
                $alumnos = ' ma.id_alumno = al.id ';
                $like = '';
            }

            if ( $key == 'nombre' ) {

                $like = ' al.nombre LIKE '."'%".$value."%'";
                $in = '';
            }

            if ( $key == 'apellido' ) {

                $like = ' al.apellido LIKE '."'%".$value."%'";
                $in = '';
            }

            if ( $key == 'apellido2' ) {

                $like = ' al.apellido2 LIKE '."'%".$value."%'";
                $in = '';
            }

            if ($key == 'comercial') {

                $comercialTablas = ' , empresas e, comerciales c ';
                $comercialTablas2 = ' , empresas e, comerciales c ';
                if ( $sec != 'index.php?tutorias' && $sec != 'index.php?matricula' ) {
                    $comercialTablas .= ', mat_alu_cta_emp ma';
                    $comercialTablas2 .= ', mat_alu_cta_emp ma';
                }
                $comercial = ' AND m.id = ma.id_matricula AND ma.id_empresa = e.id AND e.comercial = c.id AND c.id = '.$value;
                $in = '';
                $and = '';
                $like = '';
            }

            if ( $key == 'estado' ) {

                $in = ' '.$key.' IN '."('".$value."')";
                $like = '';
            }

            if ( $key == 'meses' ) {

                $in = ' fechafin >= "'.date('Y').'-'.$value.'-01'.'" AND fechafin <= "'.date('Y').'-'.$value.'-'.date('t', strtotime(date('Y').'/'.$value.'/01')).'"';

                $like = '';
            }

            if ( $key == 'solicitud' ) {

                if ( $value == 'IKEA' )
                    $in = ' '.$key.' LIKE "IK%"';
                else if ( $value == 'ESFOCC' )
                    $in = ' numeroaccion < 6000 AND '.$key.' NOT LIKE "IK%"';
                else if ( $value == 'CCC' )
                    $in = ' numeroaccion >= 6000 AND numeroaccion < 7000';
                else if ( $value == 'DINOSOL' )
                    $in = ' numeroaccion >= 7000 ';

                $like = '';
            }

            if ( $key == 'tipo' ) {

                $ngrupo = 'ngrupo';
                if ( $value == 'bonificado' )
                    $in = ' '.$ngrupo.' NOT LIKE "%p%"';
                else if ( $value == 'privado' )
                    $in = ' '.$ngrupo.' LIKE "%p%"';

                $like = '';
            }

            if ($key == 'centro') {

                $in = ' '.$key.' IN '."('".$value."')";
                $like = '';

            }

            $campos .= $and.$like.$in.$grupo;

        }

    }

} else if ($tabla == 'acciones') {

    if ( isRoot() )
    print_r($_POST['numeroaccion']);

    foreach ($_POST as $key => $value) {

        if ( $value != "") {
            if ($j>=1 && isset($_POST['denominacion']))
                $and1 = ' AND ';
            $j++;
            if ($key == 'denominacion' && $value != "" ) {
                $like = $key.' LIKE '."'%".$value."%'";
                $key = ''; $value = '';
                $in = '';
                unset($_POST['denominacion']);
            }
        }
    }
    // if ($j>=1 && !isset($_POST['denominacion']) && $_POST['numeroaccion'] == '')
        // $and1 = ' AND ';

    foreach ($_POST as $key => $value) {

        if ($value != "" ) {

            if ($i>=1)
                $and = ' AND ';
            $i++;
            $in = $key.' IN '."('".$value."')";

            $campos .= $and.$in;
        }
    }
    // if ( ($i==1) && ($j>=1)) {
    //     $campos .= ' AND ';
    // }
    $campos .= $and1.$like;

} else if ($tabla == 'empresas') {

    foreach ($_POST as $key => $value) {

    	if ($value != "") {

    		if ($i >= 1) $and = ' AND ';
    		$i++;

            if ($key == 'grupo' && $value != 0) {
                $hayGrupo = 1;
                // echo $hayGrupo;
                $in = ' '.$key.' IN '."('".$value."')";
                // echo $in;
                $key = ''; $value = '';
                $like = '';
            }
            // echo $key;
            if ($key == 'razonsocial') {
                $like = $key.' LIKE '."'%".$value."%'";
                $in = '';
            }
            if ($key == 'cif') {
                $in = $key.' IN ("'.$value.'")';
                $like = '';
            }

            if ($key == 'comercial') {
                $in = $key.' IN ("'.$value.'")';
                $like = '';
            }
            if ($key == 'agente') {
                $in = $key.' IN ("'.$value.'")';
                $like = '';
            }
            if ($key == 'categoria') {
                $in = $key.' IN ("'.$value.'")';
                $like = '';
            }

            if ($key == 'nombrecomercial') {
                $like = $key.' LIKE '."'%".$value."%'";
                $in = '';
            }
            // echo $in;
    		$campos .= $and.$like.$in.$grupo;
            // echo $campos;
    	}
    }

} else if ($tabla == 'docentes') {

    if (isRoot())
        print_r($_POST['documento']);

    foreach ($_POST as $key => $value) {
        if ($value != "") {
            if ($i >= 1) $and = ' AND ';
            $i++;
            $like = $key.' LIKE '."'%".$value."%'";
            if ($key == 'especialidad') {
                $key = 'id_especialidad';
                $in = $key.' IN '."('".$value."')";
                $key = ''; $value = '';
                $like = '';
            }
            //MODIFICACION OCTAVIO 5/4/2017
            if ($key == 'documento') {
                $key = 'documento';
                $in = $key.' = '."'".$value."'";
                $key = ''; $value = '';
                $like = '';
            }
            //TERMINA MODIFICACION

            $campos .= $and.$like;
        }
    }
    $campos .= $in;

} else if ($tabla == 'comisionistas') {

    foreach ($_POST as $key => $value) {

        if ($value != "") {

            if ($i >= 1) $and = ' AND ';
            $i++;

            // echo $key;
            if ($key == 'comercial') {
                $in = $key.' IN ("'.$value.'")';
                $like = '';
            }
            if ($key == 'nifcif') {
                $in = $key.' IN ("'.$value.'")';
                $like = '';
            }
            if ($key == 'nifcif') {
                $in = $key.' IN ("'.$value.'")';
                $like = '';
            }
            if ($key == 'tipocomisionista') {
                $in = $key.' IN ("'.$value.'")';
                $like = '';
            }
            if ($key == 'nombre') {
                $like = $key.' LIKE '."'%".$value."%'";
                $in = '';
            }
            // echo $in;
            $campos .= $and.$like.$in;
            // echo $campos;
        }
    }

} else if ($tabla == 'peticiones_formativas') {

    foreach ($_POST as $key => $value) {

        if ($value != "") {

            // if ($i >= 1) $and = ' AND ';
            // $i++;

            // echo $key;
            if ( $key == 'mes' ) {
                $in = ' AND fechaini >= "'.$anio.'-'.$value.'-01'.'" AND fechaini <= "'.$anio.'-'.$value.'-'.date('t', strtotime($anio.'/'.$value.'/01')).'"';
                $like = '';
                $fechas = '';
            }

            if ($key == 'modalidad') {
                $in = ' AND '.$key.' IN ("'.$value.'")';
                $like = '';
            }
            if ($key == 'tiposol') {
                $in = ' AND '.$key.' IN ("'.$value.'")';
                $like = '';
            }
            if ($key == 'estado_peticion') {
                $in = ' AND '.$key.' IN ("'.$value.'")';
                $like = '';
            }
            if ($key == 'numero') {
                $in = ' AND '.$key.' IN ("'.$value.'")';
                $like = '';
            }
            if ($key == 'id_comercial') {
                $in = ' AND '.$key.' IN ("'.$value.'")';
                $like = '';
            }
            if ($key == 'empresas') {
                $like = ' AND '.$key.' LIKE "%'.$value.'%"';
                $and = '';
            }

            $campos .= $and.$like.$in;
            // echo $campos;
        }
    }

} else if ($tabla == 'acreedores') {

    foreach ($_POST as $key => $value) {

        if ($value != "") {

            if ($i >= 1) $and = ' AND ';
            $i++;

            // echo $key;
            if ($key == 'razonsocial') {
                $like = $key.' LIKE '."'%".$value."%'";
                $in = '';
            }
            if ($key == 'cif') {
                $in = $key.' IN ("'.$value.'")';
                $like = '';
            }
            if ($key == 'tipoacreedor') {
                $in = $key.' IN ("'.$value.'")';
                $like = '';
            }
            // if ($key == 'tipocomisionista') {
            //     $in = $key.' IN ("'.$value.'")';
            //     $like = '';
            // }
            // if ($key == 'nombre') {
            //     $like = $key.' LIKE '."'%".$value."%'";
            //     $in = '';
            // }
            // echo $in;
            $campos .= $and.$like.$in;
            // echo $campos;
        }
    }

} else {

    foreach ($_POST as $key => $value) {
        if ($value != "") {
            if ($i >= 1) $and = ' AND ';
            $i++;

            if ($key == 'especialidad')
                $key = 'id_especialidad';
            if ($key == 'numeroaccion' && $mat == '1') {
                $grupot = split("/", $value);
                $value = $grupot[0];
                if ($grupot[1] != "")
                 $grupo = ' AND ngrupo = '.$grupot[1];
            }
            $campos .= $and.$key.' LIKE '."'%".$value."%'".$grupo;
        }
    }
}

// if ( $_SESSION[user] == 'root') {

//     echo "Campos: ".$campos."<br>";
//     echo "Tabla: ".$tabla."<br>";
//     echo "Sección: ".$sec."<br>";

// }

if ($mat == '1') $mat = 'mat-';
	else if ($mat == '2')
		$mat = 'matp-';
    else if ($mat == '3' || $mat == '4')
        $mat = 'matpdoc-';
	else if ($mat == '5')
        $mat = 'matpfac-';
    else if ($mat == '6') {
     	if ( $tipo == 'matmpod-' || $tipo == 'matmpre-')
     		$mat = $tipo;
     	else
        	$mat = 'matm-';
    }
    else if ($mat == '7')
        $mat = 'matt-';
    else if ($mat == '8')
        $mat = 'cert-';
    else if ($mat == '9')
        $mat = 'inspec-';
    else if ($mat == '10')
        $mat = 'inspecpm-';
    else if ($mat == '11')
        $mat = 'matodoc-';
    else if ($mat == '12')
        $mat = 'matoini-';
    else if ($mat == 'gasto') {
        $mati = 'gasto';
        $mat = "";
    }
	else $mat = "";

    if ($sec == 'index.php?form_docufinal')
        $mat = 'inspecpm-';

    if ($sec == 'index.php?form_docufinalonlinedist')
        $mat = 'inspec-';

    if ($sec == 'index.php?form_listado-cuestionarioikea')
        $mat = 'ikeacuest';

    if ($sec == 'index.php?facturacion_ikea')
        $mat = 'matpfacikea-';

    // echo $mat;

switch ($tabla) {

    case 'peticiones_formativas':

        // if ( $_SESSION['user'] == 'isabel' || $_SESSION['user'] == 'amparo' )

        // $q1 = "SELECT p.*, c.nombre
        // FROM peticiones_formativas p
        // INNER JOIN comerciales c ON c.id = p.id_comercial
        // WHERE id_comercial IN (3,7,12)";

        // if ( $_SESSION['user'] == 'oscar' )

        //     $q1 = "SELECT p.*, c.nombre
        //     FROM peticiones_formativas p
        //     INNER JOIN comerciales c ON c.id = p.id_comercial
        //     WHERE id_comercial IN (3,7,12,38,40)";

        // else if ( $_SESSION['user'] == 'javier' || $_SESSION['user'] == 'melody' || $_SESSION['user'] == 'root' || $_SESSION['user'] == 'daniel' || $_SESSION['user'] == 'amanda' || $_SESSION['user'] == 'margarita' || $_SESSION['user'] == 'alago' || $_SESSION['user'] == 'rmedina' ) {

        //     if ( $_SESSION['user'] == 'melody')
        //         $q1 = "SELECT p.*, c.nombre
        //     FROM peticiones_formativas p, comerciales c
        //     WHERE modalidad IN ('Presencial','Mixta')
        //     AND p.id_comercial = c.id";
        //     else if ( $_SESSION['user'] == 'javier')
        //         $q1 = "SELECT p.*, c.nombre
        //     FROM peticiones_formativas p, comerciales c
        //     WHERE modalidad IN ('Teleformación','Presencial','Mixta')
        //     AND p.id_comercial = c.id";
        //     else
        //         $q1 = "SELECT p.*, c.nombre
        //     FROM peticiones_formativas p, comerciales c
        //     WHERE p.id_comercial = c.id ";


        // } else if ( $_SESSION[user] == 'efrencomercial' ) {

        //     $q1 = "SELECT p.*, c.nombre
        //     FROM peticiones_formativas p
        //     INNER JOIN comerciales c ON c.id = p.id_comercial
        //     WHERE id_comercial IN (4)";

        // } else if ( $_SESSION[user] == 'ana' ) {

        //     $q1 = "SELECT p.*, c.nombre
        //     FROM peticiones_formativas p
        //     INNER JOIN comerciales c ON c.id = p.id_comercial
        //     WHERE id_comercial IN (2)";

        // } else if ( $_SESSION[user] == 'gyanes' || $_SESSION[user] == 'yhernandez' ) {

        //     $q1 = "SELECT p.*, c.nombre
        //     FROM peticiones_formativas p
        //     INNER JOIN comerciales c ON c.id = p.id_comercial
        //     WHERE tiposol IN ('SM','SP')";

        // } else if ( strpos($_SESSION[user], 'asociado') ) {

        //     $q1 = "SELECT p.*, c.nombre
        //     FROM peticiones_formativas p
        //     INNER JOIN comerciales c ON c.id = p.id_comercial
        //     WHERE id_comercial IN (32)";

        // } else if ( esExterno($_SESSION[user]) ) {

        //     $q1 = "SELECT p.*,c.nombre
        //     FROM peticiones_formativas p
        //     INNER JOIN comerciales c ON c.id = p.id_comercial
        //     AND id_comercial IN (".$_SESSION[comercial].")";

        // }


        //levantamos restriccion temporalmente
        $q1 = "SELECT p.*, c.nombre
            FROM peticiones_formativas p, comerciales c
            WHERE p.id_comercial = c.id";

        $q1 .= $campos.' ORDER BY id DESC';


        if ( $_SESSION[user] == 'root') {

            echo $q1;

        }

        // echo $q1;
        $q1 = mysqli_query($link,$q1) or die("error ".mysqli_error($link));

        ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="display:none;">ID</th>
                    <th>Nº</th>
                    <!-- <th>Solicitud</th> -->
                    <th>AF</th>
                    <th>Tipo</th>
                    <th style="width:5%">Comercial</th>
                    <th style="width:25%">Denominación</th>
                    <th style="width:20%">Empresas</th>
                    <th>Modalidad</th>
                    <th>Horas</th>
                    <th>Fechas</th>
                    <!-- <th>Estado</th> -->
                    <th>Fecha Solicitud</th>
                    <th></th>
                </tr>
            </thead>
            <tbody style="font-size: 12px">
        <?

        while ($row = mysqli_fetch_array($q1)) {

            if ( $row[tiposol] == 'SM' ) {
                // echo "EY";
                $qn = 'SELECT numeroaccion, ngrupo
                FROM matriculas m, acciones a, grupos_acciones ga, peticiones_formativas p
                WHERE m.id_accion = a.id
                AND m.id_grupo = ga.id
                AND p.id = m.id_solicitud
                AND p.id = '.$row[id];
                // echo $qn;
                $qn = mysqli_query($link, $qn) or die("error:" .mysqli_error($link));

                $rowz = mysqli_fetch_array($qn);
                if ( $rowz[grupo] == 1 ) $grupo = " (G)"; else $grupo = "";

            } else unset($rowz);

            $color = colorSeguimientoIKEA($row[estado_peticion]);
            echo '<tr class="'.$color.'" style="'.$pendiente.'"><td id="id" style="display:none;">';
            echo($row[id]);
            echo "</td>";
            echo "<td>";
            echo($row[tiposol].$row[numero]);
            echo "</td>";
            // echo "<td>";
            // if ( $row[tiposol] == "SM" )
            //     echo "Matrícula";
            // else if ( $row[tiposol] == "SC" )
            //     echo "Crédito";
            // else
            //     echo "<strong>Propuesta</strong>";
            // echo "</td>";
            echo "<td>";
            if ( count($rowz) > 0 ) echo $rowz[numeroaccion].'/'.$rowz[ngrupo].$grupo;
            echo "</td>";
            echo "<td>";
            echo($row[tipoformacionpropuesta]);
            echo "</td>";
            echo "<td>";
            echo($row[nombre]);
            echo "</td>";
            echo "<td>";
            if ( $row[tiposol] == "SC" )
                print($row[cif]);
            else
                print($row[formacion]);
            echo "</td>";
            echo "<td>";
            print($row[empresas]);
            echo "</td>";
            echo "<td>";
            print($row[modalidad]);
            echo "</td>";
            echo "<td>";
            print($row[horastotales]);
            echo "</td>";
            echo '<td style="text-align:center;width:20%">';
            if ( $row[tiposol] == "SC" )
                echo(" - ");
            else if ( $row[fechaini] == "0000-00-00" )
                echo(" - ");
            else
                print(formateaFecha($row[fechaini]).' - '.formateaFecha($row[fechafin]));
            echo "</td>";
            // echo "<td>";
            // print($row[estado_peticion]);
            // echo "</td>";
            echo "<td>";
            print(formateaFecha($row[fecha_peticion]));
            echo "</td>";
            echo '<td><a id="seleccionarsolicitudpeti" name="peticiones_formativas" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';
        } ?>
            </tbody>
        </table> <?
        break;

	case 'alumnos':

		$q1 = 'SELECT id, nombre, apellido, apellido2, documento FROM alumnos WHERE '.$campos;
		// echo $q1;
		$q1 = mysqli_query($link,$q1);

		?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th style="display:none;">ID</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>2º Apellido</th>
					<th>Nº Documento</th>

				</tr>
			</thead>
			<tbody>
		<?
		while ($row = mysqli_fetch_array($q1)) {
			echo '<tr><td id="id" style="display:none;">';
			echo($row[id]);
			echo "</td>";
			echo "<td id='nombre'>";
			echo($row[nombre]);
			echo "</td>";
			echo "<td id='apellido'>";
			print($row[apellido]);
			echo "</td>";
			echo "<td>";
			print($row[apellido2]);
			echo "</td>";
			echo '<td id="documento">';
			print($row[documento]);
			echo "</td>";
			echo '<td><a id="'.$mat.'seleccionaralumno" name="alumnos" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td>';
            echo '<td><a id="formacionesAlumno" name="alumnos" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-list-alt"></span> </a></td></tr>';
		} ?>
			</tbody>
		</table> <?
		break;

	case 'empresas':

        // if ( $_SESSION['user'] == 'alago' )
        //     $campos = 'id = 6348';
		$q1 = 'SELECT id, nombrecomercial, razonsocial, cif FROM empresas WHERE '.$campos;

        // echo $q1;
		$q1 = mysqli_query($link,$q1);

		?>
		<table class="table table-striped">
			<thead>
				<tr> <!-- AQUI UN SWITCH? !-->
					<th style="display:none;">ID</th>
					<th>Empresa</th>
					<th>Nombre Fiscal</th>
					<th>CIF</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
		<?
		while ($row = mysqli_fetch_array($q1)) {
			echo '<tr><td id="id" style="display:none;">';
			echo($row[id]);
			echo "</td>";
			echo "<td>";
			echo($row[nombrecomercial]);
			echo "</td>";
			echo '<td id="empresa">';
			print($row[razonsocial]);
			echo "</td>";
			echo '<td>';
			print($row[cif]);
			echo "</td>";
			echo '<td><a id="'.$mat.'seleccionarempresa" name="empresas" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td>';
            echo '<td><a id="formacionesEmpresa" name="empresas" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-list-alt"></span> </a></td></tr>';

		} ?>
			</tbody>
		</table> <?

		if ( ($mat == 'matoini-' || $mat == 'matp-' || $mat == 'matm-') && $hayGrupo == 1) {
            echo '<a id="seleccionargrupo" style="float:right;" href="#" class="btn btn-xs btn-primary">Seleccionar todo</a>';
        }
		break;

	case 'acciones':

		if ( $sec == 'index.php?presencial')
			$q1 = 'SELECT *
			FROM acciones
			WHERE modalidad = "Presencial"
			AND '.$campos;

		else if ( $sec == 'index.php?mixto' )
			$q1 = 'SELECT *
			FROM acciones
			WHERE modalidad = "Mixta"
			AND '.$campos;

		else if ( $sec == 'index.php?matricula' )
			$q1 = 'SELECT *
			FROM acciones
			WHERE modalidad IN ("Teleformación","A Distancia")
			AND '.$campos;

		else if ( $sec == 'index.php?form_matricula_ini' )
			$q1 = 'SELECT *
			FROM acciones
			WHERE modalidad IN("Teleformación","A Distancia")
			AND '.$campos;
		else
			$q1 = 'SELECT *
			FROM acciones
			WHERE '.$campos;

        // echo $q1;

        if ( $_SESSION[user] == 'root' ) {
            echo $q1;
        }

		$q1 = mysqli_query($link,$q1);

		?>
			<table class="table table-striped">
			<thead>
				<tr> <!-- AQUI UN SWITCH? !-->
					<th style="display:none;">ID</th>
					<th>Nº Acción</th>
					<th>Nombre Acción</th>
					<th>Modalidad</th>
                    <th>Nº Horas</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
		<?
		while ($row = mysqli_fetch_array($q1)) {
            // if ($row[numeroaccion] != "0") {
			echo '<tr><td id="id" style="display:none;">';
			echo($row[id]);
			echo "</td>";
			echo "<td>";
			echo($row[numeroaccion]);
			echo "</td>";
			echo "<td>";
			print($row[denominacion]);
			echo "</td>";
			echo '<td id="modalidad">';
			print($row[modalidad]);
			echo "</td>";
            echo "<td>";
            print($row[horastotales]);
            echo "</td>";
			echo '<td><a id="'.$mat.'seleccionaraccion" name="acciones" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';
            // }
		} ?>
			</tbody>
		</table> <?
		break;

	case 'docentes':

		if ($_POST['especialidad'] != '') {
			$q1 = "SELECT d.*, GROUP_CONCAT( e.especialidad separator ', ' ) as especialidad, d.id as id_docente
            FROM docentes d, especialidades e, docente_especialidad de
            WHERE e.id = de.id_especialidad AND d.id = de.id_docente"." AND ".$campos."
            GROUP BY d.id";
            // echo $q1;
		} else {
			$q1 = "SELECT d.*, GROUP_CONCAT( e.especialidad separator ' / ' ) as especialidad, d.id as id_docente
            FROM docentes d, especialidades e, docente_especialidad de
            WHERE e.id = de.id_especialidad AND d.id = de.id_docente AND ".$campos."
            GROUP BY d.id
            UNION
            SELECT DISTINCT d.*, especialidad = '', d.id as id_docente
            FROM docentes d, especialidades e, docente_especialidad de
            WHERE d.id NOT IN (select de.id_docente from docente_especialidad de)
			AND ".$campos;
            // echo $q1;
		}

        // if (isRoot())
        //     echo $q1;
		$q1 = mysqli_query($link,$q1);

		?>
		<table class="table table-striped">
			<thead>
				<tr> <!-- AQUI UN SWITCH? !-->
					<th style="display:none;">ID</th>
					<th>Nombre</th>
					<th>Apellido</th>
                    <th>Proveedor</th>
					<th>Especialidad</th>
					<th></th>
                    <? if ( $_SESSION[user] == 'rmedina' || $_SESSION[user] == 'root' || $_SESSION[user] == 'daniel' || $_SESSION[user] == 'rmedina' ) ?>
                    <th></th>
				</tr>
			</thead>
			<tbody>
		<?
		while ($row = mysqli_fetch_array($q1)) {
			echo '<tr><td id="id" style="display:none;">';
			echo($row[id_docente]);
			echo "</td>";

			if ( $row['tipodoc'] == "Persona" || $row['tipodoc'] == "" ) {

                echo '<td id="nombre">';
                echo($row[nombre]);
                echo "</td>";
                echo '<td id="apellido">';
                echo($row[apellido]);
                echo "</td>";
                echo '<td id="proveedor">';
                echo('-');
                echo "</td>";

            } else if ( $row['tipodoc'] == "Empresa" ) {

                echo '<td id="nombredocente">';
                echo($row[nombredocente]);
                echo "</td>";
                echo '<td id="apellidodocente">';
                echo($row[apellidodocente]);
                echo "</td>";
                echo '<td id="proveedor">';
                echo($row[nombre]);
                echo "</td>";

            }

			echo '<td style="width:25%; font-size:10px;" id="especialidad">';
            if ( $row[especialidad] == '0' ) echo 'Sin especialidad';
            else echo ($row[especialidad]);
            echo "</td>";
			echo '<td><a id="'.$mat.'seleccionardocente" mat="'.$mati.'"  name="docentes" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td>';
            if ( $_SESSION[user] == 'sdaluz' || $_SESSION[user] == 'root' || $_SESSION[user] == 'daniel' || $_SESSION[user] == 'rmedina' || $_SESSION[user] == 'cmunoz' || $_SESSION[user] == 'melody' || $_SESSION[user] == 'javier' || $_SESSION[user] == 'margarita' || $_SESSION[user] == 'amanda' || $_SESSION[user] == 'ytejera' )
                echo '<td><a id="docentesacuerdos" name="docentes" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-list-alt"></span> </a></td></tr>';
            else
                echo '</tr>';
		} ?>
			</tbody>
		</table> <?

		break;

    case 'comisionistas':

        $q1 = 'SELECT * FROM comisionistas WHERE '.$campos;
        $q1 = mysqli_query($link,$q1);

        ?>

        <div class="modal-body mostrartabla">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="display:none;">ID</th>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Comercial</th>
                    <th>Contacto</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?

        while ($row = mysqli_fetch_array($q1)) {
            echo '<tr><td id="id" style="display:none;">';
            echo($row[id]);
            echo "</td>";
            echo "<td>";
            echo($row[tipocomisionista]);
            echo "</td>";
            echo "<td>";
            echo($row[nombre]);
            echo "</td>";
            echo "<td>";
            print($row[telefono]);
            echo "</td>";
            echo "<td>";
            print($row[email]);
            echo "</td>";
            echo '<td>';
            print($row[contacto]);
            echo "</td>";
            echo '<td><a id="seleccionarcomisionista" name="matriculas" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';
        } ?>
            </tbody>
        </table></div> <?
        break;

    case 'acreedores':

        $q1 = 'SELECT * FROM acreedores WHERE '.$campos;
        $q1 = mysqli_query($link,$q1);

        ?>

        <div class="modal-body mostrartabla">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="display:none;">ID</th>
                    <th>Tipo</th>
                    <th>Acreedor</th>
                    <th>CIF</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?

        while ($row = mysqli_fetch_array($q1)) {
            echo '<tr><td id="id" style="display:none;">';
            echo($row[id]);
            echo "</td>";
            echo "<td>";
            print($row[tipoacreedor]);
            echo "</td>";
            echo "<td>";
            echo($row[razonsocial]);
            echo "</td>";
            echo "<td>";
            print($row[cif]);
            echo "</td>";
            echo "<td>";
            print($row[telefono]);
            echo "</td>";
            echo "<td>";
            print($row[email]);
            echo "</td>";
            echo '<td><a id="seleccionaracreedor" name="matriculas" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';
        } ?>
            </tbody>
        </table></div> <?
        break;

	case 'matriculas':

        // if ( $_SESSION['user'] == 'alago' )
        //     $campos = ' AND a.numeroaccion >= 7000 ';

        if ( $sec == 'index.php?presencial' )

    		$q1 = 'SELECT  m.id,m.*, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado
    		FROM matriculas m, acciones a, grupos_acciones ga '.$comercialTablas2.'
    		WHERE m.id_accion = a.id'
    		.$comercial.$centro.'
    		AND ga.id = m.id_grupo
            AND m.estado NOT IN("Oculto")
    		AND a.modalidad = "Presencial"
    		'.$campos;

        else if ( $sec == 'index.php?presencial_doc' )

        	$q1 = 'SELECT  m.id,m.*, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado
            FROM matriculas m, acciones a, grupos_acciones ga '.$comercialTablas2.'
            WHERE m.id_accion = a.id'
            .$comercial.$centro.'
            AND ga.id = m.id_grupo
            AND m.estado NOT IN("Oculto")
            AND a.modalidad = "Presencial"
            '.$campos;

        else if ( $sec == 'index.php?inspeccionpm' )

            $q1 = 'SELECT  m.id,m.*, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado
            FROM matriculas m, acciones a, grupos_acciones ga '.$comercialTablas2.'
            WHERE m.id_accion = a.id'
            .$comercial.$centro.'
            AND ga.id = m.id_grupo
            AND m.estado NOT IN("Oculto")
            AND modalidad IN ("Presencial","Mixta")
            '.$campos;

        else if ( $sec == 'index.php?presencial_docm' )

            $q1 = 'SELECT  m.id,m.*, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado
            FROM matriculas m, acciones a, grupos_acciones ga '.$comercialTablas2.'
            WHERE m.id_accion = a.id'
            .$comercial.$centro.'
            AND ga.id = m.id_grupo
            AND m.estado NOT IN("Oculto")
            AND a.modalidad = "Mixta"
            '.$campos;

        else if ( $sec == 'index.php?form_docufinal') {

            $q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud, m.solicitud
            FROM matriculas m, acciones a, grupos_acciones ga
            WHERE m.id_accion = a.id
            AND ga.id = m.id_grupo
            AND m.solicitud LIKE "IK%"
            AND modalidad = "Presencial"
            AND m.estado NOT IN ("Anulada","Oculto")
            '. $campos .'
            UNION ALL
            SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud, m.solicitud
            FROM matriculas m, acciones a, grupos_acciones ga
            WHERE m.id_accion = a.id
            AND ga.id = m.id_grupo
            AND m.solicitud LIKE "IK%"
            AND modalidad = "Mixta"
            AND m.estado NOT IN ("Anulada","Oculto")
            '. $campos .'
            ORDER BY id DESC';

            // if ( $_SESSION[user] == 'root' ) {
            //     echo $q1;
            // }

        }

        else if ( $sec == 'index.php?form_listado-cuestionarioikea')

            $q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud
            FROM matriculas m, acciones a, grupos_acciones ga
            WHERE m.id_accion = a.id
            AND ga.id = m.id_grupo
            AND m.solicitud LIKE "IK%"
            AND m.estado NOT IN ("Anulada","Oculto")
            '. $campos .'
            ORDER BY id DESC';

        else if ( $sec == 'index.php?presencial_fin' )

            $q1 = 'SELECT  m.id,m.*, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado
            FROM matriculas m, acciones a, grupos_acciones ga '.$comercialTablas2.'
            WHERE m.id_accion = a.id'
            .$comercial.$centro.'
            AND ga.id = m.id_grupo
            AND m.estado NOT IN("Oculto")
            AND a.modalidad = "Presencial"
            '.$campos.'
            UNION ALL
            SELECT  m.id,m.*, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado
            FROM matriculas m, acciones a, grupos_acciones ga '.$comercialTablas2.'
            WHERE m.id_accion = a.id'
            .$comercial.$centro.'
            AND ga.id = m.id_grupo
            AND m.estado NOT IN("Oculto")
            AND a.modalidad = "Mixta"
            '.$campos;

        else if ( $sec == 'index.php?mixto' )

            $q1 = 'SELECT  m.id,m.*, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado
            FROM matriculas m, acciones a, grupos_acciones ga '.$comercialTablas2.'
            WHERE m.id_accion = a.id'
            .$comercial.$centro.'
            AND ga.id = m.id_grupo
            AND m.estado NOT IN("Oculto")
            AND a.modalidad = "Mixta"
            '.$campos;

        else if ( $sec == 'index.php?facturacion' )

            $q1 = 'SELECT m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.fechafinalizacion
            FROM matriculas m, acciones a, grupos_acciones ga
            WHERE m.id_accion = a.id
            AND ga.id = m.id_grupo
            AND (numeroaccion < 11000 OR numeroaccion >= 12000)
            AND (m.solicitud NOT LIKE "IK%" OR m.solicitud IS NULL)
            AND m.estado IN ("Finalizada", "Facturada","Liquidada", "Gratuita")
            '.$campos.'
            UNION ALL
            SELECT m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.fechafinalizacion
            FROM matriculas m, acciones a, grupos_acciones ga
            WHERE m.id_accion = a.id
            AND ga.id = m.id_grupo
            AND (numeroaccion < 11000 OR numeroaccion >= 12000)
            AND m.estado IN ("Comunicada")
            AND (m.solicitud NOT LIKE "IK%" OR m.solicitud IS NULL)
            AND ga.ngrupo LIKE "%p%"
            '.$campos.'
            ORDER BY fechafinalizacion DESC';

        else if ( $sec == 'index.php?facturacion_ikea' )

            if ( $_SESSION[user] != 'root' )
                $q1 = 'SELECT m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud, m.fechafinalizacion
                FROM matriculas m, acciones a, grupos_acciones ga
                WHERE m.id_accion = a.id
                AND ga.id = m.id_grupo
                AND (m.solicitud LIKE "IK%" OR (numeroaccion >= 6000 AND numeroaccion < 7000))
                AND m.estado IN ("Finalizada", "Facturada","Liquidada", "Gratuita")
                '.$campos.'
                ORDER BY fechafinalizacion DESC';
            else
                $q1 = 'SELECT m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, m.solicitud, m.fechafinalizacion
                FROM matriculas m, acciones a, grupos_acciones ga
                WHERE m.id_accion = a.id
                AND ga.id = m.id_grupo
                AND (m.solicitud LIKE "IK%" OR (numeroaccion >= 11000 AND numeroaccion < 12000))
                AND m.estado IN ("Finalizada", "Facturada","Liquidada", "Gratuita", "Comunicada")
                '.$campos.'
                ORDER BY fechafinalizacion DESC';

        else if ( $sec == 'index.php?form_matricula_doc' || $sec == 'index.php?form_matricula_ini' || $sec == 'index.php?form_matricula_fin' )

        	$q1 = 'SELECT  m.id,m.*, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado
            FROM matriculas m, acciones a, grupos_acciones ga ' .$comercialTablas2. '
            WHERE m.id_accion = a.id
            AND m.grupo = 1
            AND m.estado NOT IN("Oculto")
            AND ga.id = m.id_grupo'
            .$comercial.'
            AND modalidad IN("Teleformación", "A Distancia")
            '.$campos;

        else if ( $sec == 'index.php?registro-incendios' ) {

            if ( $gestion == 2014 )

                $q1 = 'SELECT  m.id,m.*, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado
                FROM matriculas m, acciones a, grupos_acciones ga '.$comercialTablas2.'
                WHERE m.id_accion = a.id'
                .$comercial.'
                AND ga.id = m.id_grupo
                AND a.modalidad IN ("Presencial")
                AND a.numeroaccion IN (17,18,1001,1006,1017,1027,106)
                AND m.estado IN ("Finalizada","Comunicada","Facturada","Liquidada","Gratuita")
                '.$campos.'
                UNION ALL
                SELECT  m.id,m.*, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado
                FROM matriculas m, acciones a, grupos_acciones ga '.$comercialTablas2.'
                WHERE m.id_accion = a.id'
                .$comercial.'
                AND ga.id = m.id_grupo
                AND a.modalidad IN ("Mixta")
                AND a.numeroaccion IN (17,18,1001,1006,1017,1027,106)
                AND m.estado IN ("Finalizada","Comunicada","Facturada","Liquidada","Gratuita")
                '.$campos;

            else

                $q1 = 'SELECT m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado
                FROM matriculas m, acciones a, grupos_acciones ga
                WHERE m.id_accion = a.id
                AND ga.id = m.id_grupo
                AND a.incendios = 1
                AND m.estado IN("Finalizada","Comunicada","Facturada","Liquidada","Gratuita")
                '.$campos.'
                ORDER BY id DESC';

        } else if ( $sec == 'index.php?inspeccion')

            $q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado,al.nombre, al.apellido
            FROM matriculas m, acciones a, grupos_acciones ga, alumnos al, mat_alu_cta_emp ma '.$comercialTablas2.'
            WHERE m.id_accion = a.id
            '.$comercial.'
            AND ga.id = m.id_grupo
            AND ma.id_matricula = m.id
            AND ma.id_alumno = al.id
            AND modalidad = "Teleformación"
            AND m.grupo IN (0,1)
            AND m.estado NOT IN ("Anulada","Oculto")
            '.$campos.'
            GROUP BY m.id
            UNION
            SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado,
            al.nombre, al.apellido
            FROM matriculas m, acciones a, grupos_acciones ga, alumnos al, mat_alu_cta_emp ma '.$comercialTablas2.'
            WHERE m.id_accion = a.id
            '.$comercial.'
            AND ga.id = m.id_grupo
            AND ma.id_matricula = m.id
            AND ma.id_alumno = al.id
            AND a.modalidad = "A Distancia"
            AND m.estado NOT IN ("Anulada","Oculto")
            '.$campos.'
            GROUP BY m.id
            ORDER BY id DESC';
// ** BORRADO DE LA LÍNEA 1266 PARA EVITAR CREAR USER POR DOCENTE AND d.id = u.id_docente
        else if ( $sec == 'index.php?tutorias' ) {

        	if ( $_SESSION['user'] == 'ana' || $_SESSION['user'] == 'root' )

				$q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, ma.progreso, ma.finalizado,
				al.nombre, al.apellido, al.id as id_alu, a.modalidad, a.url, ma.tipo
				FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, usuarios u, alumnos al, mat_alu_cta_emp ma ' .$comercialTablas. '
				WHERE m.id_accion = a.id
				AND ga.id = m.id_grupo'
				.$comercial.'
				AND m.id = md.id_matricula
				AND ma.id_matricula = m.id
				AND ma.id_alumno = al.id
				AND md.id_docente = d.id
                AND m.estado NOT IN("Oculto")
				AND a.modalidad = "Teleformación"
				
				'.$campos.'
		        UNION ALL
		        SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, ma.progreso, ma.finalizado,
		        al.nombre, al.apellido, al.id as id_alu, a.modalidad, a.url, ma.tipo
				FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, usuarios u, alumnos al, mat_alu_cta_emp ma ' .$comercialTablas. '
				WHERE m.id_accion = a.id
				AND ga.id = m.id_grupo'
				.$comercial.'
				AND m.id = md.id_matricula
				AND ma.id_matricula = m.id
				AND ma.id_alumno = al.id
				AND md.id_docente = d.id
                AND m.estado NOT IN("Oculto")
				AND a.modalidad = "A Distancia"
				AND d.id = u.id_docente
				'.$campos.'
                UNION
                SELECT  m.id, m.fechaini_nop, m.fechafin_nop, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, ma.progreso, ma.finalizado,
                al.nombre, al.apellido, al.id as id_alu, a.modalidad, a.url, ma.tipo
                FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, usuarios u, mat_alu_cta_emp ma, alumnos al
                WHERE m.id_accion = a.id
                AND ga.id = m.id_grupo
                AND m.id = md.id_matricula
                AND ma.id_matricula = m.id
                AND ma.id_alumno = al.id
                AND md.id_docente = d.id
                '.$comercial.'
                AND a.modalidad = "Mixta"
                AND a.mixta = "Teleformación"
                AND d.id = u.id_docente
                '.$campos.'
                AND m.estado NOT IN ("Anulada", "Creada")
                ORDER BY estado,fechafin,nombre ASC';

			else

				$q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, ma.progreso, ma.finalizado,
				al.nombre, al.apellido, al.id id_alu, a.modalidad, a.url, ma.tipo
				FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, usuarios u, alumnos al, mat_alu_cta_emp ma ' .$comercialTablas. '
				WHERE m.id_accion = a.id
				AND ga.id = m.id_grupo'
				.$comercial.'
				AND m.id = md.id_matricula
				AND ma.id_matricula = m.id
				AND ma.id_alumno = al.id
				AND md.id_docente = d.id
				AND a.modalidad = "Teleformación"
                AND m.estado NOT IN ("Anulada", "Creada", "Oculto")
				AND d.id = u.id_docente
		        AND u.user = "'.$_SESSION['user'].'"
		        '.$campos.'
		        UNION ALL
		        SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, ma.progreso, ma.finalizado,
		        al.nombre, al.apellido, al.id as id_alu, a.modalidad, a.url, ma.tipo
				FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, usuarios u, alumnos al, mat_alu_cta_emp ma ' .$comercialTablas. '
				WHERE m.id_accion = a.id
				AND ga.id = m.id_grupo'
				.$comercial.'
				AND m.id = md.id_matricula
				AND ma.id_matricula = m.id
				AND ma.id_alumno = al.id
				AND md.id_docente = d.id
				AND a.modalidad = "A Distancia"
                AND m.estado NOT IN ("Anulada", "Creada", "Oculto")
				AND d.id = u.id_docente
		        AND u.user = "'.$_SESSION['user'].'"
		        '.$campos.'
                UNION
                SELECT  m.id, m.fechaini_nop, m.fechafin_nop, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado, ma.progreso, ma.finalizado,
                al.nombre, al.apellido, al.id as id_alu, a.modalidad, a.url, ma.tipo
                FROM matriculas m, acciones a, grupos_acciones ga, docentes d, mat_doc md, usuarios u, mat_alu_cta_emp ma, alumnos al
                WHERE m.id_accion = a.id
                AND ga.id = m.id_grupo
                AND m.id = md.id_matricula
                AND ma.id_matricula = m.id
                AND ma.id_alumno = al.id
                AND md.id_docente = d.id
                '.$comercial.'
                AND a.modalidad = "Mixta"
                AND a.mixta = "Teleformación"
                AND d.id = u.id_docente
                '.$campos.'
                AND m.estado NOT IN ("Anulada", "Creada")
                AND u.user = "'.$_SESSION['user'].'"
				ORDER BY estado,fechafin,nombre ASC';

        } else

            $q1 = 'SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado,
        	al.nombre, al.apellido
            FROM matriculas m, acciones a, mat_alu_cta_emp ma, alumnos al, grupos_acciones ga ' .$comercialTablas2. '
            WHERE m.id_accion = a.id
            AND ma.id_matricula = m.id
            AND ma.id_alumno = al.id
            AND m.estado NOT IN("Oculto")
            AND ga.id = m.id_grupo
            AND m.grupo = 0'
            .$comercial.'
            AND a.modalidad = "Teleformación"
            '.$campos.'
            UNION ALL
            SELECT  m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, ga.ngrupo, m.estado,
            al.nombre, al.apellido
            FROM matriculas m, acciones a, mat_alu_cta_emp ma, alumnos al, grupos_acciones ga ' .$comercialTablas2. '
            WHERE m.id_accion = a.id
            AND ma.id_matricula = m.id
            AND ma.id_alumno = al.id
            AND m.estado NOT IN("Oculto")
            AND m.grupo = 0
            AND ga.id = m.id_grupo'
            .$comercial.'
            AND a.modalidad = "A Distancia"
            '.$campos.'
            ORDER BY id DESC';

        if ( isRoot() ) {
            echo "SQL: ".$q1. " comercial: ".$comercial;
        }

		$q1 = mysqli_query($link,$q1) or die("error " . mysqli_error($link));
        $nrows = mysqli_num_rows($q1);

		if ( $sec == 'index.php?tutorias' ) { ?>

			<table id="tablamatriculas" class="table table-striped">
				<thead>
					<tr> <!-- AQUI UN SWITCH? !-->
						<th style="display:none;">ID</th>
						<th>Acción</th>
						<th>Denominación</th>
						<th>Alumno</th>
                        <th>Modalidad</th>
						<th>Progreso</th>
						<th>Estado</th>
						<th>Inicio</th>
						<th>Fin</th>
						<th></th>
					</tr>
				</thead>
				<tbody> <?

                // if ( isRoot() ) echo $row[tipo];
			while ($row = mysqli_fetch_array($q1)) {

				echo '<tr style="font-size: 12px" class="'; echo colorFinalizacion($row[finalizado], $row[tipo]); echo '"><td id="id" style="display:none;">';
				echo($row[id]);
				echo "</td>";
                // echo "<td>".$row['tipo'].colorFinalizacion($row[finalizado], $row[tipo])."</td>";
				echo "<td>";
				echo($row[numeroaccion].'/'.$row[ngrupo]);
				echo "</td>";
				echo '<td style="width:45%">';
				print($row[denominacion]);
				echo "</td>";
				echo '<td style="width:25%">';
				print($row[nombre].' '.$row[apellido]);
				echo "</td>";
                echo "<td>". $row[modalidad] ."</td>";
				echo '<td style="width: 15%">';
				print($row[progreso].'% | ');

                if ($row[finalizado] == '0') echo 'En Progreso';
                else if ($row[finalizado] == '1') echo 'Finalizado';
                else echo 'NO Finalizado';

				echo "</td>";
				echo "<td>";
				print($row[estado]);
				echo "</td>";
				echo "<td>";
				print(date("d/m/Y", strtotime($row[fechaini])));
				echo "</td>";
				echo '<td>';
				print(date("d/m/Y", strtotime($row[fechafin])));
				echo "</td>";
                echo '<td>';
                if ( strpos($row[url], 'campus') )
                    echo 'Moodle';
                else
                    echo 'System';
            echo '</td>';

				echo '<td><a id="'.$mat.'seleccionarmat" id_alu="'.$row[id_alu].'" name="matriculas" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';

				} ?>
					</tbody>
				</table> <?

		} else { ?>

			<table id="tablamatriculas" class="table table-striped">
			<thead>
				<tr> <!-- AQUI UN SWITCH? !-->
					<th <? if ( $_SESSION[user] != 'root') echo 'style="display:none;"' ?>>ID</th>
					<th>Acción</th>
					<th>Denominación</th>
					<? if ( $sec == 'index.php?matricula' ) { ?>
					<th>Alumno</th> <? } ?>
					<th>Estado</th>
					<th>Inicio</th>
					<th>Fin</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
		<?

        $i = 0;
		while ($row = mysqli_fetch_array($q1)) {

            $i++;
            $ids .= $row[id];
            if ( $i != $nrows )
                $ids .= ',';

            echo '<tr style="font-size: 12px" class="'; echo colorSeguimientoEstado($row[estado]); echo '">
            <td id="id"';
            if ($_SESSION[user] != 'root') echo 'style="display:none;">';
            else echo '>';
            echo($row[id]);
            echo "</td>";
            echo "<td id='af'>";
            if ( strpos($row[solicitud],'IK') !== FALSE )
                    $ikea = ' <strong>IKEA</strong> ';
            else $ikea = '';
            echo($ikea . '<strong>'.$row[numeroaccion].'/'.$row[ngrupo].'</strong>');
            echo "</td>";
            echo '<td id="denominacion" style="width:35%">';
            print($row[denominacion]);
            echo "</td>";
            if ( ( $sec == 'index.php?form_docufinal' ) ) {
                if ( ( strpos($row[solicitud],'IK') === FALSE ) ) {
                    echo "<td id='modalidad'>";
                    print($row[modalidad]);
                    echo "</td>";
                    echo "<td id='centro'>";
                    print($row[nombrecentro]);
                    echo "</td>";
                }
            }
            if ( $sec == 'index.php?matricula' ) {
                echo '<td style="width:25%">';
                print($row[nombre].' '.$row[apellido]);
                echo "</td>";
            }

            echo "<td id='estado'>";

            if ( $sec == 'index.php?presencial_fin' || $sec == 'index.php?form_matricula_fin' ) {

                $estado = devuelveNoFinBonif($row[estado], $row[ngrupo], $row[numeroaccion]);
                echo $estado;

            } else
                echo($row[estado]);

            echo "</td>";

            echo "<td id='fechaini'>";
            print(date("d/m/Y", strtotime($row[fechaini]))).'<br>';
            if ( $row[fechaini_nop] != "" && $row[fechaini_nop] != "0000-00-00" ) print(date("d/m/Y", strtotime($row[fechaini_nop])).' O/D');
            echo "</td>";
            echo '<td id="fechafin">';
            print(date("d/m/Y", strtotime($row[fechafin]))).'<br>';
            if ( $row[fechafin_nop] != "" && $row[fechafin_nop] != "0000-00-00" ) print(date("d/m/Y", strtotime($row[fechafin_nop])).' O/D');
            echo "</td>";

            echo '<td><a id="'.$mat.'seleccionarmat" name="matriculas" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';
		} ?>
			</tbody>
		</table> <?

        if ( $sec == 'index.php?facturacion' && $_SESSION['user'] == 'root' ) {

                echo '<div style="margin-right: 2px; display:none" class="col-md-2 pull-right"><a ids="'.$ids.'" id="facturartodo" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span> Facturar todo</a></div>
                <div class="clearfix"></div>';

            }
        }

		break;

        case 'peticiones_gastos':

        if ( $tabla == 'peticiones_gastos' ) {


            if ( $_SESSION['user'] == 'oscar' || $_SESSION['user'] == 'isabel' || $_SESSION['user'] == 'amparo' )

                $q1 = "SELECT CONCAT(tiposol, '', LPAD(numero, 4, 0)), fecha, c.nombre, estado, motivogasto, p.id
                FROM peticiones_gastos p, comerciales c
                WHERE c.id = p.id_comercial
                AND id_comercial IN (3,7,12)
                ".$campos."
                ORDER BY id DESC";

            else if ( $_SESSION['user'] == 'cmunoz' || $_SESSION['user'] == 'sdaluz' || $_SESSION['user'] == 'daniel' || $_SESSION['user'] == 'root' )

                $q1 = 'SELECT CONCAT(tiposol, "", LPAD(numero, 4, 0)), fecha, c.nombre, estado, motivogasto, p.id
                    FROM peticiones_gastos p, comerciales c
                    WHERE p.id_comercial = c.id
                    '.$campos.'

                    UNION

                    SELECT CONCAT(tiposol, "", LPAD(numero, 4, 0)), fecha, c.nombre, estado, motivogasto, p.id
                    FROM peticiones_gastos p, docentes c
                    WHERE p.id_docente_peticion = c.id
                    '.$campos.'
                    ORDER BY id DESC';

            else if ( strpos($_SESSION['user'], 'tutor') !== false )

                $q1 = 'SELECT CONCAT(tiposol, "", LPAD(numero, 4, 0)), fecha, c.nombre, estado, motivogasto, p.id
                    FROM peticiones_gastos p, docentes c, usuarios u
                    WHERE p.id_docente_peticion = c.id
                    AND u.id_docente = c.id AND u.user = "'.$_SESSION['user'].'"
                    '.$campos.'
                    ORDER BY id DESC';

            else

                $q1 = 'SELECT CONCAT(tiposol, "", LPAD(numero, 4, 0)), fecha, c.nombre, estado, motivogasto, p.id
                    FROM peticiones_gastos p, comerciales c, usuarios u
                    WHERE p.id_comercial = c.id
                    AND u.id_comercial = c.id AND u.user = "'.$_SESSION['user'].'"
                    '.$campos.'
                    ORDER BY id DESC';
        }

        ?>
            <div style="margin-top:0px" class="modal-header camposbusqueda">
                <form role="form" action="" method="post" id="form-modal">
                <input name="tabla" type="hidden" id="tabla" value="peticiones_formativas" />
                <input name="matricula" type="hidden" id="matricula" value="<? echo($mat); ?>" />
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="modalidad">Modalidad:</label><br>
                        <select class="form-control" id="modalidad" name="modalidad" >
                            <?

                                echo '<option value="">Cualquiera</option>';
                                echo '<option value="Presencial">Presencial</option>';
                                echo '<option value="Teleformación">Teleformación</option>';
                                echo '<option value="Mixta">Mixta</option>';

                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="tiposol">Tipo Solicitud:</label><br>
                        <select class="form-control" id="tiposol" name="tiposol" >
                            <?

                                echo '<option value="">Cualquiera</option>';
                                echo '<option value="SM">Matrícula</option>';
                                echo '<option value="SC">Crédito</option>';
                                echo '<option value="SP">Propuesta</option>';
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label" for="estado_peticion">Estado:</label><br>
                        <select class="form-control" id="estado_peticion" name="estado_peticion" >
                            <?

                                echo '<option value="">Cualquiera</option>';
                                echo '<option value="Pendiente">Pendiente</option>';
                                echo '<option value="Aceptada">Aceptada</option>';
                                echo '<option value="Resuelta">Resuelta</option>';
                                echo '<option value="Realizada">Realizada</option>';
                                echo '<option value="Anulada">Anulada</option>';

                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label" for="numero">Número:</label>
                        <input type="text" id="numero" name="numero" class="required form-control" />
                    </div>
                </div>
                <div class="col-md-1">
                    <a style="margin-top: 24px;" id="busqueda" style="pointer-events:none" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-3" style="margin-top: 15px">
                            <div class="form-group">
                               <label class="control-label" for="id_comercial">Comercial:</label>
                                    <select id="id_comercial" name="id_comercial" class="form-control">
                                    <?

                                        devuelveComercialesBusqueda($_SESSION[user], $link);

                                    ?>
                                    </select>
                            </div>
                        </div>
                <div class="col-md-3" style="margin-top: 15px">
                <div class="form-group">
                        <label class="control-label" for="mes">Mes de Inicio:</label>
                        <select id="mes" name="mes" class="form-control" >
                            <option value="">Cualquiera</option>
                            <option value="01">Enero</option>
                            <option value="02">Febrero</option>
                            <option value="03">Marzo</option>
                            <option value="04">Abril</option>
                            <option value="05">Mayo</option>
                            <option value="06">Junio</option>
                            <option value="07">Julio</option>
                            <option value="08">Agosto</option>
                            <option value="09">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>
                </div>
                </form>
            </div>

        <?

            $headers = array('Número', 'Fecha Petición', 'Usuario', 'Estado', 'Motivo', '');

            while ($row = mysqli_fetch_assoc($q1)) {
                $datos[] = $row;
            }

            arrayTable($headers, $datos, false, true, 'seleccionargasto', 'peticiones_gastos');

        break;


}

?>
