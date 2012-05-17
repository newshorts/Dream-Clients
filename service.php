<?php

require_once 'lib/clients.php';
/*
 * pull in informationz and spit out a list in xml
 * 
 * very sketchy at the moment, super ugly and it will probably break on special
 * characters that people throw in...
 * 
 */

// you can pass a filter on the client return here
$filter = 1;
if(isset($_GET['filter'])) {
    $filter = intval($_GET['filter']);
}

$c = new Clients();
$clients = $c->get_sorted_clients();

//sort($clients);

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Content-type: text/plain');

foreach($clients as $key => $value) {
    if(intval($value) > $filter) {
        
        $key = html_entity_decode($key);
        $find = array("(", ")", " ", "&", "'", "#39;", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $replace = array("", "", "_", "And", "", "", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "zero");
        $key = str_replace($find, $replace, $key);
        
        echo $key . "\n";
        echo $value . "\n";
    }
}
?>
