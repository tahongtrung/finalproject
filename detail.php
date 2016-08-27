<?php
if (isset($_GET['orderId']))
{
  $customerCode = '';
  $customerName = '';
  $email = '';
  $email = '';
  
  if(isset($_GET['error']))
  {
    $customerId = isset($_GET['customerId']) ? $_GET['customerId'] : '';
    $customerCode = isset($_GET['customerCode']) ? $_GET['customerCode'] : '';
    $customerName = isset($_GET['customerCode']) ? $_GET['customerName'] : '';
    $email = isset($_GET['email']) ? $_GET['email'] : '';
    $gender = isset($_GET['gender']) ? $_GET['gender'] : '';

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
      $customerId =  $_GET['customerId'];
      $sql = 'select customerCode, customerName, gender, email from customer where customerId=?';
      $stmt = mysqli_prepare($con, $sql);
      mysqli_stmt_bind_param($stmt, 'i', $customerId);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($row=mysqli_fetch_assoc($result))
      {
        $customerCode = $row['customerCode'];
        $customerName = $row['customerName'];
        $email = $row['email'];
        $gender = $row['gender'];

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
    <h1>Customer detail</h1>
<?php
    if(isset($_GET['error']))
      echo 'customerCode exists.';
?>    
   <table border='1'>
   <tr>
       <td>Customer code</td>
       <td><input type='text' name='customerCode' value='<?= $customerCode; ?>' /></td>
   </tr>
   <tr>
       <td>Customer name</td>
       <td><input type='text' name='customerName' value='<?= $customerName; ?>' /></td>
   </tr>
   <tr>
       <td>Email</td>
       <td><input type='text' name='email' value='<?= $email; ?>' /></td>
   </tr>
   <tr>
       <td>Gender</td>
       <td>
       <input type='radio' name='gender' value='1' <?php if($gender == 1) echo 'checked'; ?> />Male
        <input type='radio' name='gender' value='0' <?php if($gender == 0) echo 'checked'; ?> />Female
       </td>
   </tr>
   <tr>
      <td colspan='2'>
         <input type='hidden' name='customerId' value='<?= $customerId; ?>'/>
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

