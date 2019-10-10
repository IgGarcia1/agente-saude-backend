<?php 

include "../createConnection.php";

class NotificationDAO{

    private $group;
    private $message;
    private $solicitante;


    function __construct($props){
        $this->group = $props[''];
        $this->message = $props[''];
        $this->solicitante = $props[''];
    }

    function create(){
        $conn = createConnectionDB();

        $conn->close();
    }

}


?>