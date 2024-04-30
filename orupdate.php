<!DOCTYPE html>
<html>
<head>
    <title>Update order</title>
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
<h5>  UPDATE ORDER INFORMATION</h5>
<form action="orupdate.php" method="POST" onsubmit="return confirmUpdate();"  style="background-color: WHITE; align-items: center; width: 300px; height: 260px;"> <br><br><br>
	    <label>Enter OrderID:</label><br>
        <input type="number" name="OrderID" required><br>
        <label>Enter orderName:</label><br>
        <input type="text" name="orderName" required><br>
        <label>Enter OrderDate:</label><br>
        <input type="date" name="OrderDate" required><br>
        <label>Enter PaymentMethod:</label><br>
        <input type="text" name="PaymentMethod" required><br>


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
    $OrderID= $_POST['OrderID'];
    $orderName = $_POST['orderName'];
    $OrderDate = $_POST['OrderDate'];
    $PaymentMethod = $_POST['PaymentMethod'];
    // Prepare and bind the parameters
    $stmt = $conn->prepare("UPDATE order_ SET orderName=?,OrderDate=?, PaymentMethod=? WHERE OrderID=?");
    $stmt->bind_param("ssss", $orderName, $OrderDate, $PaymentMethod,$OrderID); 
    // Execute query
    if ($stmt->execute()) {
        //echo "Update successful";
        header('location:order.php');
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
