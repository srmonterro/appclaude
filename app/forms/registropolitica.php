
<div style="margin-top: 30px" class="container">

	<ol class="breadcrumb">
      <li>Calidad y Medioambiente</li>
      <li class="active">Registro Envíos Política</li>
	</ol>

<?  

		$q = 'SELECT * 
	    FROM registro_emails
	    WHERE titulo LIKE "%Información sobre la Política de Calidad y Medioambiente de ESFOCC%"
		ORDER BY fecha DESC
		LIMIT 0,50';   
		// echo $q;
		$q = mysqli_query($link, $q) or die("error" . mysqli_query($link) );

		echo 
	    	'<table class="table table-striped">
            <thead>
                <tr> 
                    <th style="display:none;">ID</th>
                    <th>Fecha</th>
                    <th>Para</th>
                    <th>Título</th>
                </tr>
            </thead>
            <tbody>';

	    while ( $row = mysqli_fetch_array($q) ) {

			echo '<tr>';
			echo '<td style= "display:none">'. $row[id] .'</td>';
			echo '<td>'. formateaFechaHora( $row[fecha] ) .'</td>';
			echo '<td>'. $row[para] .'</td>';
			echo '<td>'. $row[titulo] .'</td>';
	        echo '</tr>';
	        
	    }

	    echo '</tbody>
	    </table>';



?>

</div>