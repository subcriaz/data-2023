<form action="" method="POST">
<label>Enter ID:</label>
<input type="text" name="id" placeholder="Enter ID" /><br />
<input type="text" name="name" placeholder="Enter name" /><br />

<input type="text" name="description" placeholder="Enter description" /><br />
<input type="text" name="price" value = "900" placeholder="Enter price" /><br />

<input type="text" name="category_id" value = "6" placeholder="Enter category_id" /><br />
<input type="text" name="created" value = "2023-05-28 19:09:01" placeholder="Enter created" /><br />


<br /><br />
<button type="submit" name="submit">Submit</button>

</form>

<?php


$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, 'http://systems92.com/api1/items/create');
curl_setopt($curl, CURLOPT_POST, true);
/* 
$data = array('id' => 1011, 'name' => 'John', 'description' => 'description.com' , 
'price' => 666 , 'category_id' => 101 , 'created' => '2023-05-28 19:09:01' );
*/

///////////////////////////////////////
$data = json_decode(file_get_contents("php://input"));
echo $data ;

$item->id = 123 ;//$data->id; 
$item->name = 'sadsad';//$data->name;
$item->description ='sadsad' ;//;$data->description;
$item->price = 123 ;//$data->price;
$item->category_id = 123;//$data->category_id;	
$item->created = date('Y-m-d H:i:s'); 

$item->id = $_POST['id']; 
$item->name = $_POST['name']; 
$item->description =$_POST['description']; 
$item->category_id = $_POST['category_id']; 	
$item->created = date('Y-m-d H:i:s'); 

echo json_encode($item);  

curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($item));

$headers = array(
    'Authorization: Bearer ' . $access_token,
    'Content-Type: application/json',
);

curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($curl);

curl_close($curl);

    ?>