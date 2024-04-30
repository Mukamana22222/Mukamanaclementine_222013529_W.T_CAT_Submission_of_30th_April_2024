<!DOCTYPE html>
<html>
<head>
    <title>Update product</title>
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
<h5> UPDATE PRODUCT INFORMATION</h5>
<form action="proupdate.php" method="POST" onsubmit="return confirmUpdate();" style="background-color: WHITE; align-items: center; width: 300px; height: 370px;"> <br><br><br>
	<label>Enter ProductID:</label><br>
        <input type="number" name="ProductID" required><br>
        <label>Enter Name:</label><br>
        <input type="text" name="Name" required><br>
        <label>Enter Description:</label><br>
        <input type="text" name="Description" required><br>
        <label>Enter Price:</label><br>
        <input type="number" name="Price" required><br>
        <label>Enter Quantity:</label><br>
        <input type="number" name="Quantity" required><br>
        <label>Enter CategoryID:</label><br>
        <input type="number" name="CategoryID" required><br>
        <label>Enter SupplierID:</label><br>
        <input type="number" name="SupplierID" required><br>
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ProductID= $_POST['ProductID'];
    $Name = $_POST['Name'];
    $Description = $_POST['Description'];
    $Price = $_POST['Price'];
    $Quantity = $_POST['Quantity'];
    $CategoryID = $_POST['CategoryID'];
    $SupplierID = $_POST['SupplierID'];
    
    // Prepare and bind the parameters
    $stmt = $conn->prepare("UPDATE product SET Name=?,Description=?,Price=?,Quantity=?,CategoryID=?,SupplierID=? WHERE ProductID=?");
    $stmt->bind_param("sssssss", $Name, $Description, $Price, $Quantity, $CategoryID,$SupplierID,$ProductID); 

    // Execute query
    if ($stmt->execute()) {
        //echo "Update successful";
        header('location:product.php');
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
