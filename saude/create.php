<?php 
include "../dao/userHealthDao.php";
include "../geradorJSON.php";

header('Acess-Control-Allow-Origin: *');

$jsonP = json_decode($_GET);

$health = new UserHealthDAO();
$r = $health->create_health($jsonP['dados']);

echo $r;

?>