<?php
// Connection
include('database_connection.php');
if(isset($_POST['SupplierID'])){
    $SupplierID = $_POST['SupplierID'];
    $sql = "DELETE FROM supplier WHERE SupplierID='$SupplierID'";
    $result = mysqli_query($conn, $sql);  
    if($result){
       // echo "Data deleted successfully";
        header('location:supplier.php');
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
       <input type="hidden" name="SupplierID" value="<?php echo htmlspecialchars($_GET['deleteSupplierID']); ?>">
        <input type="submit" value="Delete">
    </form>
</body>
</html>
