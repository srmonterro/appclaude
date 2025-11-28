<div style="margin-top: 45px; margin-bottom: 45px;" class="container">

	<input name="matricula" type="hidden" id="matricula" value="" />
	<input name="id_matricula" type="hidden" id="id_matricula" value="" />
	<input name="id_accion" type="hidden" id="id_accion" value="" />
    <input name="id_alumno" type="hidden" id="id_alumno" value="" />
    <input name="id_empleado" type="hidden" id="id_empleado" value="" />

<!--     <div style="display:none" id="confirmacion" class="inv alert alert-success">Progreso guardado. Acuérdate de ir actualizándolo a medida que el alumno va avanzando en la formación.</div>
    <div style="display:none" id="error" class="alert alert-danger">Error.</div> -->

    <script type="text/javascript">

        <?
        function dias_transcurridos($fecha_i,$fecha_f)
        {
            $dias   = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
            $dias   = abs($dias); $dias = floor($dias);
            return $dias;
        }

        ?>

        var f1_true=false,f2_true=false,computable=1;
        var xhr = null;
        var id_usuario;
        var registro;

    //Funcion calcular dias entre Fechas dadas
    function restaFecha(f1,f2)
    {
        var aFecha1 = f1.split('-');
        var aFecha2 = f2.split('-');
        var bisiesto = false;
        var restarFebrero = false;
        var anioInicio, mesInicio, diaInicio;
        var anioFin, mesFin, diaFin;

        anioInicio = parseInt(aFecha1[0]);
        mesInicio = parseInt(aFecha1[1]);
        //En JacaScript DATE empieza los mes en 0
        mesInicio = mesInicio - 1;
        diaInicio = parseInt(aFecha1[2]);

        anioFin = parseInt(aFecha2[0]);
        mesFin = parseInt(aFecha2[1]);
        mesFin = mesFin - 1;
        diaFin = parseInt(aFecha2[2]);

        var fFecha1 = new Date(Date.UTC(anioInicio,mesInicio,diaInicio));
        var fFecha2 = new Date(Date.UTC(anioFin,mesFin,diaFin));

        var dif; //= fFecha2 - fFecha1;
        dif = ((fFecha2-fFecha1)/86400/1000);

        var dias = ((fFecha2-fFecha1)/86400/1000);

        return dias;

    }

    //Función que carga los datos
    function cargarDatos()
    {

        var input_vacaciones='<div class="form-group"><label  for="vacaciones_p">Vacaciones Pendientes:</label><input type="text" id="vacaciones_p" class="form-control" /><br/> <input type="button" value="+ Añadir Vacaciones" id="btn_añadir_vacaciones" class="btn btn-primary"/></div>';

        var div_input=document.getElementById("dias_vacaciones");
        var f1,f2,dias_disfrutar,vacaciones_pendientes,resta,vacaciones_pend;
        var f1_true=false,f2_true=false;

        id_usuario=document.getElementById("vpersonalp").value;

        document.getElementById("id_empleado").value=id_usuario;

        div_input.innerHTML=input_vacaciones;

        //id_usuario=$("#vpersonalp").val();

        $('#datos_vacaciones').hide();

        listarVacaciones();

        $.ajax({
            cache:false,
            type:'POST',
            url:'functions/vacaciones.php',
            data:'id_usuario='+id_usuario+'',
            success: function(data)
            {
                //Obtenemos dias vacaciones pendientes desde archivo PHP
                if(data!='error')
                {
                    document.getElementById("vacaciones_p").value = data;

                    vacaciones_pend=document.getElementById("vacaciones_p").value;

                    var btn_añadir=document.getElementById("btn_añadir_vacaciones");

                    //Apretamos añadir vacaciones y aparecen input de las fechas y dias
                    btn_añadir.addEventListener("click", function (event){
                        $('#datos_vacaciones').show();
                    });

                    var btn_guardar=document.getElementById("btn_guardar");

                     //Computable
                     document.getElementById("computable").addEventListener("change", function (event) {
                        computable=document.getElementById("computable").value;
                        cambioFechaEntrada();
                    });

                    //Escogemos fecha1
                    document.getElementById("dia_salida").addEventListener("change", function (event) {
                        f1_true=true;
                    });

                    //Escogemos fecha2
                    document.getElementById("dia_entrada").addEventListener("change", function (event) {
                        f2_true=true;
                        cambioFechaEntrada();
                    });

                }

            }

        });

    }

    //Función que hace el listado de las vacaciones grabadas
    function listarVacaciones()
    {
        id_usuario=document.getElementById("id_empleado").value;

        $.ajax({
            cache:false,
            type:'POST',
            //dataType: "json",
            url:'functions/vacaciones.php',
            data:'accion=listar_tabla&id_usuario='+id_usuario+'',
            success: function(data)
            {
                if(data!='error')
                {
                    $('#tabla_vacaciones').html(data);
                    $('#tabla_vacaciones').show();
                }else{
                    $('#tabla_vacaciones').hide();
                }
            }
        });

    }

    //Función que muestra los controles de añadir un nuevo registro de Vacaciones
    function mostrarAnadirVacaciones(){

        $.ajax({
            cache:false,
            type:'POST',
            url:'functions/vacaciones.php',
            data:'id_usuario='+id_usuario+'',
            success: function(data)
            {
                //Obtenemos dias vacaciones pendientes desde archivo PHP
                document.getElementById("vacaciones_p").value = data;

                vacaciones_pend=document.getElementById("vacaciones_p").value;

                var btn_añadir=document.getElementById("btn_añadir_vacaciones");

                //Apretamos añadir vacaciones y aparecen input de las fechas y dias
                btn_añadir.addEventListener("click", function (event){
                    $('#datos_vacaciones').show();
                });

                var btn_guardar=document.getElementById("btn_guardar");

                //Escogemos fecha1
                document.getElementById("dia_salida").addEventListener("change", function (event) {
                    f1_true=true;
                });

                //Escogemos fecha2
                document.getElementById("dia_entrada").addEventListener("change", function (event) {

                    f2_true=true;

                });

                //Boton guardar cogemos hacemos resta entre fechas y cogemos datos de input para añadir a tabla
                btn_guardar.addEventListener("click", function (event){
                    id_usuario=document.getElementById("vpersonalp").value;
                });
            }
        });

    }

    //Función que guarda un nuevo registro de Vacaciones
    function guardarVacaciones(){

        var div_input=document.getElementById("dias_vacaciones");
        var f1,f2,dias_disfrutar,vacaciones_pendientes,resta,vacaciones_pend, computable;

        id_usuario=document.getElementById("vpersonalp").value;

        f1=document.getElementById("dia_salida").value;
        f2=document.getElementById("dia_entrada").value;
        dias_disfrutar=document.getElementById("dias_disfrutar").value;
        vacaciones_pendientes=document.getElementById("vacaciones_p").value;
        observaciones=document.getElementById("observaciones").value;

        computable=document.getElementById("computable").value;

        //Controlamos si son o no Computables
        if(computable=="1")
        {
            resta=vacaciones_pendientes-dias_disfrutar;
        }else{
            resta=vacaciones_pendientes;
        }

        $.ajax({
            cache:false,
            type:'POST',
            url:'functions/vacaciones.php',
            data:'accion=insertar&f_salida='+f1+'&f_entrada='+f2+'&dias_disfrutar='+dias_disfrutar+'&dias_pendientes='+resta+'&computable='+computable+'&id_usuario='+id_usuario+'&observaciones='+observaciones+'',
            success: function(data)
            {
                alert("REGISTRO INSERTADO");
                listarVacaciones();
                document.getElementById("vacaciones_p").value = resta;
            }
        });
    }

    function mostrarSubirPDF(registro){

        var id_usuario = document.getElementById("id_empleado").value;

        var formulario = "<form id='partevacaciones' id_registro='"+registro+"' action='' method='post' enctype='multipart/form-data'><input style='float:left' type='file' name='pdfvacaciones' id='pdfvacaciones' class='btn btn-default'><a id='subirpdfvacaciones' style='' fecha_salida='"+registro+"' class='boton btn btn-primary'><span class='glyphicon glyphicon-open'></span> Subir PDF </a><a id='mostrarpdfvacaciones' style='' fecha_salida='"+registro+"' class='boton btn btn-success'><span class='glyphicon glyphicon-save'></span> Mostrar PDF </a><span id='comprlt1' style='margin-top: 10px; margin-left: 5px; class='glyphicon'></span></form>";

        $('#mostrardatos').modal('show');

        $('.modal-dialog').css('width','700px');

        $('#mostrardatos .mostrartitulo').html("Subir PDF");

        $('#mostrardatos .contenido').html(formulario);

        $(document).on("click", "#subirpdfvacaciones", function (event) {

            subirPDF();

        });

        $(document).on("click", "#mostrarpdfvacaciones", function (event) {

           mostrarPDF();

       });
    }

    function subirPDF()
    {

        var id_usuario = document.getElementById("id_empleado").value;
        var formulario = document.getElementById('partevacaciones');
        var formData = new FormData(formulario);
        var registroBuscar = $("#subirpdfvacaciones").attr("fecha_salida");


        //alert(registroBuscar);

        // coge el archivo
        formData.append('file', $('#pdfvacaciones').get(0).files[0]);
        formData.append('id_usuario', id_usuario);
        formData.append('registro', registroBuscar);
        formData.append('tipo', 'vacaciones');
        formData.append('accion', 'subirpdf');

        if ( $('#pdfvacaciones').get(0).files[0] == undefined ) {

            alert("Selecciona un archivo.");

        } else {

            $.ajax({
                cache: false,
                url: './functions/vacaciones.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if ( data == 'bien' ) {
                        alert("Fichero subido correctamente.");
                        //$('#comprlt1').html(estasi);
                        listarVacaciones();
                    }
                    else {
                        alert("Fallo en la subida.");
                        //$('#comprlt1').html(estano);
                    }
                }
            });

            ajax.abort();

        }

    }

    function mostrarPDF(){

        var id_usuario=document.getElementById("id_empleado").value
        var formData = new FormData();
        var registroBuscar = $("#mostrarpdfvacaciones").attr('fecha_salida');

        formData.append('id_usuario', id_usuario);
        formData.append('registro', registroBuscar);
        formData.append('tipo', 'vacaciones');
        formData.append('accion', 'mostrarpdf');

        $.ajax({
            cache: false,
            type: 'POST',
            url: 'functions/vacaciones.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data)
            {
                if ( data == 'no' )
                    alert ("No hay PDF subido.");
                else
                    window.open(data);
            }

        });
        ajax.abort();
    }

    function cambioFechaEntrada()
    {
        computable=document.getElementById("computable").value;
        vacaciones_pendientes=document.getElementById("vacaciones_p").value;

        //Controlamos si es computable
        if(computable=="1")
        {
            //Controlamos si se ha seleccionado las dos fechas
            if(f1_true==true && f2_true==true)
            {
                f1=document.getElementById("dia_salida").value;
                f2=document.getElementById("dia_entrada").value;

                if(f2>f1)
                {
                    document.getElementById("dias_disfrutar").value = restaFecha(f1,f2);
                    dias_disfrutar=document.getElementById("dias_disfrutar").value;
                    resta=vacaciones_pendientes-dias_disfrutar;
                    if(resta<=0){
                        alert("Has superado el número de Días permitidos.");
                    }else{
                        document.getElementById("dias_restantes").value=resta;
                    }
                }else{
                    alert("La fecha de Llegada debe ser superior a la de Salida.");
                }

            }

        }else{
            f1=document.getElementById("dia_salida").value;
            f2=document.getElementById("dia_entrada").value;

            if(f2>f1)
            {
                //document.getElementById("dias_disfrutar").value = 0;
                document.getElementById("dias_disfrutar").value = restaFecha(f1,f2);
            }

            document.getElementById("dias_restantes").value=vacaciones_pendientes;
        }
    }

    //FUNCIONES CREADA POR OCTAVIO 6/4/2017

    $(document).on("click", ".botonactualizar", function(event){

        var id_registro = $(this).attr('idvac');
        var usuario = $("#usuario").val();
        var fecha_salida = $("#actualizar_dia_salida"+id_registro).val();
        var fecha_entrada = $("#actualizar_dia_entrada"+id_registro).val();
        var dias_periodo = $("#actualizar_dias_disfrutar"+id_registro).val();
        var dias_pendientes = $("#actualizar_dias_restantes"+id_registro).val();
        var observaciones = $("#observaciones"+id_registro).val();
        var dias_globales = $('#vacaciones_p').val();

        $.ajax({
            cache: false,
            type: 'POST',
            dataType: 'json',
            url: 'functions/vacaciones.php',
            data: 'actualizar=1&usuario='+usuario+'&id_registro='+id_registro+'&fecha_salida='+fecha_salida+'&fecha_entrada='+fecha_entrada+'&dias_periodo='+dias_periodo+'&dias_pendientes='+dias_pendientes+'&observaciones='+observaciones+'&globales='+dias_globales,
            success: function(data)
            {
                alert('Registro actualizado con exito');

                //PARA RECARGAR TODA LA PAGINA
                /*$('body, html').animate({scrollTop: $(".navbar").offset().top }, 1000);
                            setTimeout(function(){location.reload();},2200);*/

                /*$.ajax({
                cache: false,
                type: 'POST',
                url: 'functions/vacaciones.php',
                data: 'global=1&usuario='+usuario,
                success: function(data)
                {
                    console.log(data);
                    $('#vacaciones_p').val(data);
                }
                });*/

            }
        });

    });

    function actualizarFecha(id){

        f1= $("#actualizar_dia_salida"+id).val();
        f2= $("#actualizar_dia_entrada"+id).val();
        console.log(dias_disfrutados_antes = parseInt($('#actualizar_dias_disfrutar'+id).val()));
        console.log(dias_pendientes_antes = parseInt($('#actualizar_dias_restantes'+id).val()));
        console.log(dias_disfrutados_despues = parseInt(restaFecha(f1,f2)));
        /*FUNCIONANDO dias_pendientes_despues = parseInt(dias_disfrutados_antes - dias_disfrutados_despues + dias_pendientes_antes);*/
        dias_pendientes_despues = parseInt(dias_disfrutados_antes - dias_disfrutados_despues + dias_pendientes_antes);
        dias_globales = parseInt($('#vacaciones_p').val());

        if (f1<f2) {
            $('#vacaciones_p').val(dias_disfrutados_antes - dias_disfrutados_despues + dias_globales);
            $('#actualizar_dias_disfrutar'+id).val(dias_disfrutados_despues);
            $('#actualizar_dias_restantes'+id).val(dias_pendientes_despues);
        }else{
            alert("La fecha de Llegada debe ser superior a la de Salida.");
        }

    }

    $(document).on("change", ".actualizar", function(event){

        var idAtributo = $(this).attr('id');

        var id = $(this).attr('idvac');

        var fechaseleccionada = $('#'+idAtributo).val();

        console.log("ID: "+id);
        actualizarFecha(id);

    });

    //TERMINAN FUNCIONES

    $(document).ready(function(){

        $("#vpersonalp").change(cargarDatos);
        $("#btn_añadir_vacaciones").click(mostrarAnadirVacaciones);
        $("#btn_guardar").click(guardarVacaciones);

         //Escogemos fecha1
         document.getElementById("dia_salida").addEventListener("change", function (event) {
            f1_true=true;
        });

        //Escogemos fecha2
        document.getElementById("dia_entrada").addEventListener("change", function (event) {
            f2_true=true;
        });

    });

