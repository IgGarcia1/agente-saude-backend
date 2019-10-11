<?php
/* Criando  usuario*/
	require_once("../dao/usuarioDAO.php");

    header('Acess-Control-Allow-Origin: *');

    $jsonP = json_decode($_GET);

	if (!empty($_POST)){
		
		$user = new UserDao($jsonP);
		echo $user->update_password($jsonP['nova-senha']);
	}
?>