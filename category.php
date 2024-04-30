<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>insert category</title>

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
<h5> CATEGORY INFORMATION</h5>

<form  method="POST" onsubmit="return confirmInsert();"  style="background-color: WHITE; align-items: center; width: 300px; height: 250px;"> <br><br><br>
        <label>Enter categoryID:</label><br>
        <input type="number" name="id" required><br>
        <label>Enter categoryName:</label><br>
        <input type="text" name="category" required><br>

<input type="submit" name="submit" Value="INSERT" > 
<input type="reset" name="" Value="cancel" > 
</form>
</footer>
</body>
</html>
</body>
</html>



<?php

    include('database_connection.php');

// Insert data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $conn->prepare("INSERT INTO category (categoryID, categoryName) VALUES (?, ?)");
    $stmt->bind_param("ss", $id, $category);
    
    // Set parameters and execute
    $id = $_POST['id'];
    $category = $_POST['category'];
    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Select data from the table
$sql = "SELECT * FROM category";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of category</title>
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
    <h2>TABLE OF CATEGORY DATA</h2>
    
    <table id="dataTable">
        <tr>
            <th>CATEGORYID</th>
            <th>CATEGORYNAME</th>
            <th>UPDATE</th>
            <th>DELETE</th>
        </tr>
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["CategoryID"] .
                     "</td><td>" . $row["CategoryName"] .
                     "</td><td><a href='cupdate.php?updateCategoryID=". $row['CategoryID']."'>UPDATE</a></td><td><a href='cdelete.php?deleteCategoryID=". $row['CategoryID']."'>DELETE</tr>";       
            }
        } else {
            echo "<tr><td colspan='2'>No data found</td></tr>";
        }
        ?>

    </table>
</body>
</html>

<?php
// Close connection
$conn->close();
?>




