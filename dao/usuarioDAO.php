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
	private $valores;

	function __construct($post){
		$this->num_sus = $post['num_sus'];
		$this->nome = $post['col_nome'];
		$this->email = $post['col_email'];
		$this->genero = $post['col_genero'];
		$this->obito = $post['col_obito'];
		$this->senha = $post['col_senha'] || "";
		$this->cod_escolaridade = $post['cod_escolaridade'];
		$this->valores = $post;
	}

	function set_values($post){
		$this->num_sus = $post['num_sus'];
		$this->nome = $post['col_nome'];
		$this->email = $post['col_email'];
		$this->genero = $post['col_genero'];
		$this->obito = $post['col_obito'];
		$this->senha = $post['col_senha'];
		$this->cod_escolaridade = $post['cod_escolaridade'];
		$this->valores = $post;
	}

	function verificaCampos($conn){
		$fields = array(
			"num_sus" => $this->num_sus, 
			"col_nome" => $this->nome, 
			"col_genero" => $this->genero, 
			"col_obito" => $this->obito, 
			"col_email" => $this->email, 
			"col_senha" => $this->senha, 
			"cod_escolaridade" => $this->cod_escolaridade
		);
		
		foreach ($fields as $f => $field) {
			if (empty($field)){
				if ($f == "col_obito"){
					$this->obito = 0;
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

		$sql = "insert into tbl_usuario (num_sus, col_nome, col_genero, col_obito, col_email, col_senha, cod_escolaridade) values(". $this->num_sus . ",'" . $this->nome . "','" . $this->genero . "'," . $this->obito . ",'". $this->email . "','" . $this->senha . "'," . $this->cod_escolaridade . ");";

		//echo $sql;

		if ($conn->query($sql) === TRUE){
			return "Usuario cadastrado com sucesso!";
		}else{
			return "Falha ao cadastrar o usuario." . $conn->error;
		}

		$sql = '';
		$conn->close();
	}

	function update_password($pass){
		$conn = createConnectionDB();
		
		$sql = "update tbl_usuario set col_senha = '". $pass . "' where num_sus = " . $this->num_sus . ";";
		//echo $sql . '<br><br>';

		if( $conn->query($sql) === True){
			$conn->close();
			return "Senha atualizada com sucesso!";
		}else{
			$msg = "Houve um erro durante a atualização. " . $conn->error;
			$conn->close();
			return $msg;
		}
	}


	function update(){}

	function listing(){}

	function delete(){}
}

?>