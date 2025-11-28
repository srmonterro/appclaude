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
<grupos>
    <grupo>
        <idAccion>'.$naccion.'</idAccion>
        <idGrupo>'.$ngrupo.'</idGrupo>
        <participantes>
        ';

$sql = 'SELECT DISTINCT e.id, e.cif, e.razonsocial, a.* , m.numerocuenta, e.id as id_empresa
    FROM alumnos a, empresas e, mat_alu_cta_emp m
    WHERE m.id_alumno = a.id
    AND m.id_empresa = e.id
    AND m.finalizado = 1
    AND m.id_matricula = '.$id_mat.' 
    AND m.tipo = ""';
    $sql = mysqli_query($link, $sql);
    
    while ($row = mysqli_fetch_array($sql)) {

        if ( $row[numerocuenta] == "" ) {

            $q = 'SELECT numerocuenta
            FROM cuentascotizacion
            WHERE id_empresa = '.$row[id_empresa];
            $q = mysqli_query($link, $q) or die("error" . mysqli_error($link));

            $r = mysqli_fetch_assoc($q);
            $row[numerocuenta] = $r[numerocuenta];
                           
        }
$empresa = $row[id];       
      
$text.='<participante>
        <nif>'. $row[documento] .'</nif>
        <N_TIPO_DOCUMENTO>'. nifonie($row[documento]) .'</N_TIPO_DOCUMENTO>
        <ERTE_RD_ley>false</ERTE_RD_ley>       
        <email>'. $row[email] .'</email>
        <telefono>'. $row[telefono] .'</telefono>
        <discapacidad>'. adivinaBooleano($row[discapacidad]) .'</discapacidad>
        <afectadosTerrorismo>'.adivinaBooleano($row[afectadosterrorismo]).'</afectadosTerrorismo>
        <afectadosViolenciaGenero>'.adivinaBooleano($datos[afectadosviolenciagenero]).'</afectadosViolenciaGenero>
        <categoriaprofesional>'. $row[categoriaprofesional] .'</categoriaprofesional>
        <nivelestudios>'. $row[nivelestudios] .'</nivelestudios>
        <DiplomaAcreditativo>S</DiplomaAcreditativo>
        <fijoDiscontinuo>'. adivinaSino($row[fijodisc]) .'</fijoDiscontinuo>  
        </participante>'; 
    }

$text .= '</participantes>
<costes>';
   

$q = 'SELECT DISTINCT mc.costes_imparticion, mc.costes_salariales, mc.mes_bonificable, e.cif, mc.costes_indirectos, mc.costes_organizacion, mc.importe_a_bonificar
FROM mat_costes mc, empresas e, mat_alu_cta_emp ma
WHERE e.id = mc.id_empresa 
AND ma.id_matricula = mc.id_matricula
AND ma.finalizado = 1
AND ma.tipo = ""
AND mes_bonificable <> 0
AND mc.id_matricula = '.$id_mat;
$q = mysqli_query($link, $q) or die("error costes " . mysqli_error($link));

while ($row = mysqli_fetch_array($q)) {                

    $coste_total = $row[costes_imparticion]+$row[costes_indirectos]+$row[costes_organizacion];
    
    if ( $row[importe_a_bonificar] == '0' )
        $importe = $coste_total;
    else
        $importe = $row[importe_a_bonificar]; 

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
                        <importe>'. $importe .'</importe>
                    </periodo>
                </periodos>
            </coste>
            ';
} else {

    $text .= '   
            <coste>
                <cifagrupada>'. $row['cif'] .'</cifagrupada>
                <directos>'. $row['costes_imparticion'] .'</directos>
                <indirectos>'. $row['costes_indirectos'] .'</indirectos>
                <organizacion>'. $row['costes_organizacion'] .'</organizacion>
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
                    <importe>'. $importe .'</importe>
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