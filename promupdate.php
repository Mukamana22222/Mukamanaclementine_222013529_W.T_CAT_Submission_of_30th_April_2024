<!DOCTYPE html>
<html>
<head>
    <title>Update promotion</title>
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
<h5>  UPDATE PROMOTION INFORMATION</h5>
<form action="promupdate.php" method="POST" onsubmit="return confirmUpdate();" style="background-color: WHITE; align-items: center; width: 300px; height: 260px;"> <br><br><br>
	    <label>Enter PromotionID:</label><br>
        <input type="number" name="PromotionID" required><br>
        <label>Enter DiscountAmount:</label><br>
        <input type="number" name="DiscountAmount" required><br>
        <label>Enter ExpirationDate:</label><br>
        <input type="date" name="ExpirationDate" required><br>
      
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
    $PromotionID= $_POST['PromotionID'];
    $DiscountAmount = $_POST['DiscountAmount'];
    $ExpirationDate = $_POST['ExpirationDate'];
    
    // Prepare and bind the parameters
    $stmt = $conn->prepare("UPDATE promotion SET DiscountAmount=?,ExpirationDate=? WHERE PromotionID=?");
    $stmt->bind_param("sss", $DiscountAmount, $ExpirationDate,$PromotionID);

    // Execute query
    if ($stmt->execute()) {
        //echo "Update successful";
        header('location:promotion.php');
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>