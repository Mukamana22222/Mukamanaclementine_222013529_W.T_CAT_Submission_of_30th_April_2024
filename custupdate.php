
<!DOCTYPE html>
<html>
<head>
    <title>Update customer</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   </head>
<body style="background-color: pink;">
    <center>
        <h5>UPDATE CUSTOMER INFORMATION</h5>
        <form action="custupdate.php" method="POST"  onsubmit="return confirmUpdate();" style="background-color: white; width: 300px; height: 350px;">
            <br><br><br>
            <label>Enter customerID:</label><br>
            <input type="number" name="customerID" required><br>
            <label>Enter customerName:</label><br>
            <input type="text" name="customerName" required><br>
            <label>Enter Phone:</label><br>
            <input type="number" name="phone" required><br>
            <label>Enter Email:</label><br>
            <input type="email" name="email" required><br>
            <label>Enter Address:</label><br>
            <input type="text" name="address" required><br>
            <label>Gender:</label>
            <input type="radio" name="gender" value="male" checked>Male
            <input type="radio" name="gender" value="female">Female<br><br>
            <input type="submit" name="submit" value="UPDATE">
            <input type="reset" name="" value="Cancel">
        </form>
    </center>
</body>
</html>

<?php
// Connection
include('database_connection.php');

// Update data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerID = $_POST['customerID'];
    $customerName = $_POST['customerName'];
    $phone = $_POST['phone'];
    $email = $_POST['email']; // Fixed variable name
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    
    // Prepare and bind the parameters
    $stmt = $conn->prepare("UPDATE customer SET customerName=?, Phone=?, Email=?, Address=?, gender=? WHERE customerID=?");
    $stmt->bind_param("sssssi", $customerName, $phone, $email, $address, $gender, $customerID); // Changed 'si' to 'sssssi'

    // Execute query
    if ($stmt->execute()) {
        //echo "Update successful";
        header('location:customer.php');
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
