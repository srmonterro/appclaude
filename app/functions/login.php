<?

// session_start();

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/app';

include_once  ($baseurl.'/functions/funciones.php');

//$link = mysqli_connect("edukateccxgs2019.mysql.db","edukateccxgs2019","Solutions2019","edukateccxgs2019"); 

$q = 'SELECT user, pass FROM usuarios
WHERE user = '."'".$_POST['user']."'".' AND pass = '."'".md5($_POST['pass'])."'";



$q = mysqli_query($link, $q) or die("error");

$row = mysqli_fetch_assoc($q);


if (mysqli_num_rows($q) > 0) {
	$_SESSION['user'] = $row['user'];
    echo ($_SESSION['user']);
}
else
	echo "error";
	
?>