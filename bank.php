<?php
$server="localhost";
$dbname="Bank";
$user="root";
$password="";
$port=3306;
//die(printf("here  is the top"));
$connect=mysqli_connect($server,$user,$password,$dbname,$port);
if(!$connect){echo "connecttion failed :".mysqli_connect_error();}

//try
//{mysqli_connect($server,$user,$password,$dbname,$port);}

//catch(Throwable $e){
//	die("Connection failed: " . mysqli_connect_error() );}
  $sql = "SELECT * FROM clients";
  $result = mysqli_query($connect,$sql);
//  die(printf("here"));
//  print_r($result);
//  $json = mysqli_fetch_all ($result);
//echo json_encode($json );
 
//  die(printf("here"));
//  print_r($result);
  if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
	  echo "id: " . $row["id"]. " - Name: " . $row["name"]. " balance =" . $row["balance"]. "<br>";
	}
  } else {
	echo "0 results";
  }

  
