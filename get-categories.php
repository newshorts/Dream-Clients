<?php

require_once 'lib/categories.php';

$c = new Categories();

$cats = $c->get_categories();

$for_js = array();

for($i = 0; $i < count($cats); $i++) {
    
    $for_js[] = array($cats[$i]['cat_name'], $cats[$i]['tally']);
    
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

if(!empty($for_js)) {
    
    echo json_encode($for_js);
    
} else {
    
    echo json_encode(array("The categories array was empty.", "for_js" => $for_js, "cats" => $cats));
    
}
?>