<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>::: www.sytems92.com :::</title>
<style>
    body {
        font: 14px Arial,sans-serif; 
        margin: 0px;
    }
    .header {
        padding: 10px 20px;
        background: lightblue; 
        /*height: 200px; */
        
    }
    .header h1 {
        font-size: 24px;
    }
    .container {
        width: 100%;
        background: #f2f2f2; 
         /*height: 400px;*/
    }
    .nav, .section {
        float: left; 
        padding: 20px;
        /* min-height: 800px; */
        min-height:45rem;
        box-sizing: border-box;
    }
    .nav {            
        width: 20%;             
        background: #d4d7dc;
    }
    .section {
        width: 80%;
    }
    .nav ul {
        list-style: none; 
        line-height: 24px;
        padding: 0px; 
    }
    .nav ul li a {
        color: #333;
    }    
    .clearfix:after {
        content: ".";
        display: block;
        height: 0;
        clear: both;
        visibility: hidden;
    }
    .footer {
        background: #acb3b9;            
        text-align: center;
        padding: 5px;
        /*height: 200px; */
    }
</style>
</head>
<body>
    <div class="container">
        <div class="header" "height: 200px">
            <h1>Tutorial Republic</h1>
        </div>
        <div class="wrapper clearfix">
            <div class="nav">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li> <form><input type="submit" value="Go to Google" /></form> </li>
                </ul>
            </div>
            <div class="section">
                <h2>Welcome to our site</h2>
                <p>Here you will learn how to create websites...</p>
                
                </br>
                <form action="" method="POST">
<label>Enter Order ID:</label><br />
<input type="text" name="order_id" placeholder="Enter Order ID" />
<button type="submit" name="submit">Submit</button>
</br><button type="submit" name="submit1">get All</button>
</form>

<?php
// https://www.tutorialrepublic.com/html-tutorial/html-layout.php

if (isset($_POST['order_id']) && $_POST['order_id']!="") {
	$order_id = $_POST['order_id'];
	//$url = "http://localhost/rest/api/".$order_id;
	//http://systems92.com/pms/api.php?order_id=1001
	$url = "http://systems92.com/pms/api.php?order_id=".$order_id;
		
	$client = curl_init($url);
	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($client);
	
	$result = json_decode($response);
	echo "</br></br>";
	echo "<table border=1>";
	echo "<tr><td>Order ID:</td><td>$result->order_id</td>";
	echo "<td>Amount:</td><td>$result->amount</td>";
	echo "<td>Response Code:</td><td>$result->response_code</td>";
	echo "<td>Response Desc:</td><td>$result->response_desc</td></tr>";
	echo "</table>";
}
else {
   	echo "</br>get All Called</br>"; 
    $url = "http://systems92.com/pms/api.php";
    
    $client = curl_init($url);
	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($client);
	
	$result = json_decode($response);
	echo "</br></br>";
	echo "<table border=1>";
	echo "<tr><td>Order ID:</td><td>$result->order_id</td>";
	echo "<td>Amount:</td><td>$result->amount</td>";
	echo "<td>Response Code:</td><td>$result->response_code</td>";
	echo "<td>Response Desc:</td><td>$result->response_desc</td></tr>";
	echo "</table>";
	
}

    ?>
    
                </br><p>
                    What is the difference between wrapper and container in CSS?
In programming languages the word container is generally used for structures that can contain more than one element. 
A wrapper instead is something that wraps around a single object to provide more functionalities and interfaces to it.
                </p>
            </div>
        </div>
        <div class="footer">
            <p>copyright &copy; systems92 dotcom </p>
        </div>
    </div>
</body>
</html>