<?php 
include "../dao/userHealthDao.php";
include "../geradorJSON.php";


//var_dump($_POST);

//echo "<br><br>";

$health = new UserHealthDAO();
$r = $health->create_health($_POST);

echo createResponse($r);

?>