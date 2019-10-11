<?php

include "../createConnection.php";

class UsuarioDAO{
	

	private function verificaCampos($fields){

		foreach($fields as $f => $v){
			if ($v == null or $v == ''){
				return False;
			}
		}

		return True;
	}

	public function create($props){

		if (!$this->verificaCampos($props)){
			return False; //"Campos inválidos";
		}

		$conn = createConnectionDB();

		$sql = "insert into tbl_usuario(num_sus, col_parentesco, col_genero, cod_deficiencia, col_obito, col_plano_saude, col_mudanca, cod_escolaridade, col_crianca_fica_com)";
		$sql = $sql . "values(" . $props['num_sus'] .", ". $props['col_parentesco'] . ", '". $props['col_genero'] . "', ". $props['cod_deficiencia'] . ",".  $props['col_obito'] . ",". $props['col_plano_saude'] .",". $props['col_mudanca'].", ". $props['cod_escolaridade'] .", '". $props['col_crianca_fica_com'] ."');";

		//echo $sql .  "<br><br>";

		$result = $conn->query($sql);
		$erro = $conn->error;
		$conn->close();

		if ($result===True){
			return "Usuário cadastrado com sucesso!";
		}else{
			return "Erro ao cadastrar usuário." .  $erro;
		}

	}

	public function update_password($num_sus, $new_pass){

		$conn = createConnectionDB();

		$sql = "update tbl_usuario set col_senha = '" . $new_pass . "' where num_sus=" . $num_sus . ";";

		$result = $conn->query($sql);
		$erro = $conn->error;
		$conn->close();

		if($result===True){
			return "Senha atualizada com sucesso."; 
		}else{
			return "Erro ao atualizar senha.";
		}
	}

    public function do_login($props){
        $conn = createConnectionDB();
        
        $sql = "select * from tbl_usuario where col_email='". $props['col_email']."';";
        
        $r = $conn->query($sql);
        $array = $conn->fecth_array($r);
        
        var_dump($array); echo '<br>';
        
        $conn->close();
        
        if ($array["num_rows"]==0){ //Tamanho
            return "Usuario nao cadastrado.";
        }
        if ($r['col_senha'] == $props['col_senha']){
            return "Login realizado com sucesso!";
        }else{
            return "Senha incorreta.";
        }
    }
}
/*num_sus bigint not null primary key, 
    col_parentesco varchar(50) not null,
    col_genero char(1) not null,
    
    cod_deficiencia int, 
	col_obito boolean default False,
    col_plano_saude boolean default False,
    col_mudanca boolean default False,
	cod_escolaridade int not null,
    col_crianca_fica_com varchar(50),*/
?>

