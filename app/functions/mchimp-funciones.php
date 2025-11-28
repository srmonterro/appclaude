<?

    include_once('../plugins/MailChimp.php');

    include_once('./funciones.php');

    $MailChimp = new \Drewm\MailChimp('b6d6793e7c552cdb4493fd39b7b9dd35-us10');

    $idlista = '0c2553e835';
    // $idgrupo = '5061';


    if ( $_POST[accion][0] == "listar_segmentos" ) {

        $result = $MailChimp->call('lists/segments', array('id' => $idlista) );
        // print_r($result);
        echo '
        <div class="col-md-8" style="margin: 20px">
            <div class="form-group">
               <label class="control-label" for="segmentos">Actualizar Campaña:</label>
                    <select id="segmentos" name="segmentos" class="form-control">';

                    for ($i=0; $i < count($result['static']); $i++) { 
                        
                        echo '<option value="'. $result["static"][$i]["id"] .'">'. $result["static"][$i]["name"] .'</option>';

                    }

                echo '</select>
            </div>
        </div>
        <div class="col-md-3" style="margin-top:45px"
            ><a id="mailchimp-agregar" style="margin-right: 15px; width:100%; display: inline-block;" class="pull-right btn btn-success btn-default">
            <span class="glyphicon glyphicon-envelope"></span> Agregar Contactos</a>
        </div>';

    } else  {

        // print_r($_POST[MERGE1]);
        $ind = 0;
        for ($i=0; $i < count($_POST[email]); $i++) { 

            if ( strpos($_POST[email][$i], ',') !== false  ) {


                $emails = explode(',', $_POST[email][$i]);
                // print_r($emails);
                // print_r($_POST[MERGE1]);
                $name = $_POST[MERGE1][$i];
                // echo($name);

                for ($j=0; $j < count($emails); $j++) { 

                    // echo $emails[$j];
                    $suscribir_repe[$ind][email][email] = $emails[$j];                
                    $suscribir_repe[$ind][email_type] = 'text';
                    $suscribir_repe[$ind][merge_vars][MERGE1] = $name;
                    // $asignar_repe[$ind][email] = $emails[$j];        
                    $ind++;
                }

                
            } else {

                $suscribir[$i][email][email] = $_POST[email][$i];
                $suscribir[$i][email_type] = 'text';
                $suscribir[$i][merge_vars][MERGE1] = $_POST[MERGE1][$i];
                // $asignar[$i][email] = $_POST[email][$i];

            }
        }

        //         echo "<pre>";
        // print_r($suscribir);
        // echo "</pre>";

        // echo "<pre>";
        // print_r($suscribir_repe);
        // echo "</pre>";


        if (count($suscribir) == 0) {
            $suscripcion = $suscribir_repe;
            // $asignacion = $asignar_repe;
        } else if (count($suscribir_repe) == 0) {
            $suscripcion = $suscribir;
            // $asignacion = $asignar;
        } else {
            $suscripcion = array_merge($suscribir, $suscribir_repe);
            
        }

        // echo "<pre>";
        // print_r($suscripcion);
        // echo "</pre>";



        
        $result1 = $MailChimp->call('lists/batch-subscribe', array(
        'id'                => $idlista,
        'batch'             => $suscripcion,
        'double_optin'      => false,
        'update_existing'   => true,
        'replace_interests' => false
        ));

        echo "<pre>";
        print_r($result1);
        echo "</pre>";


        //reccorrer $result1[adds] y $result1[updates] sacando [euid]

        for ($i=0; $i < count($result1[adds]); $i++) { 
            $asignar[$i][email] = $result1[adds][$i][email];
            $asignar[$i][euid] = $result1[adds][$i][euid];
        }
        for ($i=0; $i < count($result1[updates]); $i++) { 
            $asignar_repe[$i][email] = $result1[updates][$i][email];
            $asignar_repe[$i][euid] = $result1[updates][$i][euid];
        }

        // echo "<pre>";
        // print_r($asignar);
        // echo "</pre>";

        // echo "<pre>";
        // print_r($asignar_repe);
        // echo "</pre>";

        if (count($asignar) == 0) {
            $asignacion = $asignar_repe;
            // $asignacion = $asignar_repe;
        } else if (count($asignar_repe) == 0) {
            $asignacion = $asignar;
            // $asignacion = $asignar;
        } else {
            $asignacion = array_merge($asignar, $asignar_repe);
            
        }

        echo "<pre>";
        print_r($asignacion);
        echo "</pre>";


        if ( $_POST[accion][0] == "agregar" ) { 

            $result2 = $MailChimp->call('lists/static-segment-members-add', array(
            'id'                => $idlista,
            'seg_id'            => $_POST[campana][0],
            'batch'             => $asignacion
            ));

            echo "<pre>";
            print_r($result2);
            echo "</pre>";

        } else {

            echo "<pre>";
            $result = $MailChimp->call('lists/static-segment-add', array('id' => $idlista, 'name' => $_POST[campana][0]));
            echo "</pre>";

            echo "<pre>";
            print_r($result);
            echo "</pre>";



            $result2 = $MailChimp->call('lists/static-segment-members-add', array(
            'id'                => $idlista,
            'seg_id'            => $result[id],
            'batch'             => $asignacion
            ));

            echo "<pre>";
            print_r($result2);
            echo "</pre>";

        }



    }




?>