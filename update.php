<?php
if (isset($_POST['customerId']))
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
    $customerId =  $_POST['customerId'];
    $customerCode =  $_POST['customerCode'];
    $customerName =  $_POST['customerName'];
    $email =  $_POST['email'];
    $gender =  $_POST['gender'];
    
    $sql = "select * from customer where customerCode=? and customerId<>?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'si', $customerCode, $customerId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row=mysqli_fetch_assoc($result);

    
    if($row['customerCode'])
    {
      header('location:detail.php?error=1&customerId=' . $customerId . '&customerCode=' . $customerCode . '&customerName=' . $customerName . '&email=' . $email . '&gender=' . $gender  );  
      exit;
    }

    $sql = 'update customer set customerCode=?, customerName=?, gender=?, email=?  where customerId=?';
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'ssisi', $customerCode, $customerName, $gender, $email, $customerId);
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

