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
   $sql = 'select * from customer';
   $result=mysqli_query($con,$sql); 

?>
<html>
<head></head>
<body>
  <form action='delete.php'  method='POST' >
    <h1>Customer list</h1>
   <table border='1'>
    <tr>
      <td colspan='4' >
         <input type='submit' value='Delete' /> <a href='new.php'>New customer</a>
      </td>
    </tr>
   <tr>
       <td>&nbsp;</td>
       <td>Customer name</td>
       <td>Email</td>
       <td>Gender</td>
   </tr>
<?php
   while($row=mysqli_fetch_assoc($result)) {
?>
    <tr>
        <td><input type='checkbox' name='ids[]' value='<?=$row["customerId"]; ?>' /></td>
        <td><a href='detail.php?customerId=<?=$row["customerId"]; ?>'><?=$row["customerName"]; ?></a></td>
        <td><?=$row["email"]; ?>
        </td>
        <td><?php if ($row["gender"]==1) echo 'Male'; else echo 'Female'; ?></td>        
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

