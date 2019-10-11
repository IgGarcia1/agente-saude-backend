<?php 

/** Verificar e alterar código. */

include "../createConnection.php";

class UserHealthDAO{


    public function create_health($props){
        $conn = createConnectionDB();

        $sql = "insert into tbl_saude_cidadao(num_sus, col_peso, col_doenca_cardiaca, col_doenca_respiratoria, col_problema_rins,";
        $sql = $sql . "col_e_fumante, col_usa_alcool, col_avc, col_usa_drogas, col_hipertensao, col_diabetes, col_mudanca, col_cancer)";
        $sql = $sql . "values(".$props['num_sus'].", ".$props['col_peso'].",".$props['col_doenca_cardiaca'].",".$props['col_doenca_respiratoria'].", ".$props['col_problema_rins'];
        $sql = $sql . ", ".$props['col_e_fumante'].",".$props['col_usa_alcool'].",".$props['col_avc'].",".$props['col_usa_drogas'].",".$props['col_hipertensao'].",".$props['col_diabetes'].",".$props['col_mudanca'].",".$props['col_cancer'].");";

        //echo $sql;

        $result = $conn->query($sql);

        $conn->close();
    
        if($result){
            return "Cadastro realizado com sucesso.";
        }else{
            return "Falha ao cadastrar.";
        }
    }

    
}

/**
 * 
    *num_sus bigint not null,
    *col_peso float not null,
    *col_doenca_cardiaca boolean default False,
    *col_doenca_respiratoria boolean default False,
    *col_problema_rins boolean default False,
    *col_e_fumante boolean default False,
	*col_usa_alcool boolean default False,
	*col_avc boolean default False,
    *col_usa_drogas boolean default False,
	*col_hipertensao boolean default False,
	*col_diabetes boolean default False,
    *col_mudanca boolean default False,
    *col_cancer boolean default False,
 * 
 */


?>

