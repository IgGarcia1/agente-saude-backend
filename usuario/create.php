<?php
/* Criando  usuario*/
	require_once("../dao/usuarioDAO.php");


	/*  POST para teste */

	$_POST["num_sus"] = 12345678910;
	$_POST["col_nome"] = "Usuario 01";
	$_POST["col_genero"] = "";
	$_POST["col_obito"] = "";
	$_POST["col_email"] = "email@email.com";
	$_POST["col_senha"] = "senha123";
	$_POST["cod_escolaridade"] = 1;





	if (!empty($_POST)){
		
		$user = new UserDao($_POST);
		echo $user->create();
	}
?>