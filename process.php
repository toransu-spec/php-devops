<?php

$zone=$_POST["zone"]; 

$date = new DateTime("2021-01-01" . ($_POST['hora'] != NULL ? $_POST['hora']:'00:00'), new DateTimeZone($zone));

if(!empty($_POST['reg'])) {

    $result = array();

    foreach($_POST['reg'] as $value){
    
    $date->setTimezone(new DateTimeZone($value));
    $result[] = $value . ":" . $date->format('H:i:s (P)') . "<br>";        

    }

}

header('Content-type: application/json');
echo json_encode( $result );

?>