<div style="margin-top: 45px" class="container">
    
    <input name="matricula" type="hidden" id="matricula" value="" />
    <input name="id_matricula" type="hidden" id="id_matricula" value="" />  
    <input name="id_accion" type="hidden" id="id_accion" value="" />
    <input name="id_alumno" type="hidden" id="id_alumno" value="" />
<!--     <div style="display:none" id="confirmacion" class="inv alert alert-success">Progreso guardado. Acuérdate de ir actualizándolo a medida que el alumno va avanzando en la formación.</div>
    <div style="display:none" id="error" class="alert alert-danger">Error.</div> -->


    <ol class="breadcrumb">
      <li>Comerciales</li>
      <li class="active">Seguimiento Empresas</li>
    </ol>

    <form role="form" action="" method="post" id="form-seguimiento">

        <div class="col-md-6">
            <div class="cp form-group">
            <label class="control-label" for="nombrecomercial">Nombre comercial:</label>
            <div class="input-group">
                <input placeholder="Introduce alguna palabra para buscar la empresa" type="text" id="nombrecomercial" name="nombrecomercial" class="form-control" />
                <span class="input-group-btn">
                    <button id="buscarempresanombre" name="buscarempresanombre" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </div>
        </div>

        <div class="col-md-6">
            <div class="cp form-group">
            <label class="control-label" for="razonsocial">Razón Social:</label>
            <div class="input-group">
                <input placeholder="Introduce alguna palabra para buscar la empresa" type="text" id="razonsocial" name="razonsocial" class="form-control" />
                <span class="input-group-btn">
                    <button id="buscarempresacomercial" name="buscarempresacomercial" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </div>
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

$(document).on("click", "#busqueda-seguimientocomeremp", function(event) {

    event.preventDefault();
    var values = $('#form-seguimiento').find("input[type='hidden'], :input:not(:hidden)").serialize();

    $(this).find('span').toggleClass('glyphicon-search glyphicon-refresh');
    $(this).find('span').addClass('spin');

    // alert($('#razonsocial').val());

    if ( $('#razonsocial').val() == "" ) {
        alert("Selecciona una empresa.");
        $('.glyphicon-refresh').toggleClass('glyphicon-refresh glyphicon-search');
        $('.glyphicon-search').removeClass('spin');
        return false;
    }

    $.ajax({
        cache: false,
        type: 'POST',
        url: 'functions/busqueda-seguimientocomeremp.php',
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

