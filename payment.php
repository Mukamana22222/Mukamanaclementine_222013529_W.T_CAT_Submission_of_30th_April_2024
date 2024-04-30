
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>insert payment </title>
  
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
<h5> PAYMENT INFORMATION</h5>
<form action="payment.php" method="POST"  onsubmit="return confirmInsert();" style="background-color: WHITE; align-items: center; width: 300px; height: 290px;"> <br><br><br>
        <label>Enter paymentID:</label><br>
        <input type="number" name="paymentID" required><br>
        <label>Enter PaymentDate:</label><br>
        <input type="date" name="PaymentDate" required><br>
        <label>Enter Amount:</label><br>
        <input type="number" name="Amount" required><br>
        <label>Enter PaymentMethod:</label><br>
        <input type="text" name="PaymentMethod" required><br>
         <label>Enter OrderID:</label><br>
        <input type="number" name="OrderID" required><br>
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $conn->prepare("INSERT INTO payment(paymentID,PaymentDate,Amount,PaymentMethod,OrderID) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss",$paymentID, $PaymentDate, $Amount, $PaymentMethod, $OrderID);

    // Set parameters and execute
    $paymentID= $_POST['paymentID'];
    $PaymentDate = $_POST['PaymentDate'];
    $Amount = $_POST['Amount'];
    $PaymentMethod = $_POST['PaymentMethod'];
    $OrderID = $_POST['OrderID'];
    
    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Select data from the table
$sql = "SELECT * FROM payment";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of payment</title>
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
    <center><h2>TABLE OF PAYMENT DATA</h2></center>
    
    <table id="dataTable">
        <tr>
            <th>paymentID</th>
            <th>PaymentDate</th>
            <th>Amount</th>
            <th>PaymentMethod</th>
            <th>OrderID</th>
            <th>UPDATE</th>
            <th>DELETE</th>
        </tr>
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["paymentID"] .
                     "</td><td>" . $row["PaymentDate"] .
                     "</td><td>" . $row["Amount"] .
                     "</td><td>" . $row["PaymentMethod"] .
                     "</td><td>" . $row["OrderID"] .
                     "</td><td><a href='payupdate.php?updatepaymentID=". $row['paymentID']."'>UPDATE</a></td><td><a href='paydelete.php?deletepaymentID=".$row['paymentID']."'>DELETE</a></td></tr>";       
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
