<?

include_once './funciones.php';

if ( $_POST['devolvermatt'] == '1' )
	devolverDatosTutoria($_POST['id_mat'], $_POST['id_alu'], $link);
else if ( $_POST['guardarcontactot'] == '1' )
	guardarContactoTutoria($_POST, $link);
else if ( $_POST['guardarcontactotodos'] == '1' )
	guardarContactoTutoriaTodos($_POST, $link);
else if ( $_POST['actualizaprogre'] == '1' )
	actualizaProgreso($_POST['id_mat'], $_POST['id_alu'], $_POST['progreso'], $link);
else if ( $_POST['actualizaprogre'] == '2' )
	actualizaProgreso2($_POST['id_mat'], $_POST['id_alu'], $_POST['progreso'], $link);
else if ( $_POST['actualizadedicacion'] == '1' )
	actualizaDedicacion($_POST['id_mat'], $_POST['id_alu'], $_POST['dedicacion'], $link);
else if ( $_POST['cargarcontactost'] == '1' )
	cargarContactosTutoria($_POST['id_mat'], $_POST['id_alu'], $link);
else if ( $_POST['actcontactost'] == '1' )
	actualizarContactoTutoria($_POST, $link);
else if ( $_POST['cambiaestadofor'] == '1' )
	actualizaEstadoFormacion($_POST['id_mat'], $_POST['id_alu'], $_POST['finalizado'], $link );
else if ( $_POST['devuelvenumcontacto'] == '1' )
	devuelveNumContacto($_POST['id_mat'], $_POST['id_alu'], $link);
else if ( $_POST['actualizaemailtutoria'] == '1' )
	actualizaEmailTutoria($_POST[email], $_POST[id_alumno], $link);


function actualizaEmailTutoria($email, $id_alumno, $link) {

	$q = 'UPDATE alumnos SET email = "'.$email.'" WHERE id = "'.$id_alumno.'"';
	// echo $q;
    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

}


function actualizaEstadoFormacion($id_mat, $id_alu, $finalizado, $link) {


	if ( $finalizado == 3 ) {

		$q = 'UPDATE mat_alu_cta_emp SET finalizado = "1", tipo = "Privado"
		WHERE id_matricula = "'.$id_mat.'" AND id_alumno = "'. $id_alu .'"';

	} else {

		$q = 'UPDATE mat_alu_cta_emp SET finalizado = "'. $finalizado .'"
		WHERE id_matricula = "'.$id_mat.'" AND id_alumno = "'. $id_alu .'"';
		// echo $q;
	}

	$q = mysqli_query($link, $q) or die("error " .mysqli_error($link));


	if ( $finalizado == '1' ) {

		$q = 'SELECT a.numeroaccion, ga.ngrupo
		FROM matriculas m, acciones a, grupos_acciones ga
		WHERE m.id_accion = a.id
		AND ga.id = m.id_grupo
		AND m.id = '.$id_mat;
		$q = mysqli_query($link, $q);

		$row = mysqli_fetch_assoc($q);
		$naccion = $row[numeroaccion];
		$ngrupo = $row[ngrupo];

		enviarMailNotif($naccion, $ngrupo, 'act-fin', $link, '', $_SESSION[user]);

	}

}

function devuelveNumContacto($id_mat, $id_alu, $link) {

	$q = 'SELECT count(*) as ncontactos FROM contactos_tutorias
	WHERE id_alumno = '.$id_alu.' AND id_matricula = '.$id_mat;
	$q = mysqli_query($link, $q);

	$row = mysqli_fetch_row($q);
	$ncontacto = $row[0] + 1;
	echo ($ncontacto);


}

function devolverDatosTutoria($id_mat, $id_alu, $link) {

	$q = 'SELECT a.id AS id_alumno, a.nombre, a.apellido, a.apellido2, a.email, a.telefono, a.tlftrabajo, m.*, ac.*, ga.ngrupo, m.id as id_matricula, mp.progreso, mp.finalizado, mp.tipo, mp.progreso2, mp.dedicacion
	FROM mat_alu_cta_emp mp, matriculas m, alumnos a, grupos_acciones ga, acciones ac
	WHERE mp.id_matricula = m.id
	AND mp.id_alumno = a.id
	AND m.id_accion = ac.id
    AND m.id_grupo = ga.id
    AND a.id = '.$id_alu.'
	AND m.id = '.$id_mat;
	// echo $q;
	$q = mysqli_query($link, $q);

	$row = array();
	while ($r = mysqli_fetch_assoc($q)) {
		$row[0] = $r;
	}

	echo json_encode($row);

}


