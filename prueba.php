<?

include('functions/funciones.php');
$link = connect(2017);

for ($i=1; $i <= 12; $i = $i+3) {



// num alumnos por centro
	// $q = 'select count(m.id) as cuenta from centros c
	// inner join matriculas m on c.id_matricula = m.id
	// where nombrecentro not like "%esfocc%"
	// and fechafin >= "2016-'.$i.'-01" and fechafin <= "2016-'.$i.'-31"';
	// $q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));
	// $row = mysqli_fetch_assoc($q);
	// echo "<br>MES: ".$i." -> CUENTA NO ESFOCC: ".$row['cuenta']."<br>";

	// $q = 'select count(m.id) as cuenta from centros c
	// inner join matriculas m on c.id_matricula = m.id
	// where nombrecentro like "%esfocc sur%"
	// and fechafin >= "2016-'.$i.'-01" and fechafin <= "2016-'.$i.'-31"';
	// $q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));
	// $row = mysqli_fetch_assoc($q);
	// echo "<br>MES: ".$i." -> CUENTA ESFOCC SUR: ".$row['cuenta']."<br>";



	// $q = 'select count(m.id) as cuenta from centros c
	// inner join matriculas m on c.id_matricula = m.id
	// where nombrecentro like "%ESFOCC LA LAGUNA (VOLCAN ELENA)%" OR (nombrecentro like "%ESFOCC LA LAGUNA%" AND direccioncentro like "%C/VOLCAN ELENA 24º A  TRASERA AVENIDA EL PASO LA LAGUNA %")
	// and fechafin >= "2016-'.$i.'-01" and fechafin <= "2016-'.$i.'-31"';
	// $q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));
	// $row = mysqli_fetch_assoc($q);
	// echo "<br>MES: ".$i." -> CUENTA VOLCAN ELENA: ".$row['cuenta']."<br>";


	// $q = 'select count(m.id) as cuenta from centros c
	// inner join matriculas m on c.id_matricula = m.id
	// where nombrecentro like "%ESFOCC LA LAGUNA (ANTIGUA DIRECCIÓN)%"
	// and fechafin >= "2016-'.$i.'-01" and fechafin <= "2016-'.$i.'-31"';
	// $q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));
	// $row = mysqli_fetch_assoc($q);
	// echo "<br>MES: ".$i." -> CUENTA CALLE SOL: ".$row['cuenta']."<br>";


	// $q = 'select count(m.id) as cuenta from centros c
	// inner join matriculas m on c.id_matricula = m.id
	// where nombrecentro like "%CENTRO DE FORMACIÓN ESFOCC - LAS PALMAS%"
	// and fechafin >= "2016-'.$i.'-01" and fechafin <= "2016-'.$i.'-31"';
	// $q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));
	// $row = mysqli_fetch_assoc($q);
	// echo "<br>MES: ".$i." -> CUENTA LAS PALMAS: ".$row['cuenta']."<br>";

	// echo "<hr>";

	if ( $i > 1 ) {
		$j = $i+2;
	} else {
		$j = 3;
	}

	$q = 'select count(p.id) as cuenta from peticiones_formativas p
	where p.tiposol = "SP" and estado_peticion IN("Aceptada", "Realizada")
	and fecha_peticion >= "2017-'.$i.'-01" and fecha_peticion <= "2017-'.$j.'-31"';
	// echo $q."<br><br>";
	$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));
	$row = mysqli_fetch_assoc($q);
	echo "<br>MES ".$i." -> ".$j." : ".$row['cuenta']." peticiones aceptadas<br>";
	$cuenta_aceptadas += $row['cuenta'];


}

echo "<br><hr><br>";

for ($i=1; $i <= 12; $i++) {


	$q = 'select count(p.id) as cuenta from peticiones_formativas p
	where p.tiposol = "SP" and estado_peticion IN("Aceptada", "Realizada")
	and fecha_peticion >= "2017-'.$i.'-01" and fecha_peticion <= "2017-'.$i.'-31"';
	// echo $q."<br><br>";
	$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));
	$row = mysqli_fetch_assoc($q);
	// echo "<br>MES ".$i." -> ".$j." : ".$row['cuenta']." peticiones aceptadas<br>";
	$cuenta_aceptadas = $row['cuenta'];

	$q = 'select count(p.id) as cuenta from peticiones_formativas p
	where p.tiposol = "SP"
	and fecha_peticion >= "2017-'.$i.'-01" and fecha_peticion <= "2017-'.$i.'-31"';
	// echo $q."<br><br>";
	$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));
	$row = mysqli_fetch_assoc($q);

	$cuenta_totales = $row['cuenta'];

	echo "MES ".$i." : ".$cuenta_aceptadas." / ".$cuenta_totales."<br><br>";
	// echo "TOTALES ACEPTADAS :".$cuenta_aceptadas."<br>";
	// echo "TOTALES :".$cuenta_totales."<br>";

}





?>