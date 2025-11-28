
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
</head>  

<script src="../../js/jquery-1.10.2.js"></script>
<script src="../../js/jquery.columnizer.js"></script>

<style>

* {
    margin:0;
    padding:0;
    font-family: sans-serif;
    
}

@media print {
    body { -moz-transform:rotate(90deg); }

}
.page {
    position: relative;
    width: 21cm;
    height: 29.7cm; 
    padding: 15px 30px;
}
.page-hor {
    position: relative;
    width: 28.5cm;
    height: 19.5cm; 
}

.back {
    background-image: url('../../img/diplomas/diploma_atras.png');
    background-repeat:no-repeat;
    background-size: 27.8cm 19.7cm ;
    width: 100%;
    height: 100%;
}

.contenidotxt {
    width: 860px;
    height: 560px;
    position: absolute;
    margin: 100px 0px 0px 100px;
    
}

.prueba {
    border: 1px solid red;
    line-height: auto;
    width: 20px;
    height: 30px;

}


.doscolumnas {
    -moz-column-count: 2; 
    -moz-column-gap: 1em; 
    -webkit-column-count: 2; 
    -webkit-column-gap: 1em; 
}

.trescolumnas {
    -moz-column-count: 3; 
    -moz-column-gap: 1em; 
    -webkit-column-count: 3; 
    -webkit-column-gap: 1em; 
}

.cuatrocolumnas {
    -moz-column-count: 4; 
    -moz-column-gap: 1em; 
    -webkit-column-count: 4; 
    -webkit-column-gap: 1em; 
}
.cincocolumnas {
    -moz-column-count: 5; 
    -moz-column-gap: 1em; 
    -webkit-column-count: 5; 
    -webkit-column-gap: 1em; 
}
.seiscolumnas {
    -moz-column-count: 6; 
    -moz-column-gap: 1em; 
    -webkit-column-count: 6; 
    -webkit-column-gap: 1em; 
}


@page {
    size: landscape;
    margin: 0;
}

</style>

<script>

$(function() {

    $('.contenidotxt div').css('font-size', '1em');
    var fuente = 16;
    while( $('.contenidotxt div').height() > $('.contenidotxt').height() ) {

        fuente = parseInt($('.contenidotxt div').css('font-size')) - 1;
        $('.contenidotxt div').css('font-size', fuente + "px" );
        
    }

    // alert(fuente);


    if (fuente == 1) {
            $('.contenidotxt div').css('font-size', "8" + "px" );
            $('.contenidotxt div').columnize({columns: 8});            
    }        
    else if (fuente == 2) {
            $('.contenidotxt div').css('font-size', "9" + "px" );
            $('.contenidotxt div').columnize({columns: 4});
    }        
    else if (fuente == 3) {
            $('.contenidotxt div').css('font-size', "9" + "px" );
            $('.contenidotxt div').columnize({columns: 4});
    }        
    else if (fuente == 4) {
            $('.contenidotxt div').css('font-size', "12" + "px" );
            $('.contenidotxt div').columnize({columns: 3});
    }        
    else if (fuente == 5) {
            $('.contenidotxt div').css('font-size', "11" + "px" );
            $('.contenidotxt div').columnize({columns: 2});
    } 
    else if (fuente == 6) {
            $('.contenidotxt div').css('font-size', "12" + "px" );
            $('.contenidotxt div').columnize({columns: 2});
    }  
    else if (fuente == 7) {
            $('.contenidotxt div').css('font-size', "12" + "px" );
            $('.contenidotxt div').columnize({columns: 2});
    }  
    else if (fuente == 8) {
            $('.contenidotxt div').css('font-size', "12" + "px" );
            $('.contenidotxt div').columnize({columns: 2});
    }         
    else {
            $('.contenidotxt div').css('font-size', fuente + "px" );

    }
    
});

// window.onload =  function() {
//     $('.contenidotxt').boxfit({ multiline: true, align_true: false, step_limit: 500 });
// };
</script>

<body>

<?

include_once '../../functions/funciones.php';

$id_mat = $_GET['id_matricula'];

$sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.contenido,
    m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin
    FROM matriculas m, acciones a, grupos_acciones ga 
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id ='.$id_mat;
    // echo $sql;
    $sql = mysqli_query($link, $sql) or die ("error");
    
    while ($row = mysqli_fetch_array($sql)) { 
        $naccion = $row[numeroaccion];
        $ngrupo = $row[ngrupo];
        $denominacion = $row[denominacion];
        $horastotales = $row[horastotales];
        $fechaini = $row[fechaini];
        $fechafin = $row[fechafin];
        $horariomini = $row[horariomini];
        $horariomfin = $row[horariomfin];
        $horariotini = $row[horariotini];
        $horariotfin = $row[horariotfin];
        $modalidad = $row[modalidad];
        $contenido = $row[contenido];
    }


    

$sql = 'SELECT a.nombre,a.apellido,a.apellido2,e.razonsocial 
FROM temp_alumnos a,temp_empresas e 
WHERE a.id_empresa = e.id';
$sql = mysqli_query($link, $sql) or die ("error");

while ($row = mysqli_fetch_array($sql)) { ?>
    
    <div class="back">                
        <div class="contenidotxt">
            <div><? echo nl2br($contenido) ?></div>
        </div>
    </div>    
    
<? } ?>


</body>