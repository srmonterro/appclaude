<?
header('Content-type: text/xml');
$filename="alumnos";
header('Content-Disposition: attachment; filename="'.$filename.'.xml"');
include_once 'funciones.php';

$text ='<?xml version="1.0" encoding="UTF-8"?>
<grupos xmlns="http://www.fundaciontripartita.es/schemas">
	<grupo>
		<idAccion>'.$_POST['accion'].'</idAccion>
		<idGrupo>'.$_POST['grupo'].'</idGrupo>
		<participantes>';

if (($gestor = fopen("exportar/test6.csv", "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor,",")) !== FALSE) {
        $numero = count($datos);
        $text.='
        <participante>
			<nif>'.$datos[3].'</nif>
			<N_TIPO_DOCUMENTO>'.nifonie($datos[3]).'</N_TIPO_DOCUMENTO>
			<nombre>'.$datos[2].'</nombre>
			<primerApellido>'.$datos[0].'</primerApellido>
			<segundoApellido>'.$datos[1].'</segundoApellido>
			<niss>'.$datos[4].'</niss>
			<cifEmpresa>'.$datos[6].'</cifEmpresa>
			<ctaCotizacion>'.$datos[7].'</ctaCotizacion>
			<fechaNacimiento>'.$datos[8].'</fechaNacimiento>
			<sexo>'.cambioDeSexo($datos[9]).'</sexo>
			<discapacidad>'.adivinaBooleano($datos[10]).'</discapacidad>
			<afectadosTerrorismo>'.adivinaBooleano($datos[11]).'</afectadosTerrorismo>
			<afectadosViolenciaGenero>'.adivinaBooleano($datos[12]).'</afectadosViolenciaGenero>
			<categoriaprofesional>'.adivinaCategoria($datos[13],$datos[14]).'</categoriaprofesional>
			<grupocotizacion>'.$datos[14].'</grupocotizacion>
			<nivelestudios>'.adivinaEstudios($datos[15],$datos[14]).'</nivelestudios>
			</participante>';
    } 
}
    $text .= '
	</participantes>
	<costes>
		<coste>
			<cifagrupada>A00000000</cifagrupada>
			<directos>1500</directos>
			<asociados>2000</asociados>
			<salariales>1500</salariales>
			<periodos>
				<periodo>
					<mes>10</mes>
					<importe>900</importe>
				</periodo>
				<periodo>
					<mes>11</mes>
					<importe>100</importe>
				</periodo>
			</periodos>
		</coste>
		<coste>
			<cifagrupada>B00000000</cifagrupada>
			<directos>400</directos>
			<asociados>500</asociados>
			<salariales>300</salariales>
		</coste>
	</costes>
</grupo>
</grupos>';
fclose($gestor);
echo $text;

?>