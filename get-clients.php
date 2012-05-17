<?php

require_once 'lib/clients.php';

/*
 * 
 * test array - pulling from DB instead
 * 
 */
//$clients = array(
//    array("Southwest Airlines", 18),
//    array("Ben & Jerry's", 10),
//    array("Tom's of Maine", 20),
//    array("New Balance", 35),
//    array("aLoft Hotels", 25),
//    array("Amtrak", 42),
//    array("Matador Beef Jerky", 10),
//    array("FunYuns", 15),
//    array("Purina Pet Foods", 12),
//    array("1-800-Flowers", 7),
//    array("Jack Daniels", 3),
//    array("Caribou Coffee", 23),
//    array("Newton's Running Shoes", 43),
//    array("Bass Pro Shops", 11),
//    array("Jawbone", 9),
//    array("Titan Luggage", 13),
//    array("Wrangler Jeans", 20)
//);

$c = new Clients();

$clients = $c->get_sorted_clients();

$for_js = array();

foreach($clients as $key => $value) {
    if(intval($value) > 4 && $key != "N/A") {
        $for_js[] = array($key, $value);
    }
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

if(!empty($for_js)) {
    
    echo json_encode($for_js);
    
} else {
    
    echo json_encode(array("Failed: there were no clients with more than three votes.", "for_js" => $for_js, "clients" => $clients));
    
}
?>