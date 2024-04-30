<!DOCTYPE html>
<html>
<head>
    <title>Update payment</title>
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
<h5>  UPDATE PAYMENT INFORMATION</h5>
<form action="payupdate.php" method="POST" onsubmit="return confirmUpdate();"  style="background-color: WHITE; align-items: center; width: 300px; height: 290px;"> <br><br><br>
	    <label>Enter paymentID:</label><br>
        <input type="number" name="paymentID" required><br>
        <label>Enter PaymentDate:</label><br>
        <input type="date" name="PaymentDate" required><br>
        <label>Enter Amount:</label><br>
        <input type="number" name="Amount" required><br>
        <label>Enter PaymentMethod:</label><br>
        <input type="text" name="PaymentMethod" required><br>
         <label>Enter OrderID:</label><br>
        <input type="number" name="OrderID" required><br>
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
    $paymentID= $_POST['paymentID'];
    $PaymentDate = $_POST['PaymentDate'];
    $Amount = $_POST['Amount'];
    $PaymentMethod = $_POST['PaymentMethod'];
    $OrderID = $_POST['OrderID'];
    
    // Prepare and bind the parameters
    $stmt = $conn->prepare("UPDATE payment SET PaymentDate=?,Amount=?,PaymentMethod=?,OrderID=? WHERE paymentID=?");
    $stmt->bind_param("sssss", $PaymentDate, $Amount, $PaymentMethod , $OrderID, $paymentID); 

    // Execute query
    if ($stmt->execute()) {
        //echo "Update successful";
        header('location:payment.php');
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
