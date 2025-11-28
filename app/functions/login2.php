<?

// session_start();

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once  ($baseurl.'/functions/funciones.php');

$link = mysqli_connect("formacioaigs2019.mysql.db","formacioaigs2019","Solutions2019","formacioaigs2019"); 
$q = 'SELECT user, pass FROM usuarios
WHERE user = '."'".root."'".' AND pass = '."'".md5(123456)."'";
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