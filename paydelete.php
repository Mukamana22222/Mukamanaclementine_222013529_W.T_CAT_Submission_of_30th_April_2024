<?php
// Connection
include('database_connection.php');
if(isset($_POST['paymentID'])){
    $paymentID = $_POST['paymentID'];
    $sql = "DELETE FROM payment WHERE paymentID='$paymentID'";
    $result = mysqli_query($conn, $sql);  
    if($result){
        //echo "Data deleted successfully";
        header('location:payment.php');
        exit;
    }
    else{
        die(mysqli_error($conn));
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmDelete();">
       <input type="hidden" name="paymentID" value="<?php echo htmlspecialchars($_GET['deletepaymentID']); ?>">
        <input type="submit" value="Delete">
    </form>
</body>
</html>
