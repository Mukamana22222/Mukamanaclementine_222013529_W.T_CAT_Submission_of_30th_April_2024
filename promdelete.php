<?php
// Connection
include('database_connection.php');
if(isset($_POST['PromotionID'])){
    $PromotionID = $_POST['PromotionID'];
    $sql = "DELETE FROM promotion WHERE PromotionID='$PromotionID'";
    $result = mysqli_query($conn, $sql);  
    if($result){
        //echo "Data deleted successfully";
        header('location:promotion.php');
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
       <input type="hidden" name="PromotionID" value="<?php echo htmlspecialchars($_GET['deletePromotionID']); ?>">
        <input type="submit" value="Delete">
    </form>
</body>
</html>
