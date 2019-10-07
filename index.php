<?php
	include "./createConnection.php";

	createConnectionDB();

	$fields = array("num_sus", "col_nome", "col_genero", "col_obito", "col_email", "col_senha", "cod_escolaridade");
	//var_dump($fields);

	foreach ($fields as $f => $field) {
		echo $field . "<br>";
	}

?>

<html>
	<head>
	</head>

	<body>
		<div>
			Bem-Vindo
		</div>
	</body>
</html>