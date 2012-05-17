<?php

if(isset($_POST)) {
    
    require_once 'lib/validate.php';
    
    $v = new Validate();
    
    $arr = array(
        'c1' => $_POST['c1'],
        'c2' => $_POST['c2'],
        'c3' => $_POST['c3'],
        'c4' => $_POST['c4'],
        'c5' => $_POST['c5']
        
    );
    
    $result = $v->insert($arr);
    
    if($result) {
        
        $arr = array("response" => true, "queryResult" => $result, "data" => $_POST);
    
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($arr);
        
    }
    
    
    
}
?>