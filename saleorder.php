<?php
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
   $cust_sql = 'select customerId, customerName from customer';
   $cust_result=mysqli_query($con,$cust_sql); 
   
   $customerId = isset($_POST['customerId']) ? $_POST['customerId'] : 0;
   $totalAmount = isset($_POST['totalAmount']) ? $_POST['totalAmount'] : '';
   
   $sql = 'select orderId, customerName, totalAmount, saleDate from saleorder inner join customer on saleorder.customerId = customer.customerId where 1';
   if ($customerId != 0)
      $sql = $sql . ' AND saleorder.customerId=' . $customerId;
   if ($totalAmount != '')
      $sql = $sql . ' AND totalAmount >' . $totalAmount;   
  
   $result=mysqli_query($con,$sql); 

?>
<html>
<head></head>
<body>
  <h1>Sale order list</h1>
  <form action='saleorder.php' method = 'POST'>
  <table>
   <tr>
      <td>
      Customer:
      <select name='customerId'>
      <option value='0'>All</option>
<?php
	while($row=mysqli_fetch_assoc($cust_result)) {
?> 
       <option value="<?=$row['customerId']; ?>" <?php if($row['customerId'] == $customerId) echo 'selected';?> ><?=$row['customerName']; ?></option>
<?php
	}
?>     
      </select>
      Total Amount > :<input type='text' name='totalAmount'  value="<?=$totalAmount; ?>" />
      <input type='submit' value='Search' />
      </td>
   </tr>
  </table>
  </form>
  <form action='delete_order.php'  method='POST' >
   <table border='1'>
    <tr>
      <td colspan='4' >
         <input type='submit' value='Delete' /> <a href='new_order.php'>New order</a>
      </td>
    </tr>
   <tr>
       <td>&nbsp;</td>
       <td>Customer name</td>
       <td>Total Amount</td>
       <td>Sale Date</td>
   </tr>
<?php
   while($row=mysqli_fetch_assoc($result)) {
?>
    <tr>
        <td><input type='checkbox' name='ids[]' value='<?=$row["orderId"]; ?>' /></td>
        <td><a href='detail_order.php?orderId=<?=$row["orderId"]; ?>'><?=$row["customerName"]; ?></a></td>
        <td><?=$row["totalAmount"]; ?>
        </td>
        <td><?=$row["saleDate"]; ?>
        </td>
    </tr>
<?php
   }
?>    
  </table>
</form>
</body>
</html>

<?php
   mysqli_free_result($result); 
   mysqli_close($con);
}
?>

