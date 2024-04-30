<?php
// Connection
include('database_connection.php');
if(isset($_POST['ProductID'])){
    $ProductID = $_POST['ProductID'];
    $sql = "DELETE FROM product WHERE ProductID='$ProductID'";
    $result = mysqli_query($conn, $sql);  
    if($result){
        //echo "Data deleted successfully";
        header('location:product.php');
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
       <input type="hidden" name="ProductID" value="<?php echo htmlspecialchars($_GET['deleteProductID']); ?>">
        <input type="submit" value="Delete">
    </form>
</body>
</html>
