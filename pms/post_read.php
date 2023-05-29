<form action="" method="POST">
<label>Enter ID:</label><br />
<input type="text" name="id" placeholder="Enter ID" />
<br /><br />
<button type="submit" name="submit">Submit</button>
<br /><br />
<button type="submit" name="submit">get All</button>
</form>

<?php
if (isset($_POST['id']) && $_POST['id']!="") {
	$id = $_POST['id'];
	$url = "systems92.com/api1/items/read/".$id;
	//$url = "systems92.com/api1/items/read/";
	//echo 	$url."\n" ;
	echo 	$url."<br>" ;
	$client = curl_init($url);
		
	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($client);
	echo 	$response ."<br>" ."<br>" ; 
	$result = json_decode($response);
	//echo  ($result->items);
	$item = ($result->items)[0];
	//echo $item->id;
	//echo 	$result.'\n' ; ;
	echo "<table border=1>";
	echo "<tr><td>ID:</td><td>$item->id</td>";
	echo "    <td>Amount:</td><td>$item->name</td>";
	echo "    <td>Response Code:</td><td>$item->description</td>";
	echo "    <td>Response Desc:</td><td>$item->price</td></tr>";
	echo "</table>";
}
else
{
	$url = "systems92.com/api1/items/read/";
	//echo 	$url."<br>" ;

	$client = curl_init($url);
		
	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($client);
	echo 	$response."<br>"."<br>" ; 
	$result = json_decode($response);
	//echo  count($result->items)."   count <br>";

	$mcount = count($result->items);

	//echo  $mcount;
	echo "<table border=1>";
	for ($x = 0; $x <= $mcount-1; $x++) {
		//echo "The number is: $x <br>";
		$item = ($result->items)[$x];
		echo "<tr><td>ID:</td><td>$item->id</td>";
		echo "    <td>Amount:</td><td>$item->name</td>";
		echo "    <td>Response Code:</td><td>$item->description</td>";
		echo "    <td>Response Desc:</td><td>$item->price</td></tr>";
	  }
	
	echo "</table>";

}
    ?>