<?

if ($_GET['id_matricula'])
    $id_mat = $_GET['id_matricula'];

include_once ('../functions/funciones.php');

$sql = 'SELECT DISTINCT a.numeroaccion, ga.ngrupo, a.modalidad, m.fechaini, m.fechafin
    FROM matriculas m, acciones a, grupos_acciones ga
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id ='.$id_mat;
    $sql = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_array($sql)) {
        $naccion = $row[numeroaccion];
        $ngrupo = $row[ngrupo];
        $modalidad = $row[modalidad];
        $fechaini = $row[fechaini];
        $fechafin = $row[fechafin];
    }

header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="'.$naccion.'.'.$ngrupo.'fin.xml"');


$text ='<?xml version="1.0" encoding="UTF-8"?>
<grupos xmlns="http://www.fundaciontripartita.es/schemas">
    <grupo>
        <idAccion>'.$naccion.'</idAccion>
        <idGrupo>'.$ngrupo.'</idGrupo>
        <participantes>
        ';

$sql = 'SELECT DISTINCT e.id, e.cif, e.razonsocial, a.* , m.numerocuenta
    FROM alumnos a, empresas e, mat_alu_cta_emp m
    WHERE m.id_alumno = a.id
    AND m.id_empresa = e.id
    AND m.finalizado = 1
    AND mes_bonificable <> 0
    AND m.id_matricula = '.$id_mat.'
    AND m.tipo = ""';
    $sql = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($sql)) {

$text.='<participante>
        <nif>'. $row[documento] .'</nif>
        <N_TIPO_DOCUMENTO>'. nifonie($row[documento]) .'</N_TIPO_DOCUMENTO>
        <nombre>'. $row[nombre]  .'</nombre>
        <primerApellido>'. $row[apellido] .'</primerApellido>
        <segundoApellido>'. $row[apellido2] .'</segundoApellido>
        <niss>'. $row[niss] .'</niss>
        <cifEmpresa>'. $row[cif] .'</cifEmpresa>
        <ctaCotizacion>'. substr($row[numerocuenta], 0,11) .'</ctaCotizacion>
        <fechaNacimiento>'. date("d/m/Y", strtotime($row[fechanac])) .'</fechaNacimiento>
        <email>'. $row[email] .'</email>
        <telefono>'. $row[telefono] .'</telefono>
        <sexo>'. sexoconvierte($row[sexo])  .'</sexo>
        <discapacidad>'. adivinaBooleano($row[discapacidad]) .'</discapacidad>
        <afectadosTerrorismo>'.adivinaBooleano($row[afectadosterrorismo]).'</afectadosTerrorismo>
        <afectadosViolenciaGenero>'.adivinaBooleano($datos[afectadosviolenciagenero]).'</afectadosViolenciaGenero>
        <categoriaprofesional>'. $row[categoriaprofesional] .'</categoriaprofesional>
        <grupocotizacion>'. $row[grupocotizacion] .'</grupocotizacion>
        <nivelestudios>'. $row[nivelestudios] .'</nivelestudios>
        ';

        if ($modalidad == 'Teleformación')
  $text .= '<fechaInicioTeleformacion>'. date("d/m/Y", strtotime($fechaini)) .'</fechaInicioTeleformacion>
            <fechaFinTeleformacion>'. date("d/m/Y", strtotime($fechafin)) .'</fechaFinTeleformacion>
            ';

$text .= '</participante>
    ';
    }

$text .= '</participantes>
<costes>';


$q = 'SELECT DISTINCT mc.costes_imparticion, mc.costes_salariales, mc.mes_bonificable, e.cif, mc.costes_indirectos
FROM mat_costes mc, empresas e, mat_alu_cta_emp ma
WHERE e.id = mc.id_empresa
AND ma.id_matricula = mc.id_matricula
AND ma.finalizado = 1
AND ma.tipo = ""
AND mes_bonificable <> 0
AND mc.id_matricula = '.$id_mat;
$q = mysqli_query($link, $q) or die("error costes " . mysqli_error($link));

while ($row = mysqli_fetch_array($q)) {

if ( $naccion >= 5000 ) {
    $text .= '
            <coste>
                <directos>'. $row['costes_imparticion'] .'</directos>
                <indirectos>'. $row['costes_indirectos'] .'</indirectos>
                <salariales>'. $row['costes_salariales'] .'</salariales>
                <periodos>
                    <periodo>';
                    if( isset($row['mes_bonificable']) )
                        $text .= '
                        <mes>'.$row['mes_bonificable'] .'</mes>';
                    else
                        $text .= '
                        <mes>0</mes>';
                    $text .='
                        <importe>'. floatval($row['costes_imparticion'])+floatval($row['costes_indirectos']) .'</importe>
                    </periodo>
                </periodos>
            </coste>
            ';
} else {

    $text .= '
            <coste>
                <cifagrupada>'. $row['cif'] .'</cifagrupada>
                <directos>'. $row['costes_imparticion'] .'</directos>
                <asociados>0</asociados>
                <salariales>'. $row['costes_salariales'] .'</salariales>
                <periodos>
                    <periodo>';
                    if( isset($row['mes_bonificable']) )
                        $text .= '
                        <mes>'.$row['mes_bonificable'] .'</mes>';
                    else
                        $text .= '
                        <mes>0</mes>';
                    $text .='
                        <importe>'. $row['costes_imparticion'] .'</importe>
                    </periodo>
                </periodos>
            </coste>
            ';
    }
}

$text .= '</costes>
    </grupo>
</grupos>';

echo $text;

?>