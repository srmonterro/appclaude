<?

    include_once('../plugins/MailChimp.php');

    include_once('./funciones.php');

    $MailChimp = new \Drewm\MailChimp('4424ba6390541d1c342f35f38c0b1aba-us10');
    // echo "<pre>";
    // print_r($MailChimp->call('lists/list'));
    // echo "</pre>";

    $idlista = '5e8f5d6c81';
    $idgrupo = '5061';

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // $suscribir2 = array(
        
    //     array('email' =>  array('email' => 'asd5@gmail.com'), 
    //           'email_type' => 'text', 
    //           'merge_vars' => array('MERGE1' => 'asd5') ),

    //     array('email' =>  array('email' => 'asd6@gmail.com'), 
    //           'email_type' => 'text', 
    //           'merge_vars' => array('MERGE1' => 'asd6') )
    // );

    $ind = 0;
    for ($i=0; $i < count($_POST[email]); $i++) { 

        if ( strpos($_POST[email][$i], ',') !== false  ) {


            $emails = explode(',', $_POST[email][$i]);
            // print_r($emails);
            $name = $_POST[MERGE1][$i];

            for ($j=0; $j < count($emails); $j++) { 

                // echo $emails[$j];
                $suscribir_repe[$ind][email][email] = $emails[$j];                
                $suscribir_repe[$ind][email_type] = 'text';
                $suscribir_repe[$ind][merge_vars][MERGE1] = $name;
                $asignar_repe[$ind][email] = $emails[$j];        
                $ind++;
            }

            
        } else {

            $suscribir[$i][email][email] = $_POST[email][$i];
            $suscribir[$i][email_type] = 'text';
            $suscribir[$i][merge_vars][MERGE1] = $_POST[MERGE1][$i];
            $asignar[$i][email] = $_POST[email][$i];

        }
    }

    // echo "<pre>";
    // print_r($suscribir);
    // echo "</pre>";

    //     echo "<pre>";
    // print_r($suscribir_repe);
    // echo "</pre>";

    if (count($suscribir) == 0) {
        $suscripcion = $suscribir_repe;
        $asignacion = $asignar_repe;
    } else if (count($suscribir_repe) == 0) {
        $suscripcion = $suscribir;
        $asignacion = $asignar;
    } else {
        $suscripcion = array_merge($suscribir, $suscribir_repe);
        $asignacion = array_merge($asignar, $asignar_repe);
    }

    echo "<pre>";
    print_r($suscripcion);
    echo "</pre>";

        echo "<pre>";
    print_r($asignacion);
    echo "</pre>";



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


    echo "<pre>";
    $result = $MailChimp->call('lists/static-segment-add', array('id' => '5e8f5d6c81', 'name' => $_POST[campana][0]));
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

    // $result = $MailChimp->call('lists/interest-group-add', array('id' => $idlista, 'group_name' => $_POST[campana][0]) ); 



    // $result = $MailChimp->call('lists/subscribe', array(
    // 'id'                => '5e8f5d6c81',
    // 'email'             => array( 'email' => 'aperojo@gmail.com' ),
    // 'merge_vars'        => array(
    //     'MERGE1' => 'Alberto' // MERGE name from list settings
    //     // there MERGE fields must be set if required in list settings
    // ),
    // 'double_optin'      => false,
    // 'update_existing'   => true,
    // 'replace_interests' => false
    // ));

    // if( $result === false ) {
    //     // response wasn't even json
    //      echo "false";
    // }
    // else if( isset($result->status) && $result->status == 'error' ) {
    //     // Error info: $result->status, $result->code, $result->name, $result->error
    //     echo $result->status. ', '. $result->code. ', '. $result->name. ', '. $result->error;
    // }

    
    
    // $nombregrupo = 'Campaña Curso Creta 05/2015';


    // $email = array( 
    //     array('email' => 'asd5@gmail.com'),
    //     array('email' => 'asd6@gmail.com')
    // );
    // echo "<pre>";
    // print_r($MailChimp->call('lists/list'));
    // echo "</pre>";

    // $result = $MailChimp->call('lists/interest-group-add', array('id' => $idlista, 'group_name' => $nombregrupo) ); 


    // echo "<pre>";
    // print_r($MailChimp->call('lists/interest-groupings', array('id' => '5e8f5d6c81')) );
    // echo "</pre>";

    // echo "<pre>";
    // $result = $MailChimp->call('lists/static-segment-add', array('id' => '5e8f5d6c81', 'name' => 'Curso Creta 2015-2'));
    // echo "</pre>";

    // echo "<pre>";
    // $result = $MailChimp->call('lists/segments', array('id' => '5e8f5d6c81') );
    // echo "</pre>";



    // $result1 = $MailChimp->call('lists/static-segment-members-add', array(
    // 'id'                => $idlista,
    // 'seg_id'            => '18381',
    // 'batch'             => $email
    // ));

    // echo "<pre>";
    // print_r($result);
    // echo "</pre>";

    // echo "<pre>";
    // print_r($suscribir);
    // echo "</pre>";



?>