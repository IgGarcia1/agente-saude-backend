<?php 

include "../dao/moradiaDAO.php";
include "../geradorJSON.php";


header('Acess-Control-Allow-Origin: *');

$jsonP = json_decode($_GET);
$moradia = new MoradiaDAO();
$result = $moradia->create($jsonP['dados']);
echo $result;

?>