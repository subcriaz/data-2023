<html>
<head>
<title> ::::... dp online ...::::</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>

* {
  box-sizing: border-box;
}

.row {
  display: flex;
  margin-left:-5px;
  margin-right:-5px;
}

.column {
  flex: 50%;
  padding: 5px;
}

table1 {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th1, td1 {
  text-align: left;
  padding: 16px;
}


table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 0px;
}


tr:nth-child(even) {
  background-color: #f2f2f2;
}


.container {
        display: grid;
        grid-template-columns: 400px 400px; 
        grid-template-rows: 100px;
        grid-column-gap: 25px;
      }
      
      .item {
      background: lightblue;
 
       
      }
	  
.float-container {
    border: 3px solid #fff;
    padding: 20px;
}

.float-child {
    width: 50%;
    float: left;
    padding: 20px;
    border: 2px solid red;
}  

p,
label {
    font: 1rem 'Fira Sans', sans-serif;
}

input {
    margin: .4rem;
}

.grid-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 20px;
}
</style>

 <script type="text/javascript">






// Pass the checkbox name to the function

// Call as
//var checkedBoxes = getCheckedBoxes("mycheckboxes");


</script>
</head>
<body>


<?php
//echo $_POST['user'];
$usernam = $_POST['user'];
echo $usernam;
if ($_POST['action'] == 'List') {
        if(isset($_POST['distname']))
        {
            //echo "You have selected :".$_POST['distname'];  //  Displaying Selected Value


$servername = "systems92.com";
$username = "systemsc";
$password = "od*m*w6256F";
$dbname = "systemsc_dp";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection  // ORDER BY article_rating DESC, article_time DESC 
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "</br>";
$sql = "SELECT * FROM t2 where dist  LIKE"." '".$_POST['distname']."%' order by cat , name ";  
echo $_POST['distname'];
echo "</br>";
?>
  
  <form action='' method='post'>


<?php
$result = mysqli_query($conn, $sql);
 echo "<table border=1> <tr> <th>.</th><th>.</th>  <th> dist </th><th> cat </th>  <th>short? </th> <th>name </th> <th> price </th> ";
 echo "<th> qty </th> <th> item total  </th><th> running total </th>  </tr>" ;
 
if (mysqli_num_rows($result) > 0) {
  $rowcount = 0;
  while($row = mysqli_fetch_assoc($result)) {
	$rowcount+=1;
	echo  "<tr>";
	echo  "<td><input type='text' size='1'  name='rowid[]'  value='".$rowcount . " ' disabled  hidde/> </td>";  
	echo  "<td><input type='text' size='1' name='idarray[]'  value='".$row["id"] . " ' disabled hidde/> </td>";  
	echo  "<td><input type='text' size='3'	name='distarray[]' value='".$row["dist"] ."' /> </td>";  
	echo  "<td><input type='text' size='3' name='catarray[]' value='".$row["cat"] ."' /> </td>"; 
	echo  "<td><input type='checkbox' 	name='isshortarray[]' value='" . $row["isshort"] . "'  " . $row["isshort"] . "/></td>";
	echo  "<td><input type='text' size='30'	name='namearray[]' value='".strtolower($row["name"]) ."' /> </td>";  	
	echo  "<td><input type='text' size='3' name='pricearray[]' value='".$row["price"] ."' onblur='dototal(".$rowcount . ",`".$usernam."`)' /> </td>";  
	echo  "<td><input type='text' size='3' name='qtyarray[]' value=''                     onblur='dototal(".$rowcount . ",`".$usernam."`)' /> </td>";  
	echo  "<td><input type='text' size='4' name='totarray[]' value='0' disabled /> </td>";  
	echo  "<td><input type='text' size='4' name='runtotalarray[]' value='0' disabled /> </td></tr>";  
	
	
	
	  }
 } else {
        echo "0 results for ".$_POST['distname'];
  }
echo "</table>";
mysqli_close($conn);	
}
 }
 
 
 
?>

			
		
			<input type="text" size='3' class="form-control" id="id" placeholder="id" name="id" hidden>
			<input type="text" size='3' class="form-control" id="dist" placeholder="dist" name="dist" hidden >
			<input type="text" size='3'class="form-control" id="name" placeholder="nm" name="name" hidden>
			<input type="text" size='3'class="form-control" id="cat" placeholder="cat" name="cat" hidden>
			<input type="text" size='3' class="form-control" id="price" placeholder="pri" name="price" hidden>
			<input type="text" size='3' class="form-control" id="qty" placeholder="qty" name="qty" hidden>
			<input type="text" size='3' class="form-control" id="isshort" placeholder="isshort" name="isshort" hidden>
			
