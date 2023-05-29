<?php
header("Content-Type:application/json");
$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
//echo '<a href="' . $escaped_url . '">' . $escaped_url . '</a>';
// https://www.tutorialrepublic.com/html-tutorial/html-layout.php


//echo  $escaped_url;
//print_r(explode('=', $escaped_url, 2));
$m_ary = explode('=', $escaped_url, 2);

//echo $m_ary[0];
//echo "</br>";
//echo $m_ary[1];
//echo "is Null ? " . is_null($m_ary[1])  ;

if  ( is_null($m_ary[1]) ) {  //echo "All Recored"  ;
  
  
  	$result = mysqli_query(	$con, 	"SELECT * FROM `transactions`");
	if(mysqli_num_rows($result)>0){
	$row = mysqli_fetch_array($result);
	$amount = $row['amount'];
	$response_code = $row['response_code'];
	$response_desc = $row['response_desc'];
	response($order_id, $amount, $response_code,$response_desc);
	mysqli_close($con);
	}else{
		response(NULL, NULL, 200,"No Record Found");
	}
		
}
else {
    if (isset($_GET['order_id']) && $_GET['order_id']!="") {
	include('db.php');
	$order_id = $_GET['order_id'];
	$result = mysqli_query(	$con, 	"SELECT * FROM `transactions` WHERE order_id=$order_id");
	if(mysqli_num_rows($result)>0){
	$row = mysqli_fetch_array($result);
	$amount = $row['amount'];
	$response_code = $row['response_code'];
	$response_desc = $row['response_desc'];
	response($order_id, $amount, $response_code,$response_desc);
	mysqli_close($con);
	}else{
		response(NULL, NULL, 200,"No Record Found");
		}
}else{
	response(NULL, NULL, 400,"Invalid Request");
	}
    
}




function response($order_id,$amount,$response_code,$response_desc){
$response['order_id'] = $order_id;
	$response['amount'] = $amount;
	$response['response_code'] = $response_code;
	$response['response_desc'] = $response_desc;
	
	$json_response = json_encode($response);
	echo $json_response;
}


?>