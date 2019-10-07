<?php 

include "../createConnection.php";

class UserDao{

	private $num_sus;
	private $nome;
	private $email;
	private $senha;
	private $obito;
	private $cod_escolaridade;
	private $genero;
	private $conn;
	private $sql = '';

	function __construct($post){
		$num_sus = $_POST['num_sus'];
		$nome = $_POST['col_nome'];
		$email = $_POST['col_email'];
		$genero = $_POST['col_genero'];
		$obito = $_POST['col_obito'];
		$senha = $_POST['col_senha'];
		$cod_escolaridade = $_POST['cod_escolaridade'];
	}

	function verificaCampos($conn){
		$fields = array("num_sus", "col_nome", "col_genero", "col_obito", "col_email", "col_senha", "cod_escolaridade");
		
		foreach ($fields as $f => $field) {
			if (empty($_POST[$field])){
				if ($field == "col_obito"){
					$_POST[$field] = 0;
				}else{
					$conn->close();
					die("Faltam campos para realizar a operação.");
				}
			}
		}
	}

	function create(){
		$conn = createConnectionDB();

		$this->verificaCampos($conn);

		$sql = "insert into tbl_usuario (num_sus, col_nome, col_genero, col_obito, col_email, col_senha, cod_escolaridade) values(". $_POST["num_sus"] . ",'" . $_POST['col_nome'] . "','" . $_POST["col_genero"] . "'," . $_POST["col_obito"] . ",'". $_POST["col_email"] . "','" . $_POST["col_senha"]. "'," . $_POST["cod_escolaridade"] . ");";

		if ($conn->query($sql) === TRUE){
			return "Usuario cadastrado com sucesso!";
		}else{
			return "Falha ao cadastrar o usuario." . $conn->error;
		}

		$sql = '';
		$conn->close();
	}

	function update(){}

	function listing(){}

	function delete(){}
}

?>