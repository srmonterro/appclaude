<?

print_r($_POST);
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("app/import/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
        $ruta = dirname(__DIR__).'/import/';
        echo $ruta;
        $move = rename($_FILES["file"]["tmp_name"],
        $ruta . $_FILES["file"]["name"]);
        if ( $move == 'true' )
            echo "bien";
        else 
            echo "error";
      }
    }


?>