<input type="button" name="save" class="btn btn-primary" value="Save to database" id="butsave" hidden>
</form>



  
<div class="row"> 
	<div class="column">
		<table id='items_table1' border=1>
		<tr><th colspan='1'> List1</th></tr>
		<tr><th>name</th></tr>
		</table>
	
  </div>
  <div class="column">
    <table id='items_table2' border=1>
		<tr><th colspan='6'> List2</th></tr>
		<tr><th>name</th> <th>cat</th><th>qty</th><th>name</th> <th>cat</th><th>qty</th></tr>
		</table>
  </div>
</div>



	
<script type="text/javascript"> 


	
function dototal(id,usernam){
	//console.log(id);
	//console.log (<?php $usernam ?>);
	//console.log (usernam);
	//return false;
//updaing this row to database using ajax call, name and price will be updated
	
	
	var priAry = document.getElementsByName('pricearray[]');
	var qtyAry = document.getElementsByName('qtyarray[]');
	if (priAry[id-1].value> -1 && qtyAry[id-1].value> -1) {	var currtotal = priAry[id-1].value * qtyAry[id-1].value ;} else {return false;}
	//if ( qtyAry[id-1].value=0) {	var currtotal = 0 ;} else {}
	var idAry = document.getElementsByName('idarray[]');
	var namAry = document.getElementsByName('namearray[]');
	var catAry = document.getElementsByName('catarray[]');
	var distAry = document.getElementsByName('distarray[]');
	var isshortAry = document.getElementsByName('isshortarray[]');
	
	var prevtotal = 0;
	var difftotal = 0;
	prevtotal = parseInt(document.getElementsByName('totarray[]')[id-1].value);
	document.getElementsByName('totarray[]')[id-1].value = currtotal;
	difftotal =   currtotal - prevtotal;
	
//updaing this row to database using ajax call, name and price will be updated
//console.log ( id + '  '+ idAry[id-1].value + '  '  + isshortAry[id-1].value);
document. getElementById('id'). value = idAry[id-1].value;       // 1
document. getElementById('name'). value = namAry[id-1].value;  // 2
document. getElementById('cat'). value = catAry[id-1].value;   // 3
document. getElementById('price'). value = priAry[id-1].value; // 4 
document. getElementById('qty'). value = qtyAry[id-1].value; // 5  , qty not required , will be required in order table insertion
document. getElementById('dist'). value = distAry[id-1].value; // 5 
document. getElementById('msg'). value = 'ok..' ; 

document. getElementById('ordervalue'). value = 'ok..' ; 

//document. getElementById('msg'). value = 'ok ....' ;	

//console.log (isshortAry[id-1].checked);
if (isshortAry[id-1].checked ){document. getElementById('isshort'). value = 'checked'} else {document. getElementById('isshort'). value = 'n'};
//document. getElementById('isshort'). value = isshortAry[id-1].value; // 5  , qty not required , will be required in order table insertion
//console.log ( id + '  '+ isshortAry[id-1].value);
document. getElementById('butsave'). click();
//updaing this row to database 


// updating running total of this row and rows below yhis row
	let length = priAry.length;;
	//console.log (length);
	for (let i = id-1; i <  length; i++) {
		document.getElementsByName('runtotalarray[]')[i].value = parseInt(document.getElementsByName('runtotalarray[]')[i].value) + difftotal;
		//console.log(document.getElementsByName('totarray[]')[i-1].value);
		//running = running + parseInt (document.getElementsByName('totarray[]')[i-1].value);
		//prevrunning += parseInt(prevrunning) + parseInt(document.getElementsByName('totarray[]')[i-1].value);
		
	}
	
	var orderval = 0;
	orderval = parseInt(document.getElementsByName('runtotalarray[]')[length-1].value);
	document. getElementById('ordervalue'). value = orderval - (orderval*0.15) ; 
	
	dynamic_table(id , usernam,length , idAry,namAry , priAry , qtyAry);
	}
	

