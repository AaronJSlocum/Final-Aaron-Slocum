<?php
include 'top.php';
?>

<main>
    <?php
    if (isset($_POST['submit'])&&(!isset($_GET['signup'])){
      print'<h2>Login</h2>';
      $query = "SELECT * FROM `tblCustomers` WHERE fldFirstName LIKE ? AND fldLastName LIKE ?";
      $name = [$_POST['firstName'],$_POST['lastName']]
      if ($thisDatabaseWriter->querySecurityOk($query)) {
        $query = $thisDatabaseWriter->sanitizeQuery($query);
        $sucess = $thisDatabaseWriter->select($query, $name);
      }
      if($name['fldFirstName']==){
        print '<p>Login Sucessful</p>'
      }
    }elseif (isset($_POST['submit'])&&isset($_GET['signup'])) {
      print'<h2>Sign up</h2>';
      $query = "INSERT INTO `tblCustomers` SET `pmk_costomer_email` = ?, `fldFirstName` = ?,
      `fldLastName` = ?, `fldBillingAddress` = ?, `fldShippingAddress` = ?";
      $billingAdd = $_POST['billAd'] . ',' . $_POST['billCity'] .', ' . $_POST['billSt'] . ', ' .
      $_POST['billZip'] . ', USA';
      if(isset($_POST['sameSame']){
        $shippingAdd = $billingAdd;
      }else{
        $shippingAdd = $_POST['shipAd'] . ',' . $_POST['shipCity'] . ', ' . $_POST['shipSt'] . ', ' .
        $_POST['shipZip'] . ', USA';
      }
      $info = [$_POST['email'],$_POST['firstName'],$_POST['lastName'],$billingAdd,
      $shippingAdd];
      if ($thisDatabaseWriter->querySecurityOk($query,1,1)) {
        $query = $thisDatabaseWriter->sanitizeQuery($query);
        $sucess = $thisDatabaseWriter->insert($query, $info);
    }
    if($sucess){
      print '<p>Sign Up Sucessful</p>';
    }
  }else{
    print '<form action="login.php" method="post">';
    print '<label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName"><br><br>';
    print '<label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName"><br><br>';
    if (isset($_GET['signup'])){
      print '<label for="email">Email:</label>
      <input type="text" id="email" name="email"><br><br>';
      print '<h4>Billing Info</h4>'
      print '<label for="billAd">Address:</label>
      <input type="text" id="billAd" name="billAd"><br><br>';
      print '<label for="billCity">City:</label>
      <input type="text" id="billCity" name="billCity"><br><br>';
      print '<label for="billSt">State:</label>
      <input type="text" id="billSt" name="billSt"><br><br>';
      print '<label for="billZip">Zip:</label>
      <input type="text" id="billZip" name="billZip"><br><br>';
      print '<input type="checkbox" id="sameSame" name="sameSame">
      <label for="sameSame">Is your shipping sddress same as billing?</label>';
      print '<h4>Shipping Info</h4>'
      print '<label for="shipAd">Address:</label>
      <input type="text" id="shipAd" name="shipAd"><br><br>';
      print '<label for="shipCity">City:</label>
      <input type="text" id="shipCity" name="shipCity"><br><br>';
      print '<label for="shipSt">State:</label>
      <input type="text" id="shipSt" name="shipSt"><br><br>';
      print '<label for="shipZip">Zip:</label>
      <input type="text" id="shipZip" name="shipZip"><br><br>';
    }
    print '<input type="submit" name="submit" value="Submit"/>';
    if(isset($_GET['singup'])){
      print '<input type="submit" name="login" value="Login"/>';
    }else{
      print '<input type="submit" name="signup" value="Signup"/>';
    }
  }

  }
    ?>

</main>
<?php include 'footer.php'; ?>
