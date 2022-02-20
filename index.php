
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
      <?php 
      session_start();
      $server="localhost";
$dbname="Bank";
$user="root";
$password="";
$connect=mysqli_connect($server,$user,$password,$dbname);
if(!$connect){echo "connecttion failed :".mysqli_connect_error();};
$sql = "SELECT * FROM clients";
  //===================================================================================
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $from=$_POST["fm"];
  $_SESSION["from"]=$from;
   
    
    $_SESSION["to"]=$_POST["to"];
   
    $_SESSION["amount"]=$_POST["mount"];}
    
//================================================================================
$result2 = mysqli_query($connect,$sql);
if ($result2->num_rows > 0) {
    while($row2= $result2->fetch_row()) {
    $r2[]=$row2[1];
    $b2[]=$row2[2];
           }}
        //===================================================================================

$result = mysqli_query($connect,$sql);

if ($result->num_rows > 0) {
    while($row= $result->fetch_row()){
    $r[]=$row[1];
    $b[]=$row[2];

}}

      for($a=0;$a< count($r);$a++)
  {
          
          //اللوب الاولى عشان امشى واحده واحده على الاسماء و اتشوف الاسم الاول  بيساوى اللى دخل ف الكوكيز ولا لأ
          if($_SESSION["from"]=== $r[$a])
            {
              //الشرط التانى عشان اشوف هل بيبعت لنفس الشخص ولا لا من والى نفس الشخص 
              if($r[$a]===$_SESSION["to"]){
                echo "Error : Transfairng to same account <br>";
                break;
              }
              //هنا اتأكدت انه مش نفس الشخص و هنا بيقارن الكميه اللى دخلت بحساب الشخص اللى رقمه كذا ول و مش مغطى الحساب 
            if ($_SESSION["amount"]>$b[$a]||$_SESSION["amount"]<=0) {
                echo "sorry ".$r[$a]." cann't cover this amount please enter smaller amount or you entered invaled amount  <br>" ;
                break;
            }
            //=====================================================================================================
            //هنا كله تمام و الحساب مغطى الكميه و بيبدأ انه يخصم من الحساب و يضيف للحساب التانى

            else{ 
              
              for($z=0;$z< count($r2);$z++){ 
              if ($_SESSION["to"]=== $r2[$z]){
             $b2[$z]=$b2[$z]+$_SESSION["amount"];
          
               $b[$a]=  $b[$a]-$_SESSION["amount"];    
             
              
             $query="UPDATE clients SET balance=$b[$a] WHERE id=$a+1";
             $query0="UPDATE clients SET balance=$b2[$z] WHERE id=$z+1";
             
      
          
          
             if ($connect->query($query) === true && $connect->query($query0) === true){
              echo "Record updated successfully and 'to' balance is ".$b2[$z]." to ".$r2[$z]."<br>";
             echo "balance now for :".$r[$a]." is ".$b[$a]."  and the other to person is  ".$r2[$z]." and his balance ".$b2[$z];
          
            
            }
             else {
              echo " <br>Error updating record: " . $connect->error;
            } 

           }}
            
          // session_unset();
          // session_destroy();          

 
}}   }


      
            
          
         
      
?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
From  <select name="fm" value="<?php echo $_POST["from"] ?>">
        <?php   

    for($i=0;$i<count($r);$i++){
      echo 
          "<option> $r[$i]</option>";}
    ?>
</select> 

<!-- ========================================================================================================== -->

 To <select name="to" value="<?php echo $_POST["to"]?>" >
 <?php   
    for($i=0;$i<count($r2);$i++){
      echo 
          "<option> $r2[$i]</option>";}

?>
</select>
Amount <input type="Number" name="mount" value="1000" id="amount">
<input type="submit" name="submit" value="Submit"> 
</form>
</body>


</html>


        

  