function dynamic_table(id , usernam,length , idAry,namAry , priAry , qtyAry) {

            //var namAry = document.getElementsByName('namearray[]'); 
			//var catAry = document.getElementsByName('catarray[]');
			//var qtyAry = document.getElementsByName('qtyarray[]');
			//var runtotalAry = document.getElementsByName('runtotalarray[]');
			
			//let length = namAry.length;;
	var items_table1 = document.getElementById('items_table1');
	var items_table2 = document.getElementById('items_table2');
	items_table1.innerHTML  = "<div class='column'><table id='items_table1' border=1><tr><th colspan='1'> List 1</th></tr>";
	items_table1.innerHTML  += '<tr><th>' + 'name'+ '</th></tr>';
	
	items_table2.innerHTML  = "<div class='column'><table id='items_table2' border=1><tr><th colspan='6'> List 2</th></tr>";
	items_table2.innerHTML  += '<tr><th>id</th><th>name</th> <th>price</th><th>qty</th> <th>user</th> <th>dt</th></tr>';
	
	//////////
	var feed = "{";
	var data = [];
	
	/*
	
	var feed = {created_at: "2017-03-14T01:00:32Z", entry_id: 33358, field1: "4", field2: "4", field3: "0"};

	var data = [];
	data.push(feed);

	console.log(data);
	*/
	
	var mjson = document.getElementsByName('jsonstr');
	//console.log (length);
	for (let i = 0; i <  length; i++) { //  ' + catAry[i].value + ' ' + qtyAry[i].value +'
		if (qtyAry[i].value > 0 ){
			//alert (i); 
			feed = "{";
			items_table1.innerHTML += '<tr><td>' + namAry[i].value + ' --- '+  qtyAry[i].value + '</td></tr>';
			items_table2.innerHTML += '<tr><td>' + idAry[i].value + ' </td><td>'+  namAry[i].value + '</td> <td>' + priAry[i].value + ' </td> <td> '+  qtyAry[i].value + '</td><td>' + usernam + ' </td> <td> '+  usernam + '</td></tr>';
			//if (feed=="{") {
				//	feed = "{ 'id' : '" + idAry[i].value +"' , 'name' : '" +  namAry[i].value + "' , 'price' : '" + priAry[i].value +  "' , 'qty' : '" +	qtyAry[i].value +"' , 'user' : ' " + usernam +"' , 'dt' : '" + 'dt'+ "' }";  
			//}
			//else {
				//	feed += " , { 'id' : '" + idAry[i].value +"' , 'name' : '" +  namAry[i].value + "' , 'price' : '" + priAry[i].value +  "' , 'qty' : '" +	qtyAry[i].value +"' , 'user' : ' " + usernam +"' , 'dt' : '" + 'dt1' + "' }";  
			//}
			
			}	
	}
	//console.log(feed);
	items_table1.innerHTML+= "</table></div>";
	items_table2.innerHTML+= "</table></div>";
//alert ( document.getElementsByName('lname').value);
 //document.getElementsByName('orderValue').value = '1';//runtotalAry[length-1].value; 
 //document.getElementsByName('ordervalue15').value = '2';  //parseInt(runtotalAry[length-1].value)*(15/100);   
 //feed += "]";
 //data.push(feed);
//mjson.value += feed;
//console.log(feed);
} 
////////////////////////////////////////////////

///////////////////////////////////////////////////
$(document).ready(function() {

$('#butsave').on('click', function() {
$("#butsave").attr("disabled", "disabled");
//alert(id);
var id = $('#id').val();
var name = $('#name').val();
var cat = $('#cat').val();
var price = "'" + ($('#price').val()) + "'";
var dist = $('#dist').val();
var isshort = $('#isshort').val();

if(name!="" ){
	$.ajax({
		url: "save.php",
		type: "POST",
		data: {
			id : id,
			name: name,
			dist : dist,
			cat: cat,
			isshort : isshort ,
			price : price
			
		},
		cache: false,
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			if(dataResult.statusCode==200){
				$("#butsave").removeAttr("disabled");
				$('#fupForm').find('input:text').val('');
				$("#success").show();
				$('#success').html('Data added successfully !'); 	
				
			}
			else if(dataResult.statusCode==201){
				//alert("Error occured !");
			}
			
		}
	});
	}
	else{
		alert('Please fill all the field !');
	}
});

$('#btnsaveorder').on('click', function() {
$("#btnsaveorder").attr("disabled", "disabled");
alert('id');
//var table = document.getElementById('items_table2');
  //var jsonArr = [];
  
  // https://www.fourfront.us/blog/store-html-table-data-to-javascript-array/
  var TableData = new Array();
    
$('#items_table2 tr').each(function(row, tr){
    TableData[row]={
        "id" : $(tr).find('td:eq(0)').text()
        , "name" :$(tr).find('td:eq(1)').text()
        , "price" : $(tr).find('td:eq(2)').text()
        , "qty" : $(tr).find('td:eq(3)').text()
		 , "usr" : $(tr).find('td:eq(4)').text()
		  , "dt" : $(tr).find('td:eq(5)').text()
    }
	
	
}); 
TableData.shift();  // first row is the table header - so remove
console.log(TableData);



});

////////////
});



</script>
<form>
<input type="text" size='10' class="form-control" id="msg" placeholder="message" name="msg" disabled>
<input type="text" size='10' class="form-control" id="ordervalue" placeholder="ordervalue" name="ordervalue" disabled></br>
<input type="text" size='10' class="form-control" id="jsonstr" placeholder="jjj" name="jsonstr" disabled></br>
			<input type="button" name="saveorder" class="btn btn-primary" value="Save Order" id="btnsaveorder">
</form>
</body>
</html>

  
  