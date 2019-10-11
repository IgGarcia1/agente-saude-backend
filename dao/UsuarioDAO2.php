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
		$sql = $sql . "values(" . $props['num_sus'] .", ". $props['col_parentesco'] . ", '". $props['col_sexo'] . "', ". $props['cod_deficiencia'] . ",".  $props['col_obito'] . ",". $props['col_plano_saude'] .",". $props['col_mudanca'].", ". $props['cod_escolaridade'] .", '". $props['col_crianca'] ."');";

		//echo $sql .  "<br><br>";

		$result = $conn->query($sql);
		$erro = $conn->error;
		$conn->close();

		if ($result===True){
			return "OK!";
		}else{
			return "Error";
		}

	}

	public function update_password($num_sus, $new_pass){

		$conn = createConnectionDB();

		$sql = "update tbl_usuario set col_senha = '" . $new_pass . "' where num_sus=" . $num_sus . ";";

		$result = $conn->query($sql);
		$erro = $conn->error;
		$conn->close();

		if($result===True){
			return "OK"; 
		}else{
			return "Erro ao atualizar senha.";
		}
	}

    public function do_login($props){
        $conn = createConnectionDB();
        
        $sql = "select * from tbl_usuario where col_email='". $props['col_email']."';";
        
        $r = mysqli_query($conn, $sql);
        
        $conn->close();
        
        if ( mysqli_num_rows($r)==0){ //Tamanho
            return "Usuario nao cadastrado.";
        }
               
        while($row = $r->fetch_assoc()) {
            if($row['col_senha'] == $props['col_senha']){
                return "OK!";
            }
        }
        
        return "Senha incorreta.";
    }


    public function create_cidadao_rua($props){
        $conn = createConnectionDB();
        
        $sql = "insert into tbl_cidadao_rua(num_sus,col_tempo_rua, col_alimenta_dia, col_origem_alimentacao, col_higiene_pessoal, col_recebe_beneficio, col_possui_referencia_familiar) ";
        $sql = $sql . "values(".$props['num_sus'].",".$props['col_tempo_rua'].",".$props['col_alimenta_dia'].", '".$props['col_origem_alimentacao']."', ".$props['col_higiene_pessoal'].", ".$props['col_recebe_beneficio'].",".$props['col_possui_referencia_familiar'].");"
            
            
        $result = $conn->query($sql);
        $erro = $conn->erro;
        $conn->close();
        
        if ($result){
            return "OK!";
        }else{
            return "Erro ao cadastrar.";
        }
    }
}

/*
    num_sus bigint not null,
    col_tempo_rua float not null,
    col_alimenta_dia boolean default False,
    col_origem_alimentacao varchar(70) not null,
    col_higiene_pessoal boolean default False,

    col_recebe_beneficio boolean default False,
    col_possui_referencia_familiar boolean default False,
*/
?>

