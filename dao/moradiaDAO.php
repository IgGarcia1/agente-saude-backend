<?php 

include "../createConnection.php";

class MoradiaDAO{
	
	/*public function __construct(){}*/

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

		$id_moradia = $this->create_moradia($props);

		if( gettype($id_moradia) != "string" ){
			$num_sus = $props['num_sus'];
			$this->create_rel_user_moradia($num_sus, $id_moradia);
			return True;
		}else{
			echo "Não foi possível relacionar casa com cidadão. Tente novamente em alguns instantes.";
			return False;
		}
	}

	private function create_moradia($props){
		$conn = createConnectionDB();

        /*  create table if not EXISTS tbl_moradia(
	    col_cep int not null,
	    col_numero int not null,
	    tem_abastecimento_agua boolean default False,
	    tem_sistema_esgoto boolean default False,
	    tem_coleta_lixo boolean default False, 
	    tem_animais boolean default False,
	    col_rua_moradia varchar(100) not null,
	    cod_moradia bigint not null auto_increment,

	    primary key (cod_moradia)
        );*/


		$sql = "insert into tbl_moradia(col_cep, col_numero, tem_abastecimento_agua, tem_sistema_esgoto, tem_coleta_lixo, tem_animais, col_rua_moradia)";
		$sql = $sql . "values(". $props['col_cep'] .",". $props['col_numero'] .",". $props['tem_abastecimento_agua'] . ", ". $props['tem_sistema_esgoto'].",". $props['tem_coleta_lixo'].", ". $props['tem_animais'].", '". $props['col_rua_moradia'] ."');";
	
		//echo $sql . "<br><br>";

		if($conn->query($sql)===True){
			$consulta = "select * from tbl_moradia ordem by cod_moradia desc limit=1;";

			$retorno = $conn->query($consulta);
			echo "RETORNO:  " . $retorno;

			/* Coletar o ultimo id inserido para gerar o relacionamento. */

			$conn->close();
			return $retorno;
		}else{
			$conn->close();
			return "Error";
		}

	}

	private function create_rel_user_moradia($user_id, $moradia_id){
		$conn = createConnectionDB();

		$sql = "insert into tbl_rel_usuario_moradia(num_sus, cod_moradia)";
		$sql = $sql . "values(". $user_id.", ". $moradia_id .");";

		/**
		 * num_sus bigint not null, cod_moradia bigint not null
		 */

		 echo " REL_USER_MORADIA |" . $sql;

		$result = $conn->query($sql);
		$conn->close();

		if($result === True){
			return "Relacionamento criado com sucesso";
		}else{
			return "Erro no relacionamento.";
		}
	} 

}



?>