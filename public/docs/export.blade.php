<?php
date_default_timezone_set('Europe/Paris');
class ICS {
    var $data = "";
    var $name;
    var $start = "BEGIN:VCALENDAR\r\nMETHOD:PUBLISH\r\nVERSION:2.0\r\nBEGIN:VTIMEZONE\r\nTZID:Europe/Paris\r\nX-LIC-LOCATION:Europe/Paris\r\nBEGIN:DAYLIGHT\r\nTZOFFSETFROM:+0100\r\nTZOFFSETTO:+0200\r\nTZNAME:CEST\r\nDTSTART:19700329T020000\r\nRRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=-1SU;BYMONTH=3\r\nEND:DAYLIGHT\r\nBEGIN:STANDARD\r\nTZOFFSETFROM:+0200\r\nTZOFFSETTO:+0100\r\nTZNAME:CET\r\nDTSTART:19701025T030000\r\nRRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=-1SU;BYMONTH=10\r\nEND:STANDARD\r\nEND:VTIMEZONE\r\n";
    var $end = "END:VCALENDAR\r\n";
    function __construct($name) {
        $this->name = $name;
    }
    function add($start,$end,$name,$location,$description) {
        $this->data .= "BEGIN:VEVENT\r\nUID:R20180111\r\nDTSTAMP:".date("Ymd\THis",strtotime($start))."\r\nDTSTART;TZID=Europe/Paris:".date("Ymd\THis",strtotime($start))."\r\nDTEND;TZID=Europe/Paris:".date("Ymd\THis",strtotime($end))."\r\nSEQUENCE:0\r\nSUMMARY:".$name."\r\nCATEGORIES:événement - fédération vaudoise des entrepreneurs\r\nLOCATION:".$location."\r\nSTATUS:CONFIRMED\r\nTRANSP:TRANSPARENT\r\nDESCRIPTION:".$description."\r\nBEGIN:VALARM\r\nTRIGGER:-PT1440M\r\nDESCRIPTION:".$name."\r\nACTION:DISPLAY\r\nEND:VALARM\r\nEND:VEVENT\r\n";
    }
    function save() {
        file_put_contents($this->name.".ics",$this->getData());
    }
    function show() {
        header("Content-type:text/calendar");
        header('Content-Disposition: attachment; filename="'.$this->name.'.ics"');
        Header('Content-Length: '.strlen($this->getData()));
        Header('Connection: close');
        echo $this->getData();
    }
    function getData() {
        return $this->start . $this->data . $this->end;
    }
}

$event = new ICS(mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $_GET['name']));
$event->add($_GET["date"].$_GET['start'],$_GET["date"].$_GET['end'],$_GET["name"],$_GET['address']." ".$_GET['street_number'].", ".$_GET['zip_code']." ".$_GET['city'],str_replace('                        ', '\n', $_GET['description']));

$event->show();
?>