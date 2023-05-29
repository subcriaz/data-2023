<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/Database.php';
//include_once '../class/Items.php';
 
// beigin class

class Items{   
    
    private $itemsTable = "items";      
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;   
    public $created; 
	public $modified; 
    private $conn;
	//echo "  up cons ew items a4444 ";
    public function __construct($db){
		//echo "  cons ew items a4444 ";
        $this->conn = $db;
    }		
	
	
	function create(){
		
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->itemsTable."(`id` , `name`, `description`, `price`, `category_id`, `created`)
			VALUES(?,?,?,?,?,?)");
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->description = htmlspecialchars(strip_tags($this->description));
		$this->price = htmlspecialchars(strip_tags($this->price));
		$this->category_id = htmlspecialchars(strip_tags($this->category_id));
		$this->created = htmlspecialchars(strip_tags($this->created));
		
		
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->description = htmlspecialchars(strip_tags($this->description));
		$this->price = htmlspecialchars(strip_tags($this->price));
		$this->category_id = htmlspecialchars(strip_tags($this->category_id));
		$this->created = htmlspecialchars(strip_tags($this->created));
	 
		$stmt->bind_param("issiis", $this->id, $this->name, $this->description, $this->price, $this->category_id, $this->created);
		
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
			
}

// end class

$database = new Database();
$db = $database->getConnection();
 
$items = new Items($db);
 
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->id) && !empty($data->name) && 
!empty($data->description) && !empty($data->price) && 
!empty($data->category_id)){ 
	
	$items->id = $data->id; 
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
        echo json_encode(array("message" => "Unable to create item 123.". $items->name));
    }
}else{    
    http_response_code(400);    
    echo json_encode(array("message" => "Unable to create item. Data is incomplete."));
}
?>