</script>

<ol class="breadcrumb">
  <li>Vacaciones</li>
  <li class="active">Subir Vacaciones</li>
</ol>

<div class="col-md-4" style="margin-bottom: 15px">
   <div class="form-group">
       <label class="control-label" for="personalp">Seleccionar personal:</label>
       <select id="vpersonalp" name="personalp" class="form-control" >
          <option value="">...</option>
          <?

          $q = 'SELECT nombre, id
          FROM nominas_usuarios
          WHERE tipo="Personal" AND Activo=1 ORDER BY nombre';
          $q = mysqli_query($link, $q);

          while ( $row = mysqli_fetch_array($q) ) {

            echo '<option value="'.$row[id].'">'.$row[nombre].'</option>';

        }

        ?>

    </select>
</div>
</div>

<div class="clearfix"></div>

<?

$gestion = devuelveAnio();

$meses = array("",
  "Enero",
  "Febrero",
  "Marzo",
  "Abril",
  "Mayo",
  "Junio",
  "Julio",
  "Agosto",
  "Septiembre",
  "Octubre",
  "Noviembre",
  "Diciembre" );

  for ($i=1; $i <= 12; $i++) { ?>


  <? } ?>

  <div id="dias_vacaciones" class="col-md-4" >
  </div>

  <br/><br/><br/><br/><br/><br/><br/>

  <div style="display:none" id="datos_vacaciones" class="form-group">
    <div id="datos_vacaciones6" class="col-md-2" >

        <label  for="noComputable">Días computables:</label>
                <!--
                <input type="checkbox" value="1" id="noComputable" class="form-control" />
            -->
            <input type="hidden" name="id_registro">
            <input type="hidden" name="id_usuario">
            <select name="computable" id="computable" class="form-control">
                <option value="1">
                    Si
                </option>
                <option value="2">
                    No
                </option>
            </select>
        </div>

        <div id="datos_vacaciones1" class="col-md-2" >
            <label  for="dia_salida">Día salida:</label>
            <input type="date" id="dia_salida" class="form-control" />
        </div>

        <div id="datos_vacaciones2" class="col-md-2" >
            <label  for="dia_entrada">Día entrada:</label>
            <input type="date" id="dia_entrada" class="form-control"/>
        </div>

        <div id="datos_vacaciones3" class="col-md-2" >
            <label  for="dias_disfrutar">Nº Días a disfrutar:</label>
            <input type="text" id="dias_disfrutar" class="form-control" />
        </div>

        <div id="datos_vacaciones4" class="col-md-2" >
            <label  for="dias_restantes">Pendientes restantes:</label>
            <input type="text" id="dias_restantes" class="form-control" />
        </div>

        <div id="datos_vacaciones5" class="col-md-8" >
            <label  for="observaciones">Observaciones:</label>
            <textarea rows="5" cols="50" id="observaciones" class="form-control"></textarea>
        </div>

        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

        <div id="datos_vacaciones7" class="col-md-2" >
            <input type="button" id="btn_guardar" value="Guardar" style="text-align: center; margin-top: 30px;" class="btn btn-primary form-control"/>
        </div>

    </div>

    <div style="display:none" id="tabla_vacaciones" class="col-md-12">
    </div>

</div>