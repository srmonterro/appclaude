<div style="margin-top: 45px" class="container">
	
	<input name="matricula" type="hidden" id="matricula" value="" />
	<input name="id_matricula" type="hidden" id="id_matricula" value="" />	
	<input name="id_accion" type="hidden" id="id_accion" value="" />
    <input name="id_alumno" type="hidden" id="id_alumno" value="" />
<!--     <div style="display:none" id="confirmacion" class="inv alert alert-success">Progreso guardado. Acuérdate de ir actualizándolo a medida que el alumno va avanzando en la formación.</div>
    <div style="display:none" id="error" class="alert alert-danger">Error.</div> -->


	<ol class="breadcrumb">
      <li>IKEA</li>
      <li class="active">Contactos</li>
	</ol>

	<?

	$q = 'SELECT *
	FROM usuarios
	WHERE user LIKE "%ikea_%"';
	// echo $q;
    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

    echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr> 
                        <th>Usuario</th>
                        <th>Nombre</th>                           
                        <th>Cargo</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>';
    while ( $row = mysqli_fetch_array($q) ) {

    	echo '<tr>';
		echo '<td>'.$row[user].'</td>';
		echo '<td>'.$row[nombre].'</td>';
		echo '<td>'.$row[cargo].'</td>';
		echo '<td>'.$row[email].'</td>';
        echo '</tr>';

    }
    echo '</tbody></table>';
    

	?>

</div>