function cargarContactosTutoria($id_mat, $id_alu, $link) {

	$q = 'SELECT c.* FROM contactos_tutorias c
	WHERE c.id_matricula = '.$id_mat.' AND c.id_alumno = '.$id_alu.'
	ORDER BY fechacontacto ASC';
	//echo $q;
	$q = mysqli_query($link, $q);

	while ( $r = mysqli_fetch_assoc($q) ) {

		echo '
		<div id="contactostutoria'.$r[numcontacto].'" style="overflow: auto;margin-top: 25px; border-bottom: 1px solid #ccc">
		  <input type="hidden" id="id_contacto'.$r[numcontacto].'" value="'. $r[id] .'">
		  <input type="hidden" id="id_alumno" value="'. $id_alu .'">
		  <div class="col-md-1">
		    <div class="form-group">
		      <label class="control-label" for="numcontacto">
		        Nº:
		      </label>
		      <input value="'. $r[numcontacto] .'" type="text" id="numcontacto" name="numcontacto" class="form-control" readonly/>
		    </div>
		  </div>
		  <div class="col-md-2">
		    <div class="form-group">
		      <label class="control-label" for="fechacontacto">
		        Fecha:
		      </label>
		      <input value="'. date("d/m/Y H:i", strtotime($r[fechacontacto])) .'" type="text" id="fechacontacto" name="fechacontacto" class="form-control"/>
		    </div>
		  </div>
		  <div class="col-md-2">
		    <div class="form-group">
		      <label class="control-label" for="tipocontacto">
		        Contacto:
		      </label>
		      <select name="tipocontacto" id="tipocontacto" class="form-control">
		        <option value="correopla" ';  if ( $r[tipocontacto] == 'correopla' ) echo 'selected '; echo '>
		          Correo (plataforma)
		        </option>
		        <option  value="correoper" ';  if ( $r[tipocontacto] == 'correoper' ) echo 'selected '; echo '>
		          Correo (personal)
		        </option>
		        <option value="telefono" ';  if ( $r[tipocontacto] == 'telefono' ) echo 'selected '; echo '>
		          Teléfono
		        </option>
		        <option value="sms" ';  if ( $r[tipocontacto] == 'sms' ) echo 'selected '; echo '>
		          SMS
		        </option>
		        <option value="seguimiento" ';  if ( $r[tipocontacto] == 'seguimiento' ) echo 'selected '; echo '>
		          Seguimiento
		        </option>
		        <option value="foro" ';  if ( $r[tipocontacto] == 'foro' ) echo 'selected '; echo '>
		          Foro
		        </option>
		        <option value="whatsapp" ';  if ( $r[tipocontacto] == 'whatsapp' ) echo 'selected '; echo '>
		          WhatsApp
		        </option>
		      </select>
		    </div>
		  </div>
		  <div class="col-md-4">
		    <div class="form-group">
		      <label class="control-label" for="contenido">
		        Contenido Tutorización:
		      </label>
		      <textarea rows="3" class="form-control" id="contenido" name="contenido">'.$r[contenido].'</textarea>
		    </div>
		  </div>
		  <div class="col-md-3">
		    <div class="form-group">
		      <label class="control-label" for="respuesta">
		        Respuesta:
		      </label>
		      <textarea rows="3" class="form-control" id="respuesta" name="respuesta">'. $r[respuesta] .'</textarea>
		    </div>
		  </div>
		  <a style="margin-left: 15px; margin-top: -40px" id="actcontactotuto" name="'. $r[numcontacto] .'" class="btn btn-xs btn-primary">
		    Actualizar Contacto
		  </a>
		</div>';

	}

}

function guardarContactoTutoria($values, $link) {

	// fecha-hora en formato SQL
    $fechasql = preg_split('/\s+/', $values[fechacontacto]);
    $fecha = $fechasql[0];
    $horas = $fechasql[1];
	$fechasql = split("/", $fecha);
	$dias = $fechasql[0];
	$mes = $fechasql[1];
	$ano = $fechasql[2];
	$fechafinal = $ano.'-'.$mes.'-'.$dias.' '.$horas;

	$q = 'INSERT INTO `contactos_tutorias`
	(`numcontacto`, `fechacontacto`, `tipocontacto`, `contenido`, `respuesta`, `id_matricula`, `id_alumno`)
	VALUES
	("'. $values[numcontacto] .'","'. $fechafinal .'","'. $values[tipocontacto] .'","'. addslashes($values[contenido]) .'","'. addslashes($values[respuesta]) .'",
		"'. $values[id_matricula] .'","'. $values[id_alumno] .'")';
	echo $q;
	$q = mysqli_query($link, $q);

}

