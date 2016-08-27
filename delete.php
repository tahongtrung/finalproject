<?php
if (isset($_POST['ids']))
{
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  $con=mysqli_connect($servername,$username,$password,$dbname);
  if (mysqli_connect_errno())
  {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  else
  {
    $customerId =  $_POST['ids'];
  
    $customerId = implode(',', $customerId);
    echo $customerId;
    
    $sql = "delete from customer where customerId in (" . $customerId . ")";
    $stmt = mysqli_prepare($con, $sql);
    if(mysqli_stmt_execute($stmt))
    {
       header('location:customer.php');
    }
    else
    {
    
    }
    
    
    
    mysqli_free_result($result); 
    mysqli_close($con);
 }
}
?>

