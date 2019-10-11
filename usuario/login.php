<?php

include "../dao/UsuarioDAO2.php";
include "../geradorJSON.php";

$user = new UsuarioDAO();
$r = $user->do_login($_POST);
echo createResponse($r);

?>