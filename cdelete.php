<?php
include('database_connection.php');
if(isset($_POST['categoryID'])){
    $categoryID = $_POST['categoryID'];
    $sql = "DELETE FROM category WHERE CategoryID='$categoryID'";
    $result = mysqli_query($conn, $sql);
    if($result){
        header('location: category.php');
        exit; // terminate script execution after redirect
    }
    else{
        die("Error deleting record: " . mysqli_error($conn));
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
       <input type="hidden" name="categoryID" value="<?php echo htmlspecialchars($_GET['deleteCategoryID']); ?>">
        <input type="submit" value="Delete">
    </form>
</body>
</html>
