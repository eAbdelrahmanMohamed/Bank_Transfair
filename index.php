
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
<style>

form{display:flex;
justify-content:center;
align-items:center;}
select,input{padding:1em;
margin:5px;}
div{background-color:red;
color:white;}
p{background-color:blueviolet;
color:white;}
</style>
    </head>

  <body>
      <?php $server="localhost";
$dbname="Bank";
$user="root";
$password="";
$port=3306;
$connect=mysqli_connect($server,$user,$password,$dbname);
if(!$connect){echo "connecttion failed :".mysqli_connect_error();};
$sql = "SELECT * FROM clients";
  //===================================================================================
//  $r=$b="";
$_COOKIE["from"]="";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $from=$_POST["fm"];
  $_COOKIE["from"]=$from;
   
    
    $_COOKIE["to"]=$_POST["to"];
   
    $_COOKIE["amount"]=$_POST["mount"];}
    
//================================================================================
$result = mysqli_query($connect,$sql);
$row=$r[]=$b[]="";
if ($result->num_rows > 0) {
    while($row= $result->fetch_row()){
    $r[]=$row[1];
    $b[]=$row[2];

}}for($a=0;$a<=3;$a++)
        {   
            
            if ($b[$a]>$_COOKIE["amount"]) {
                //echo "sorry ".$r[$a]." cann't cover this amount please enter smaller amount  <br>" ;
                $b[$a]=  $b[$a]-$_COOKIE["amount"];
                echo "balance now is :".$b[$a];
                $query="UPDATE clients SET balance=$b[$a] WHERE id=$a";

if ($connect->query($query) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $connect->error;
  }
            }
            }
         
            
         
            

      
        //===================================================================================
        $result2 = mysqli_query($connect,$sql);
        if ($result2->num_rows > 0) {
            while($row2= $result2->fetch_row()) {
            $r2[]=$row2[1];
                   }}
      
?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
From  <select name="fm" value="<?php echo $_COOKIE["from"] ?>">
        <?php   

    for($i=0;$i<=3;$i++){
      echo 
          "<option> $r[$i]</option>";}
    ?>
</select> 

        



<!-- ========================================================================================================== -->

 To <select name="to" value="<?php echo $_COOKIE["to"]?>" >
 <?php   
    for($i=0;$i<=3;$i++){
      echo 
          "<option> $r2[$i]</option>";}

?>
</select>
Amount <input type="Number" name="mount" value="1000" id="amount">



<input type="submit" name="submit" value="Submit"> 
</form>
</body>

<div>
<?php 
//$n="gkjgkufiyodfou";
//switch($r){
//    case 'abdo': $n="you selected abdo";break;
//    case "omar": $n= "you selected omar";break;
//    case "mahmoud": $n= "you selected hoda";break;
//    case "ahmed": $n="you selected ahmed";break;
//}
echo $_COOKIE["from"].isset($row[2])."<br><hr>".$_COOKIE["to"]."<br><hr>".$_COOKIE["amount"]."<br><hr>";?>
</div>
</html>

        

  

