<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
        <link href="./css/bootstrap.css" rel="stylesheet">
        <script src="js/jquery-1.10.2.js"></script>
        
        <style type="text/css">

            #myPrintArea{
                font-size:13px;
            }
            
            body {
                background: url('img/promocion_emplea_preinscripcion_1920x1080.png');               
                background-repeat: no-repeat;
                background-position: center top;
                background-attachment: fixed;
                background-size: cover
            }

            #contenedor{
                margin-top: 2%; 
                margin-left: 2%
            }

            .derecha{
                margin-left: -2%;
            }

            #condiciones{
                position: absolute;   
                bottom: 5px;
                left: 10px;
                text-align: center;
            }

        </style>

    </head>

<?

    include ('./functions/funciones.php');
    //include ('./functions/congreso.php');

    $codigo_inv = $_GET['codigo_inv'];

    echo '<body>

        <div id="contenedor">
            <form class="form-horizontal" role="form">
                <div class="row col-lg-4 col-lg-offset-5 col-md-4 col-md-offset-5 col-sm-4 col-sm-offset-5 col-xs-4 col-xs-offset-5">
                    <div class="form-group">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="text_nombre" class="control-label" >Nombre:</label>
                            <input type="text" class="form-control" id="text_nombre" name="nombre">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 derecha">
                            <label for="text_apellido" class="control-label" >Primer Apellido:</label>                
                            <input type="text" class="form-control" id="text_apellido" name="apellido">
                        </div>
                    </div>
                </div>
                <div class="row col-lg-4 col-lg-offset-5 col-md-4 col-md-offset-5 col-sm-4 col-sm-offset-5 col-xs-4 col-xs-offset-5">
                    <div class="form-group">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="text_apellido2" class="control-label" >Segundo Apellido:</label>
                            <input type="text" class="form-control" id="text_apellido2" name="apellido2">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 derecha" >
                            <label for="text_codigo_inv" class="control-label" >Código Invitación:</label>
                            <input type="text" class="form-control" id="text_codigo_inv" name="codigo_inv" value="'.$codigo_inv.'">
                        </div>
                    </div>
                    <br>
                </div>
                <div id="boton" class="row col-lg-4 col-lg-offset-5 col-md-4 col-md-offset-5 col-sm-4 col-sm-offset-5 col-xs-4 col-xs-offset-">
                    <div class="form-group">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <a id="registrar" class="pull-right btn btn-success btn-default btn-md">Registrarse</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div id="condiciones" class="col-lg-3 col-lg-offset-2 col-md-3 col-md-offset-2 col-sm-3 col-sm-offset-2">
            Al hacer click en registrarse está aceptando los <a href="http://concurso.esfocc.com/terminos.pdf">términos y condiciones</a>
        </div>

    </body>
</html>';
?>

<script type="text/javascript">

    $(document).on("click", "#registrar", function(event) {

        var nombre = $('#text_nombre').val();
        var apellido = $('#text_apellido').val();
        var apellido2 = $('#text_apellido2').val();
        var codigo_inv = $('#text_codigo_inv').val();

        $.ajax({
            cache: false,
            url: './functions/promociones.php',
            type: 'POST',
            data:'accion=registrarinv&nombre='+nombre+'&apellido='+apellido+'&apellido2='+apellido2+'&codigo_inv='+codigo_inv+'&promocion=promo1',
            success: function (data) {

                if ( data == 'insertado' ) {
                    alert("Registro confirmado correctamente.");
                    window.location.assign("http://esfoccemplea.com/solicitantes/registro");

                } else if ( data == 'duplicado' ) {
                    alert("Usuario registrado con anterioridad.");
                }
                else {
                    alert("Fallo en la validación.");
                }
            }
        }); ajax.abort();

    });

</script>