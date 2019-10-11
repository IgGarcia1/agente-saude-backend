<?php

include "../dao/UsuarioDAO2.php";

header('Acess-Control-Allow-Origin: *');

$jsonP = json_decode($_GET);

$user = new UsuarioDAO();
$r = $user->create_cidadao_rua($jsonP['dados']);
echo r;
?>