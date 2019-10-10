<?php

function createResponse($result){

    $arr = array('status'=> $result);
    return json_encode($arr);
    
}
?>