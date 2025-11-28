<div style="margin-top: 45px" class="container">

    <input name="matricula" type="hidden" id="matricula" value="" />
    <input name="id_matricula" type="hidden" id="id_matricula" value="" />
    <input name="id_accion" type="hidden" id="id_accion" value="" />
    <input name="id_alumno" type="hidden" id="id_alumno" value="" />
<!--     <div style="display:none" id="confirmacion" class="inv alert alert-success">Progreso guardado. Acuérdate de ir actualizándolo a medida que el alumno va avanzando en la formación.</div>
    <div style="display:none" id="error" class="alert alert-danger">Error.</div> -->


    <ol class="breadcrumb">
      <li>Docentes</li>
      <li class="active">Seguimiento Reportes Comerciales</li>
    </ol>

    <form role="form" action="" method="post" id="form-seguimiento">


        <div class="col-md-3">
            <div class="form-group">
               <label class="control-label" for="comercial">Comercial:</label>
                    <select id="comercial" name="comercial" class="form-control">
                        <?

                            devuelveComercialesBusqueda($_SESSION['user'], $link);

                        ?>
                    </select>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                    <label class="control-label" for="mes">Mes:</label>
                    <select id="mes" name="mes" class="form-control" >
                        <option value="">Cualquiera</option>
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>
        </div>

        <div class="col-md-2">
                <div class="form-group">
                <label class="control-label" for="fecha">Fecha:</label>
                <input type="date" id="fecha" value="" name="fecha" class="form-control" />
            </div>
        </div>

<!--         <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" for="situacionlaboral">Situación Laboral:</label>
            <select id="situacionlaboral" name="situacionlaboral" class="form-control">
                <option value="">Cualquiera</option>
                <option value="Autonomo">Autónomo</option>
                <option value="Desempleado">Desempleado</option>
                <option value="Otro">Otra situación (trabaja por cuenta ajena en otra empresa)</option>
                <option value="Generar">Generar Alta Laboral</option>
                <option value="Nomina">En Nómina</option>
            </select>
        </div>
        </div>
 --><!--
        <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" for="modalidad">Modalidad:</label>
            <select id="modalidad" name="modalidad" class="form-control">
                <option value="">Cualquiera</option>
                <option value="Teleformación">Teleformación</option>
                <option value="A Distancia">Distancia</option>
                <option value="Presencial">Presencial</option>
                <option value="Mixta">Mixta</option>
            </select>
        </div>
        </div> -->

        <div class="col-md-1">
            <a style="margin-top: 24px; width:100%;" id="restablecer-c" class="btn btn-default"><span class="glyphicon glyphicon-repeat"></span></a>
        </div>

        <div class="col-md-1">
            <a style="margin-top: 24px; width:100%;" id="busqueda-seguimientorepor" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
        </div>

    </form>

    <div class="clearfix"></div>
    <div class="col-md-12" style="height: 15px;"></div>
    <div class="clearfix"></div>

    <!-- </div> -->

<!--     <div class="col-md-6">
        <table id="leyenda" style="display:none">
            <tr>
                <td class="text-warning">Pendiente de pago</td>
                <td> | </td>
                <td class="text-info">Pagada parcialmente</td>
                <td> | </td>
                <td class="text-success">Pagada</td>
                <td> | </td>
                <td class="text-danger">Rectificada</td>
            </tr>
        </table>
    </div>
 -->
    <div class="col-md-6 pull-right">
        <a id="imprimirSeguimientoc" onclick="printDiv('listado-seguimiento')" style="display: none" class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-print"></span> Imprimir</a>

        <a id="listadoExcel" style=" margin-left: 20px;display: none" class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-list-alt"></span> Exportar a Excel</a>
    </div>
    <div class="clearfix"></div>
    <div id="listado-seguimiento" style=""></div>

    </div>
    <form id="lala" action="functions/exportarexcel_seguimientoe.php" method="post" target="_blank">

<!--         <a id="imprimirSeguimientoc" onclick="printDiv('listado-seguimiento')" style="overflow:auto; margin-top: -180px; display: none" class="pull-left btn btn-primary btn-default"><span class="glyphicon glyphicon-print"></span> Imprimir</a>

        <a id="listadoExcel" style="overflow:auto; margin-top: -180px; margin-left: 100px; display: none" class="pull-left btn btn-primary btn-default"><span class="glyphicon glyphicon-list-alt"></span> Exportar a Excel</a>
 -->
        <input type="hidden" id="datatodisplay" name="datatodisplay" />
    </form>



<script type="text/javascript">

$(document).on("click", "#busqueda-seguimientorepor", function(event) {

    event.preventDefault();
    var values = $('#form-seguimiento').find("input[type='hidden'], :input:not(:hidden)").serialize();

    $(this).find('span').toggleClass('glyphicon-search glyphicon-refresh');
    $(this).find('span').addClass('spin');

    $.ajax({
        cache: false,
        type: 'POST',
        url: 'functions/busqueda-seguimientorepor.php',
        data: values,
        success: function(data)
        {

            $('.glyphicon-refresh').toggleClass('glyphicon-refresh glyphicon-search');
            $('.glyphicon-search').removeClass('spin')

            $('#listado-seguimiento').html(data);
            $('#imprimirSeguimientoc').css('display','inline-block');
            $('#listadoExcel').css('display','inline-block');
            $('#listadoExcel').css('margin-right','5px');

        }

    }); ajax.abort();

});


$(document).on("click", "#restablecer-c", function(event){
        $('#form-seguimiento')[0].reset();
});

$(document).on("click", "#listadoExcel", function(event) {

        var datatodisplay = $('#listado-seguimiento').html();
        $('#datatodisplay').val(datatodisplay);
        document.getElementById("lala").submit(datatodisplay);

});
</script>

