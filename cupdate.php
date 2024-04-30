
<!DOCTYPE html>
<html>
<head>
    <title>Update products</title>
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
        <h5>UPDATE CATEGORY INFORMATION</h5>
        <form method="POST" onsubmit="return confirmUpdate();" style="background-color: WHITE; align-items: center; width: 300px; height: 250px;">
            <br><br><br>
            <label>Enter Category ID:</label><br>
            <input type="number" name="id" required><br>
            <label>Enter Category Name:</label><br>
            <input type="text" name="category" required><br>

            <input type="submit" name="submit" value="UPDATE">
            <input type="reset" value="Cancel">
        </form>
    </center>
</body>
</html>

<?php
include('database_connection.php');

// Update data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoryID = $_POST['id'];
    $categoryName = $_POST['category'];
    
    // Prepare and bind the parameters
    $stmt = $conn->prepare("UPDATE category SET CategoryName=? WHERE CategoryID=?");
    $stmt->bind_param("si", $categoryName, $categoryID);

    // Execute query
    if ($stmt->execute()) {
        //echo "Update successful";
        header('location:category.php');
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

