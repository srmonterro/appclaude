<?

include './funciones.php';
// session_start();

    $i = 0;
    // print_r($_POST);
    $comercial = ' AND e.comercial NOT IN(8,9)';

    foreach ($_POST as $key => $value) {

        if ( $value != "" ) {

            $and = ' AND ';

            if ($key == 'operador') {
                $op = $value;
                $and = '';
                $in = '';
            }

            if ($key == 'codigopostal') {
                $in = ' AND e.'.$key.' IN '."('".$value."')";
                $like = '';
            }

            if ($key == 'zona') {
                $in = ' JOIN poblaciones p ON e.codigopostal = p.codpostal JOIN zonas z ON p.idzona = z.id AND z.id IN '."('".$value."')";
                $like = '';
                $zona = '';
            }

            if ($key == 'poblacion') {
                if ( isset($_POST[zona]) && $_POST[zona] != "" )
                    $in = ' AND p.poblacion IN '."('".$value."')";
                else {
                    $in = ' AND e.poblacion IN '."('".$value."')";
                    $zona = ' JOIN poblaciones p ON e.poblacion = p.poblacion ';
                }
                $like = '';
            }

            if ($key == 'provincia') {
                $in = ' AND e.'.$key.' IN '."('".$value."')";
                $like = '';
            }

            if ($key == 'razonsocial') {
                $like = ' AND '.$key.' LIKE '."'%".$value."%'";
                $in = '';
            }

            if ($key == 'estado_revision') {
                $in = ' AND e.estado_revision IN '."('".$value."')";
                $like = '';
            }

            if ($key == 'comercial') {
                $in = ' AND c.id IN '."('".$value."')";
                $like = '';
            }

            if ($key == 'agente') {
                $in = ' AND e.agente IN '."('".$value."')";
                $like = '';
            }

            if ($key == 'credito') {
                $in = ' AND credito '.$op.$value;
                $like = '';
            }

            if ($key == 'actividad') {
                $in = ' AND e.actividad IN '."('".$value."')";
                $like = '';
            }

            if ($key == 'categoria') {
                $in = ' AND e.categoria IN '."('".$value."')";
                $like = '';
            }

            if ($key == 'fecha_revision') {
                $in = ' AND e.fecha_revision IN '."('".$value."')";
                $like = '';
            }

            $campos .= $like.$in;

        }

    }

    $q = 'SELECT
         e.razonsocial,
         e.cif,
         e.email,
         e.telefono,
         CONCAT(c.nombre," ",c.apellido) as comercial,
         round(sum(fb2014.total_factura), 2) as Total_Facturado2014,
         round(sum(fb2015.total_factura), 2) as Total_Facturado2015,
         round(sum(fb2016.total_factura), 2) as Total_Facturado2016,
         atri.actividad
         FROM  empresas AS e
         LEFT JOIN `gestion-esfocc`.facturacion_bonificada AS fb2014 ON fb2014.empresa = e.id
         LEFT JOIN `2015gestion-esfocc`.facturacion_bonificada AS fb2015 ON fb2015.empresa = e.id
         LEFT JOIN `2016gestion-esfocc`.facturacion_bonificada AS fb2016 ON fb2016.empresa = e.id
         LEFT JOIN actividadestripartita AS atri ON e.actividad = atri.codigo
         JOIN comerciales AS c ON e.comercial = c.id '.$campos.'
         group by e.id
         UNION
         SELECT
         e.razonsocial,
         e.cif,
         e.email,
         e.telefono,
         CONCAT(c.nombre," ",c.apellido) as comercial,
         round(sum(fb2014.total_factura), 2) as Total_Facturado2014,
         round(sum(fb2015.total_factura), 2) as Total_Facturado2015,
         round(sum(fb2016.total_factura), 2) as Total_Facturado2016,
         atri.actividad
         FROM  empresas AS e
         LEFT JOIN `gestion-esfocc`.facturacion_privada AS fb2014 ON fb2014.empresa = e.id
         LEFT JOIN `2015gestion-esfocc`.facturacion_privada AS fb2015 ON fb2015.empresa = e.id
         LEFT JOIN `2016gestion-esfocc`.facturacion_privada AS fb2016 ON fb2016.empresa = e.id
         LEFT JOIN actividadestripartita AS atri ON e.actividad = atri.codigo
         JOIN comerciales AS c ON e.comercial = c.id '.$campos.'
         group by e.id';

    $q = mysqli_query($link, $q) or die("error". mysqli_error($link));

    $headers = array('Razón Social','CIF','eMail','Teléfono','Comercial','Facturado 2014','Facturado 2015','Facturado 2016','Actividad');

    while ( $row = mysqli_fetch_assoc($q) ) {
        $registro[] = $row;
    }

    arrayTable($headers, $registro, false, true);

?>