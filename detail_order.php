<?php
if (isset($_GET['orderId']))
{
  
  $customerName = '';
  $email = '';
  $email = '';
  
  if(isset($_GET['error']))
  {
	$employeeId = isset($row['employeeId'])? $_GET['emloyeeId'] : '';
    $orderId = isset($_GET['orderId']) ? $_GET['orderId'] : '';
    $customerCode = isset($_GET['customerCode']) ? $_GET['customerCode'] : '';
    //$customerName = isset($_GET['customerCode']) ? $_GET['customerName'] : '';
    $email = isset($_GET['email']) ? $_GET['email'] : '';
    //$gender = isset($_GET['gender']) ? $_GET['gender'] : '';

  }
  else
  {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";
    $con=mysqli_connect($servername,$username,$password,$dbname);
    if (mysqli_connect_errno())
    {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
       exit;
    }
    else
    {
      $orderId =  $_GET['orderId'];
      $sql = 'select * from saleorder where orderId=?';
      $stmt = mysqli_prepare($con, $sql);
      mysqli_stmt_bind_param($stmt, 'i', $orderId);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($row=mysqli_fetch_assoc($result))
      {
        $customerId = $row['customerId'];
		$totalAmount = $row['totalAmount'];
		$employeeId = $row['employeeId'];
        $saleDate = $row['saleDate'];
		
		$sql1 = 'select * from customer where customerId=?';
		$stmt = mysqli_prepare($con, $sql1);
		mysqli_stmt_bind_param($stmt, 'i', $customerId);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if($row=mysqli_fetch_assoc($result)){
			$customerName = $row['customerName'];
		}
		
		$sql2='select * from employee where employeeId=?';
		$stmt = mysqli_prepare($con, $sql2);
		mysqli_stmt_bind_param($stmt, 'i', $employeeId);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if($row=mysqli_fetch_assoc($result)){
			$employeeName= $row['firstname'] . " ".$row['lastname'];
		}

      }
      mysqli_free_result($result); 
      mysqli_close($con);
    }
  }
?>
<html>
<head></head>
<body>
   <form action='update.php' method='post' >
    <h1>Order detail</h1>
<?php
    if(isset($_GET['error']))
      echo 'customerCode exists.';
?>    
   <table border='1'>
   <tr>
       <td>Customer Name</td>
       <td><input type='text' name='customerName' value='<?= $customerName; ?>' /></td>
   </tr>
   <tr>
       <td>Employee</td>
       <td><input type='text' name='customerName' value='<?= $employeeName; ?>' /></td>
   </tr>
   <tr>
       <td>Total</td>
       <td><input type='text' name='email' value='<?= $totalAmount; ?>' /></td>
   </tr>
   <tr>
       <td>Date</td>
       <td><input type='text' name='email' value='<?= $saleDate; ?>' /></td>
   </tr>
   
   <tr>
      <td colspan='2'>
         <input type='hidden' name='orderId' value='<?= $customerId; ?>'/>
         <input type='submit' value='Update' />
      </td>
   </tr>
   

  </table>
  </form>
</body>
</html>
<?php


}
?>

