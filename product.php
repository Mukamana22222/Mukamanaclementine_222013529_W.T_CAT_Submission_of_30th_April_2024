
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> insert product</title>

  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>


</head>
<header>
<body bgcolor="pink">

<!-- <div class="col-3 offset">-->
  
  <form class="d-flex" role="search" action="search.php" >
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query"  >
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>

<nav>
  <ul style="list-style-type: none; padding: 0;">
    <img src="images/lo.JPEG" width="80" height="80">
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">Home</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about us.html"  >About us</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Contact.html"  >Contact us</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./category.php" >Category</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./customer.php" >Customer</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./order.php">Order</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./payment.php" >Payment</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./product.php" >Product</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./promotion.php" >Promotion</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./supplier.php">Supplier</a></li>
    
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: black; background-color:gray; text-decoration: none; margin-right: 15px;">Setting</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
  </ul>
  </nav>
  </header>
<center>
<h5> PRODUCT INFORMATION</h5>
<form action="product.php" method="POST" onsubmit="return confirmInsert();" style="background-color: WHITE; align-items: center; width: 300px; height: 370px;"> <br><br><br>
    <label>Enter ProductID:</label><br>
        <input type="number" name="ProductID" required><br>
        <label>Enter Name:</label><br>
        <input type="text" name="Name" required><br>
        <label>Enter Description:</label><br>
        <input type="text" name="Description" required><br>
        <label>Enter Price:</label><br>
        <input type="number" name="Price" required><br>
        <label>Enter Quantity:</label><br>
        <input type="number" name="Quantity" required><br>
        <label>Enter CategoryID:</label><br>
        <input type="number" name="CategoryID" required><br>
        <label>Enter SupplierID:</label><br>
        <input type="number" name="SupplierID" required><br>
<input type="submit" name="submit" Value="INSERT" > 
<input type="reset" name="" Value="cancel" > 
</form>
</center>
</body>
</html>
</body>
</html>



<?php
// Connection
include('database_connection.php');
// Insert data if form is submitted
if ($_SERVER["REQUEST_METHOD"] =="POST") {
    // Prepare and bind the parameters
    $stmt = $conn->prepare("INSERT INTO product (ProductID,Name,Description,Price,Quantity,CategoryID,SupplierID) VALUES (?, ?, ?, ?, ?, ?,?)");
    $stmt->bind_param("sssssss",$ProductID, $Name, $Description, $Price, $Quantity, $CategoryID,$SupplierID);

    // Set parameters and execute
    $ProductID= $_POST['ProductID'];
    $Name = $_POST['Name'];
    $Description = $_POST['Description'];
    $Price = $_POST['Price'];
    $Quantity = $_POST['Quantity'];
    $CategoryID = $_POST['CategoryID'];
    $SupplierID = $_POST['SupplierID'];
    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Select data from the table
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of product</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>TABLE OF PRODUCT DATA</h2></center>
    
    <table id="dataTable">
        <tr>
            <th>ProductID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>CategoryID</th>
            <th>SupplierID</th>
            <th>UPDATE</th>
            <th>DELETE</th>
        </tr>
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["ProductID"] .
                     "</td><td>" . $row["Name"] .
                     "</td><td>" . $row["Description"] .
                     "</td><td>" . $row["Price"] .
                     "</td><td>" . $row["Quantity"] .
                     "</td><td>" . $row["CategoryID"] .
                     "</td><td>" . $row["SupplierID"] .
                     "</td><td><a href='proupdate.php?updateProductID=". $row['ProductID']."'>UPDATE</a></td><td><a href='prodelete.php?deleteProductID=".$row['ProductID']."'>DELETE</a></td></tr>";       
            }
        } else {
            echo "<tr><td colspan='8'>No data found</td></tr>";
        }
        ?>

    </table>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
