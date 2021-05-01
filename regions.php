<?php

$timezone_identifiers = DateTimeZone::listIdentifiers(DateTimeZone::AMERICA, null);

$result = array();
$date = new DateTime("2021-01-01" . ($_POST['hora'] != NULL ? $_POST['hora']:'00:00'), new DateTimeZone('America/Argentina/Buenos_Aires'));

foreach($timezone_identifiers as $timezone_identifier){
    $date->setTimezone(new DateTimeZone($timezone_identifier));
    $result[] = $timezone_identifier . $date->format(' (P)');
}


header('Content-type: application/json');
echo json_encode( $result );
?>