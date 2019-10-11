<?php
/* Criando  usuario*/
	require_once("../dao/usuarioDAO2.php");
	require_once("../geradorJSON.php");

	/*  POST para teste */

	/*$_POST["num_sus"] = 123456789;
	$_POST["col_nome"] = "Usuario 01";
	$_POST["col_genero"] = "M";
	$_POST["col_obito"] = "";
	$_POST["col_email"] = "email@email.com";
	$_POST["col_senha"] = "senha123";
	$_POST["cod_escolaridade"] = 1;*/

    header('Acess-Control-Allow-Origin: *');

    $jsonP = json_decode($_GET);



	if (!empty($_POST)){
		
		$user = new UsuarioDAO();
		$result = $user->create($jsonP['dados']);
		echo $result;
	}
?>