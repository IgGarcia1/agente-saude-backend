<?php 

/** Verificar e alterar código. */

include "../createConnection.php";

class UserHealthDAO{

    private $num_sus;
    private $weight;
    private $is_smooker;
    private $use_alcool;
    private $qtd_avc;

    function __construct($props){

    }

    function create_user(){
        $conn = createConnectionDB();

        $sql = "insert into tbl_saude_cidadao(num_sus, col_peso, col_e_fumante, col_usa_alcool, col_qtd_avc)";
        $sql = $sql . "values(". $this->num_sus .", ". $this->weight .", ". $this->is_smooker.",". $this->qtd_avc.");";

        if($conn->query($sql)===True){
            $conn->close();
            return "Usuario cadastrado na tabela de cidadão.";
        }else{
            $msg = "Falha ao cadastrar usuário. " . $conn->error;
            $conn->close();
            return $msg;
        }

    }

    function rel_user_disease($num_sus, $cod_disease){
        $conn = createConnectionDB();
        
        $sql = "insert into tbl_rel_saude_cidadao_doenca(cod_saude, cod_doenca) values(".$num_sus.", " . $cod_disease .");";

        if($conn->query($sql)===True){
            $conn->close();
            return "Doença relacionada com sucesso.";
        }else{
            $msg = "Erro ao relacionar doença. ". $conn->error;
            $conn->close();
            return $msg;
        }

        $conn->close();
    }

    
}

?>