<?

session_start();
include_once './funciones.php';

$q = 'SELECT user, pass FROM usuarios_sms
WHERE user = '."'".$_POST['user']."'".' AND pass = '."'".md5($_POST['pass'])."'";
//echo $q;
$q = mysqli_query($link, $q) or die("error");
$row = mysqli_fetch_assoc($q);

// $permitdos = array("root","admin");

if ( mysqli_num_rows($q) > 0 ) {
	$_SESSION['user'] = $row['user'];
    echo ($_SESSION['user']);
}
else 
	echo "error";
?>