<html>
<head></head>
<body>
   <form action='update.php' method='post' >
    <h1>New customer</h1>
   <table border='1'>
   <tr>
       <td>Customer code</td>
       <td><input type='text' name='customerCode' /></td>
   </tr>
   <tr>
       <td>Customer name</td>
       <td><input type='text' name='customerName'  /></td>
   </tr>
   <tr>
       <td>Email</td>
       <td><input type='text' name='email'/></td>
   </tr>
   <tr>
       <td>Gender</td>
       <td>
       <input type='radio' name='gender' value='1'  />Male
        <input type='radio' name='gender' value='0' />Female
       </td>
   </tr>
   <tr>
      <td colspan='2'>

         <input type='submit' value='New' />
      </td>
   </tr>
   
  </table>
  </form>
</body>
</html>
