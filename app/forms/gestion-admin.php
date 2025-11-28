<?

	session_start();

	if ( $_SESSION['user'] != 'root' )
		echo "No tienes permiso en esta sección.";
	else
		echo '<h2 style="margin-left: 20px">LOPEZ ECHETO FTW!</h2>';

?>