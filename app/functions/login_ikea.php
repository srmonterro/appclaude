<?

session_start();
include_once './funciones.php';

$q = 'SELECT usuario, password FROM ikea_usuarios
WHERE usuario = '."'".$_POST['user']."'".' AND password = '."'".md5($_POST['pass'])."'";
echo $q;
$q = mysqli_query($link, $q) or die("error");
$row = mysqli_fetch_assoc($q);

if (mysqli_num_rows($q) > 0) {
	$_SESSION['user'] = $row['user'];
    echo ($_SESSION['user']);
}
else 
	echo "error";
?>