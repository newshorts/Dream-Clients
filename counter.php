<?php

require_once 'lib/clients.php';

$c = new Clients();

$clients = $c->get_sorted_clients();

$for_js = array();

foreach($clients as $key => $value) {
    if(intval($value) > 4 && $key != "N/A") {
        $for_js[] = array($key, $value);
    }
}

arsort($clients);

echo "<pre>";
print_r($clients);
echo "</pre>";

//header('Cache-Control: no-cache, must-revalidate');
//header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
//header('Content-type: application/json');
//
//if(!empty($for_js)) {
//    
//    echo json_encode($for_js);
//    
//} else {
//    
//    echo json_encode(array("The categories array was empty.", "for_js" => $for_js, "cats" => $cats));
//    
//}
?>