function guardarContactoTutoriaTodos($values, $link) {

	// fecha-hora en formato SQL
    $fechasql = preg_split('/\s+/', $values[fechacontacto]);
    $fecha = $fechasql[0];
    $horas = $fechasql[1];
	$fechasql = split("/", $fecha);
	$dias = $fechasql[0];
	$mes = $fechasql[1];
	$ano = $fechasql[2];
	$fechafinal = $ano.'-'.$mes.'-'.$dias.' '.$horas;

	$q = 'SELECT *
    FROM alumnos a, mat_alu_cta_emp ma
    WHERE ma.id_matricula = '.$values[id_matricula].'
    AND ma.id_alumno = a.id';
    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

    // echo "<pre>";
    $i = 0;
    while ( $row = mysqli_fetch_array($q) ) {
    	$i++;

        $qx = 'INSERT IGNORE INTO `contactos_tutorias` (`numcontacto`, `fechacontacto`, `tipocontacto`, `contenido`, `respuesta`, `id_matricula`, `id_alumno`)
		VALUES
		("'. $values[numcontacto] .'","'. $fechafinal .'","'. $values[tipocontacto] .'","'. addslashes($values[contenido]) .'","'. addslashes($values[respuesta]) .'",
		"'. $values[id_matricula] .'","'. $row[id_alumno] .'")';
		// echo $qx;
		$qx = mysqli_query($link, $qx) or die("error:" .mysqli_error($link));

    }
    // echo "</pre>";
    // echo $i;


	// $q = 'INSERT INTO `contactos_tutorias`
	// (`numcontacto`, `fechacontacto`, `tipocontacto`, `contenido`, `respuesta`, `id_matricula`, `id_alumno`)
	// VALUES
	// ("'. $values[numcontacto] .'","'. $fechafinal .'","'. $values[tipocontacto] .'","'. addslashes($values[contenido]) .'","'. addslashes($values[respuesta]) .'",
	// 	"'. $values[id_matricula] .'","'. $values[id_alumno] .'")';
	// echo $q;
	// $q = mysqli_query($link, $q);

}


function actualizarContactoTutoria($values, $link) {

	// fecha-hora en formato SQL
    $fechasql = preg_split('/\s+/', $values[fechacontacto]);
    $fecha = $fechasql[0];
    $horas = $fechasql[1];
	$fechasql = split("/", $fecha);
	$dias = $fechasql[0];
	$mes = $fechasql[1];
	$ano = $fechasql[2];
	$fechafinal = $ano.'-'.$mes.'-'.$dias.' '.$horas;

	$q = 'UPDATE contactos_tutorias SET
	fechacontacto = "'. $fechafinal .'", tipocontacto = "'. $values[tipocontacto] .'", contenido = "'. addslashes($values[contenido]) .'",
	respuesta = "'. addslashes($values[respuesta]) .'"
	WHERE id_matricula = '. $values[id_matricula].' AND id_alumno = '. $values[id_alumno].' AND id = '.$values[id];
	// echo $q;
	$q = mysqli_query($link, $q);

}


function actualizaProgreso($id_mat, $id_alu, $progreso, $link) {

	$q = 'UPDATE mat_alu_cta_emp SET progreso = "'. $progreso .'"
	WHERE id_matricula = "'.$id_mat.'" AND id_alumno = "'. $id_alu .'"';
	echo $q;
	$q = mysqli_query($link, $q);

}

function actualizaProgreso2($id_mat, $id_alu, $progreso, $link) {

	$q = 'UPDATE mat_alu_cta_emp SET progreso2 = "'. $progreso .'"
	WHERE id_matricula = "'.$id_mat.'" AND id_alumno = "'. $id_alu .'"';
	echo $q;
	$q = mysqli_query($link, $q);

}

function actualizaDedicacion($id_mat, $id_alu, $dedicacion, $link) {

	$q = 'UPDATE mat_alu_cta_emp SET dedicacion = "'. $dedicacion .'"
	WHERE id_matricula = "'.$id_mat.'" AND id_alumno = "'. $id_alu .'"';
	echo $q;
	$q = mysqli_query($link, $q);

}


?>