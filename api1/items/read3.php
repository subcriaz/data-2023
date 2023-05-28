<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


//echo "b4 wfdzew  w2ew2re32re32";
 include_once '../config/Database.php';
 include_once '../class/items.php';
//echo "   after swfdzew w2e3wewqdewq";

//echo "b4 wfdzew  w2ew2re32re32";
//echo get_include_path();
set_include_path(get_include_path());
//echo get_include_path();
 include_once '../config/Database.php';
 include_once __DIR__ 'api1/class/items.php';
 //include_once 'items.php';
 //echo "  a4 ";

 //echo get_include_path();

$database = new Database();
$db = $database->getConnection();
//echo "  db con ok 123";
$items = new Items($db);
//echo "  new items a4444 ";
$items->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';
//echo "  a4444 ";
$result = $items->read();
//echo "  a4444 ";
if($result->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["items"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        $itemDetails=array(
            "id" => $id,
            "name" => $name,
            "description" => $description,
			"price" => $price,
            "category_id" => $category_id,            
			"created" => $created,
            "modified" => $modified			
        ); 
       array_push($itemRecords["items"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No item found.")
    );
} 
//echo "  a4444 ";
?>