<!DOCTYPE html>
<html>
<head>
    <title>Update supplier</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   </head>
<body bgcolor="pink"> 
    <center>
<h5>UPDATE SUPPLIER INFORMATION</h5>
<form action="supupdate.php" method="POST" onsubmit="return confirmUpdate();" style="background-color: WHITE; align-items: center; width: 300px; height: 350px;"> <br><br><br>
          <label>Enter SupplierID:</label><br>
        <input type="number" name="SupplierID" required><br>
        <label>Enter SupplierName:</label><br>
        <input type="text" name="SupplierName" required><br>
        <label>Enter Phone:</label><br>
        <input type="number" name="phone" required><br>
        <label>Enter Email:</label><br>
        <input type="email" name="email" required><br>
        <label>Enter Address:</label><br>
        <input type="text" name="address" required><br>
        <label>Gender:</label>
        <input type="radio" name="gender" value="male" checked>Male
        <input type="radio" name="gender" value="female">Female<br><br>
<input type="submit" name="submit" Value="UPDATE" > 
<input type="reset" name="" Value="cancel" > 
</form>
</center>

</body>
</html>

<?php
// Connection
include('database_connection.php');

// Update data if form is submitted
if ($_SERVER["REQUEST_METHOD"] =="POST") {
    $SupplierID = $_POST['SupplierID'];
    $SupplierName = $_POST['SupplierName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    
    // Prepare and bind the parameters
    $stmt = $conn->prepare("UPDATE supplier SET SupplierName=?,Phone=?,Email=?,Address=?,gender=? WHERE SupplierID =?");
    $stmt->bind_param("sssssi", $SupplierName, $phone, $email,$address,$gender,$SupplierID );

    // Execute query
    if ($stmt->execute()) {
        //echo "Update successful";
        header('location:supplier.php');
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
