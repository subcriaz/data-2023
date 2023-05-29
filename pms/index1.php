<form action="" method="POST">
<label>Enter ID:</label><br />
<input type="text" name="id" placeholder="Enter ID" required/>
<br /><br />
<button type="submit" name="submit">Submit</button>
</form>

<?php
if (isset($_POST['id']) && $_POST['id']!="") {
	$id = $_POST['id'];
	$url = "systems92.com/api1/items/read/".$id;
	//$url = "systems92.com/api1/items/read/";
	//echo 	$url."\n" ;

	$client = curl_init($url);
		
	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($client);
	echo 	$response ; 
	$result = json_decode($response);
	//echo  ($result->items)[0]->id;
	$item = ($result->items)[0];
	echo $item->id;
	//echo 	$result.'\n' ; ;
	echo "<table border=1>";
	echo "<tr><td>ID:</td><td>$item->id</td>";
	echo "    <td>Amount:</td><td>$item->name</td>";
	echo "    <td>Response Code:</td><td>$item->description</td>";
	echo "    <td>Response Desc:</td><td>$item->price</td></tr>";
	echo "</table>";
}
    ?>