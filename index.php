
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
$_COOKIE["from"]="";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $from=$_POST["fm"];
  $_COOKIE["from"]=$from;
   
    
    $_COOKIE["to"]=$_POST["to"];
   
    $_COOKIE["amount"]=$_POST["mount"];}
    
//================================================================================
$result2 = mysqli_query($connect,$sql);
if ($result2->num_rows > 0) {
    while($row2= $result2->fetch_row()) {
    $r2[]=$row2[1];
    $b2[]=$row2[2];
           }}
        //===================================================================================

$result = mysqli_query($connect,$sql);
$row=$r[]=$b[]="";
if ($result->num_rows > 0) {
    while($row= $result->fetch_row()){
    $r[]=$row[1];
    $b[]=$row[2];

}}

      for($a=0;$a<10;$a++)
  {
          
          //اللوب الاولى عشان امشى واحده واحده على الاسماء و اتشوف الاسم الاول  بيساوى اللى دخل ف الكوكيز ولا لأ
          if($_COOKIE["from"]=== $r[$a])
            {
              //الشرط التانى عشان اشوف هل بيبعت لنفس الشخص ولا لا من والى نفس الشخص 
              if($r[$a]===$_COOKIE["to"]){
                echo "Error : Transfairng to same account <br>";
                break;
              }
              //هنا اتأكدت انه مش نفس الشخص و هنا بيقارن الكميه اللى دخلت بحساب الشخص اللى رقمه كذا ول و مش مغطى الحساب 
            if ($_COOKIE["amount"]>$b[$a]) {
                echo "sorry ".$r[$a]." cann't cover this amount please enter smaller amount  <br>" ;
                break;
            }
            //=====================================================================================================
            //هنا كله تمام و الحساب مغطى الكميه و بيبدأ انه يخصم من الحساب و يضيف للحساب التانى

            else{ 
              //$z=0;
              //while($z<10){
              for($z=0;$z<10;$z++){ 
              if ($_COOKIE["to"]=== $r2[$z]){
             $b2[$z]=$b2[$z]+$_COOKIE["amount"];
          
               $b[$a]=  $b[$a]-$_COOKIE["amount"];    
              
              
             $query="UPDATE clients SET balance=$b[$a] WHERE id=$a";
             $query0="UPDATE clients SET balance=$b2[$z] WHERE id=$z+1";
             
      
          if($connect->query($query0) === true){
            echo "cond 1 is ture";
             if ($connect->query($query) === true ){
              echo "<br>Record updated successfully and 'to' balance is ".$b2[$z]." to ".$r2[$z]."<br>";
             echo "balance now for :".$r[$a]." is ".$b[$a]."  and the other to person is  ".$r2[$z]." and his balance ".$b2[$z];

              
            }
             else {
              echo " <br>Error updating record: " . $connect->error;
            } }

            else {
              echo " <br>Error updating record: " . $connect->error;
            }}}
            
                         
//if ($connect->query($q2) === TRUE && $connect->query($query) === TRUE) {
 
}}}


      
            
          
         
      
?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
From  <select name="fm" value="<?php echo $_COOKIE["from"] ?>">
        <?php   

    for($i=1;$i<=12;$i++){
      echo 
          "<option> $r[$i]</option>";}
    ?>
</select> 

<!-- ========================================================================================================== -->

 To <select name="to" value="<?php echo $_COOKIE["to"]?>" >
 <?php   
    for($i=0;$i<=12;$i++){
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

echo $_COOKIE["from"].isset($row[2])."<br><hr>".$_COOKIE["to"]."<br><hr>".$_COOKIE["amount"]."<br><hr>";?>
</div>
</html>


        

  

