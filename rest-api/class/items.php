<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
// include_once '../class/Items.php';
 
$database = new Database();
$db = $database->getConnection();
 
$items = new Items($db);
 
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->name) && !empty($data->description) &&
!empty($data->price) && !empty($data->category_id) &&
!empty($data->created)){    

    $items->name = $data->name;
    $items->description = $data->description;
    $items->price = $data->price;
    $items->category_id = $data->category_id;	
    $items->created = date('Y-m-d H:i:s'); 
    
    if($items->create()){         
        http_response_code(201);         
        echo json_encode(array("message" => "Item was created."));
    } else{         
        http_response_code(503);        
        echo json_encode(array("message" => "Unable to create item."));
    }
}else{    
    http_response_code(400);    
    echo json_encode(array("message" => "Unable to create item. Data is incomplete."));
}
?>

<?php
function create(){
		
	$stmt = $this->conn->prepare("
		INSERT INTO ".$this->itemsTable."(`name`, `description`, `price`, `category_id`, `created`)
		VALUES(?,?,?,?,?)");
	
	$this->name = htmlspecialchars(strip_tags($this->name));
	$this->description = htmlspecialchars(strip_tags($this->description));
	$this->price = htmlspecialchars(strip_tags($this->price));
	$this->category_id = htmlspecialchars(strip_tags($this->category_id));
	$this->created = htmlspecialchars(strip_tags($this->created));
	
	
	$stmt->bind_param("ssiis", $this->name, $this->description, $this->price, $this->category_id, $this->created);
	
	if($stmt->execute()){
		return true;
	}
 
	return false;		 
}
?>



<?php
function read(){	
	if($this->id) {
		$stmt = $this->conn->prepare("SELECT * FROM ".$this->itemsTable." WHERE id = ?");
		$stmt->bind_param("i", $this->id);					
	} else {
		$stmt = $this->conn->prepare("SELECT * FROM ".$this->itemsTable);		
	}		
	$stmt->execute();			
	$result = $stmt->get_result();		
	return $result;	
}
?>



<?php

function update(){
	 
	$stmt = $this->conn->prepare("
		UPDATE ".$this->itemsTable." 
		SET name= ?, description = ?, price = ?, category_id = ?, created = ?
		WHERE id = ?");
 
	$this->id = htmlspecialchars(strip_tags($this->id));
	$this->name = htmlspecialchars(strip_tags($this->name));
	$this->description = htmlspecialchars(strip_tags($this->description));
	$this->price = htmlspecialchars(strip_tags($this->price));
	$this->category_id = htmlspecialchars(strip_tags($this->category_id));
	$this->created = htmlspecialchars(strip_tags($this->created));
 
	$stmt->bind_param("ssiisi", $this->name, $this->description, $this->price, $this->category_id, $this->created, $this->id);
	
	if($stmt->execute()){
		return true;
	}
 
	return false;
}
?>

<?php
function delete(){
		
	$stmt = $this->conn->prepare("
		DELETE FROM ".$this->itemsTable." 
		WHERE id = ?");
		
	$this->id = htmlspecialchars(strip_tags($this->id));
 
	$stmt->bind_param("i", $this->id);
 
	if($stmt->execute()){
		return true;
	}
 
	return false;		 
}
?>