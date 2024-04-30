<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>insert supplier</title>

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
<h5> SUPPLIER INFORMATION</h5>
<form action="supplier.php" method="POST" onsubmit="return confirmInsert();" style="background-color: WHITE; align-items: center; width: 300px; height: 350px;"> <br><br><br>
    <label>Enter SupplierID:</label><br>
        <input type="number" name="SupplierID" required><br>
        <label>Enter SupplierName:</label><br>
        <input type="text" name="SupplierName" required><br>
        <label>Enter Phone:</label><br>
        <input type="number" name="Phone" required><br>
        <label>Enter Email:</label><br>
        <input type="email" name="Email" required><br>
        <label>Enter Address:</label><br>
        <input type="text" name="Address" required><br>
        <label>Gender:</label>
        <input type="radio" name="gender" value="male" checked>Male
        <input type="radio" name="gender" value="female">Female<br><br>



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
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    // Prepare and bind the parameters
    $stmt = $conn->prepare("INSERT INTO supplier (SupplierID,SupplierName,Phone,Email,Address,gender) VALUES (?,?,?,?,?,?)");
   $stmt->bind_param("ssssss",$SupplierID,$SupplierName,$phone,$email,$address,$gender );
    
    // Set parameters and execute
    $SupplierID = $_POST['SupplierID'];
    $SupplierName = $_POST['SupplierName'];
    $phone = $_POST['Phone'];
    $email = $_POST['Email'];
    $address = $_POST['Address'];
    $gender = $_POST['gender'];
    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Select data from the table
$sql = "SELECT * FROM supplier";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of supplier</title>
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
   <center><h2>TABLE OF SUPPLIER DATA</h2></center>
    
    <table id="dataTable">
        <tr>
            <th>SupplierID</th>
            <th>SupplierName</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>gender</th>
            <th>UPDATE</th>
            <th>DELETE</th>
        </tr>
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["SupplierID"] .
                     "</td><td>" . $row["SupplierName"] .
                     "</td><td>" . $row["Phone"] .
                     "</td><td>" . $row["Email"] .
                     "</td><td>" . $row["Address"] .
                     "</td><td>" . $row["gender"] .
                     "</td><td><a href='supupdate.php?updateSupplierID=". $row['SupplierID']."'>UPDATE</a></td><td><a href='supdelete.php?deleteSupplierID=".$row['SupplierID']."'>DELETE</a></td></tr>";       
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