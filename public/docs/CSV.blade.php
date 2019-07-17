<?php

$id = $_GET['id'];
$nameEvent = $_GET['name'];
$names = unserialize($_GET['names']);
$first_names = unserialize($_GET['first_names']);
$company_names = unserialize($_GET['company_names']);
$emails = unserialize($_GET['emails']);

$participantsArray = array();
$participantsArray[] = array('',"nom de l'événement",$nameEvent,'');
$participantsArray[] = array('','','','');
$participantsArray[] = array('Nom','Prénom',"Nom de l'entreprise",'Adresse mail');
$currentEvent = 0;
foreach($names as $name){
    if($name == $id){
        $currentEvent++;
        break;
    }
    else{
        $currentEvent++;
    }
}
for($currentEvent; $currentEvent <= count($names); $currentEvent++){
    
    if($names[$currentEvent] == $id){
        break;
    }
    else{
        $participantsArray[] = array($names[$currentEvent],$first_names[$currentEvent],$company_names[$currentEvent],$emails[$currentEvent]);
    }
}

array_to_csv_download($participantsArray,"participants-".$nameEvent.".csv");


function array_to_csv_download($array, $filename = "export.csv", $delimiter=";") {
    header('Content-Encoding: UTF-8');
    header('Content-type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="'.$filename.'";');
    echo "\xEF\xBB\xBF";
    

    $f = fopen('php://output', 'w');
    
    foreach ($array as $line) {
        fputcsv($f, $line, $delimiter);
    }
}
?>