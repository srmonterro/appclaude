<?php

// http://api.telegram.org/bot175906410:AAHseqP1LGG4i3J_bnk_2MhRtZ0e4Wvtgm8/getUpdates

// Incluir los archivos de la API
$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include($baseurl.'/plugins/Telegram.php');
include($baseurl.'/functions/funciones.php');

// Iniicalizar bot con el token
define(TOKEN, '175906410:AAHseqP1LGG4i3J_bnk_2MhRtZ0e4Wvtgm8');

$telegram = new Telegram(TOKEN);
// $chat_id = $telegram->ChatID();
$id_tito = '5917859'; // TITO
$id_elena = '62491792';
$id_ivy = '4424062';
$id_carlos = '205313220';
$id_cris = '106294751';
// $content = array('chat_id' => $id_carlos, 'text' => 'hola charly');
// $telegram->sendMessage($content);
// arrayText($telegram);
// $content = "ey";

$response = $telegram->getUpdates();
arrayText($response);
// $content = array('chat_id' => $id_tito, 'text' => $response);
// $telegram->sendMessage($content);

// foreach ($response[result] as $mensajes) {

// 	arrayText($mensajes);
// 	$msj = $mensajes['message'];
// 	$user = $msj['chat']['id'];
// 	echo $user;

// 	switch ($msj['text']) {
// 		case 'hola':
// 			$content = array('chat_id' => $user, 'text' => 'Holi!');
// 		break;


// 		default:
// 			# code...
// 			break;
// 	}

// 	$telegram->sendMessage($content);

// }


// // // $titulo = "e";
// // // $content = array('chat_id' => $id_tito, 'text' => $titulo);
// // // $telegram->sendMessage($content);
// $telegram->getMe();
// arrayText($telegram);

// // //Obtener actualizaciones de mensajes
// // // try {
// // // }
// // // catch (\TelegramBot\Api\Exception $e) {
// // //     echo 'ERROR!: ' . $e–>getMessage());
// // // }
// // // catch (\TelegramBot\Api\InvalidArgumentException $e){
// // //     echo 'ERROR!: ' . $e–>getMessage());
// // // }

// // // Recorrer resultados
// // foreach ($aUpdates as $aUpdate) {

// //     $oMessage = $aUpdate['message'];

// //     // Aquí ya podemos acceder a los datos de cada mensaje devuelto
// //     echo 'ID del mensaje: ' . $oMessage–>getMessageId();
// //     echo 'Contenido del mensaje: ' . $oMessage–>getText();

// }

?>
