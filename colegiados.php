    <head>
        <meta charset="UTF-8">
    </head>

<?

    include_once('./plugins/MailChimp.php');

    include_once('./functions/funciones.php');

function send_params($param) {
    $URL = "http://www.soysms.com/api/status";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    $retuned_data = curl_exec($ch);
    curl_close($ch);
    return $retuned_data;
}

$us = "icabrera@eduka-te.com";
$pa = "cywach67";
$si = "22";
$PARAM = "U=$us&P=$pa&MSGID=$si";
$resultado = send_params($PARAM);
echo $resultado;


?>
