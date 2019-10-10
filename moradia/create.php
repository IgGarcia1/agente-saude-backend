<?php 

include "../dao/moradiaDAO.php";
include "../geradorJSON.php";

$moradia = new MoradiaDAO();

$result = $moradia->create($_POST);
createResponse($result);

?>