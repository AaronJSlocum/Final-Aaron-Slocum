<?php include 'top.php'; ?>
<main>
    <?php
    $submit = isset($_POST['submit']);
    $status = $_POST['status'];
    $sameSame = isset($_POST['sameSame']);
    $errors = false;
    $errorMgs =[];
    //Check for errors
    if($submit){
    if(empty($_POST['firstName'])){
      $errors = true;
      array_push($errorMgs,'First Name not set');
    }if(empty($_POST['lastName'])){
      $errors = true;
      array_push($errorMgs,'Last Name not set');
    }if(empty($_POST['email'])){
      $errors = true;
      array_push($errorMgs,'Email not set');
    }elseif(preg_match('@',$_POST['email'])){
      $errors = true;
      array_push($errorMgs,'Email not valid');
    }if($status == 'Sign Up'){
      if(empty($_POST['billAd'])){
      $errors = true;
      array_push($errorMgs,'Billing Address not set');
    }if(empty($_POST['billCity'])){
      $errors = true;
      array_push($errorMgs,'Billing City not set');
    }if(empty($_POST['billSt'])){
      $errors = true;
      array_push($errorMgs,'Billing State not set');
    }if(empty($_POST['billZip'])){
      $errors = true;
      array_push($errorMgs,'Billing Zipcode not set');
    }elseif((!ctype_digit($_POST['billZip']))){
      $errors = true;
      array_push($errorMgs,'Billing Zipcode invalid');
    }if(!$sameSame){
    if(empty($_POST['shipAd'])){
      $errors = true;
      array_push($errorMgs,'Shipping Address not set');
    }if(empty($_POST['shipCity'])){
      $errors = true;
      array_push($errorMgs,'Shipping City not set');
    }if(empty($_POST['shipSt'])){
      $errors = true;
      array_push($errorMgs,'Shipping State not set');
    }if(empty($_POST['shipZip'])){
      $errors = true;
      array_push($errorMgs,'Shipping Zipcode not set');
    }elseif((!ctype_digit($_POST['shipZip']))){
      $errors = true;
      array_push($errorMgs,'Shipping Zipcode invalid');
    }}}}
    if(!$errors){
      $noUser = empty($_SESSION);
    }else{
      $noUser = true;
    }
    if($noUser){
    if ($submit && $status == 'Login' && !$errors){
      print'<h2>Login</h2>';
      $query = "SELECT * FROM `tblCustomers` WHERE pmkCustomerEmail LIKE ? AND
      fldFirstName LIKE ? AND fldLastName LIKE ?";
      $name = [$_POST['email'],$_POST['firstName'],$_POST['lastName']];
      if ($thisDatabaseWriter->querySecurityOk($query,1,1)) {
        $query = $thisDatabaseWriter->sanitizeQuery($query);
        $user = $thisDatabaseWriter->select($query, $name);
        $user = $user[0];
      }
      if(($user['fldFirstName']==$_POST['firstName'])&&($user['fldLastName']==$_POST['lastName'])){
        print '<p>Login Sucessful</p>';
        $_SESSION['user']=$user;
      }else{
        print '<p>User not found</p>';
        print '<form action="login.php" method="get">';
        print '<input type="submit" name="signup" value="Sign Up"/>';
        print '</form>';
      }
      clearMeta();
    }elseif ($submit &&($status == 'Sign Up') && !$errors) {
      print'<h2>Sign up</h2>';
      $query = "INSERT INTO `tblCustomers` SET `pmkCustomerEmail` = ?, `fldFirstName` = ?,
      `fldLastName` = ?, `fldBillingAddress` = ?, `fldShippingAddress` = ?";
      $billingAdd = $_POST['billAd'] . ', ' . $_POST['billCity'] .', ' . $_POST['billSt'] . ', ' .
      $_POST['billZip'] . ', USA';
      if($sameSame){
        $shippingAdd = $billingAdd;
      }else{
        $shippingAdd = $_POST['shipAd'] . ', ' . $_POST['shipCity'] . ', ' .
        $_POST['shipSt'] . ', ' . $_POST['shipZip'] . ', USA';
      }
      $info = [$_POST['email'],$_POST['firstName'],$_POST['lastName'],$billingAdd,
      $shippingAdd];
      if ($thisDatabaseWriter->querySecurityOk($query,0)) {
        $query = $thisDatabaseWriter->sanitizeQuery($query);
        $sucess = $thisDatabaseWriter->insert($query, $info);
    }
    if($sucess){
      print '<p>Sign Up Sucessful</p>';
      $query = "SELECT * FROM `tblCustomers` WHERE pmkCustomerEmail LIKE ? AND
      fldFirstName LIKE ? AND fldLastName LIKE ?";
      $name = [$_POST['email'],$_POST['firstName'],$_POST['lastName']];
      if ($thisDatabaseWriter->querySecurityOk($query,1,1)) {
        $query = $thisDatabaseWriter->sanitizeQuery($query);
        $user = $thisDatabaseWriter->select($query, $name);
        $user = $user[0];
      }
      $_SESSION['user']=$user;
    }else{
      print '<p>Sign Up Failed</p>';
    }
    clearMeta();
  }else{
         print '<form action="login.php" method="get">';
         if($_GET['signup']=='Sign Up'){
             print '<input type="submit" name="signup" value="Login"/>';
         }else{
             print '<input type="submit" name="signup" value="Sign Up"/>';}
         print '</form>';
         if($_GET['signup']=='Sign Up'){
             print '<h2>Sign Up</h2>';
         }else{
             print '<h2>Login</h2>';
         }if($errors){
           print '<p id="errors">Following errors found: ';
           foreach($errorMgs as &$errorMg){
            if ($errorMg == end($errorMgs)){
              print $errorMg.".";
            }else{
              print $errorMg.", ";
            }}
           print '</p>';
         }
         print '<form action="' . $_SERVER['PHP_SELF'] .'"method="post">';
         print '<label for="firstName">First Name:</label>
         <input type="text" id="firstName" name="firstName" value="'.$_POST['firstName'].'"><br><br>';
         print '<label for="lastName">Last Name:</label>
         <input type="text" id="lastName" name="lastName" value="'.$_POST['lastName'].'"><br><br>';
         print '<label for="email">Email:</label>
         <input type="text" id="email" name="email" value="'.$_POST['email'].'"><br><br>';
         if ($_GET['signup']=='Sign Up'||$status=='Sign Up'){
           print '<h4>Billing Info</h4>';
           print '<label for="billAd">Address:</label>
           <input type="text" id="billAd" name="billAd" value="'.$_POST['billAd'].'"><br><br>';
           print '<label for="billCity">City:</label>
           <input type="text" id="billCity" name="billCity" value="'.$_POST['billCity'].'"><br><br>';
           print '<label for="billSt">State:</label>
           <input type="text" id="billSt" name="billSt" value="'.$_POST['billSt'].'"><br><br>';
           print '<label for="billZip">Zip:</label>
           <input type="text" id="billZip" name="billZip" value="'.$_POST['billZip'].'"><br><br>';
           print '<input type="checkbox" id="sameSame" name="sameSame">
           <label for="sameSame">Is your shipping sddress same as billing?</label>';
           print '<h4>Shipping Info</h4>';
           print '<label for="shipAd">Address:</label>
           <input type="text" id="shipAd" name="shipAd" value="'.$_POST['shipAd'].'"><br><br>';
           print '<label for="shipCity">City:</label>
           <input type="text" id="shipCity" name="shipCity" value="'.$_POST['shipCity'].'"><br><br>';
           print '<label for="shipSt">State:</label>
           <input type="text" id="shipSt" name="shipSt" value="'.$_POST['shipSt'].'"><br><br>';
           print '<label for="shipZip">Zip:</label>
           <input type="text" id="shipZip" name="shipZip" value="'.$_POST['shipZip'].'"><br><br>';
             }
         if (($_GET['signup']=='Login')||!isset($_GET['signup'])){
           print '<input type="hidden" id="status" name="status" value="Login"/>';
         }elseif($_GET['signup']=='Sign Up'){
           print '<input type="hidden" id="status" name="status" value="Sign Up"/>';
         }
         print '<input type="submit" name="submit" value="Submit"/>';
         print '</form>';
  }}elseif((!$noUser)&& $status!='Logout' && $status!='Remove Account' && $status!='Im Sure'){
    print'<p>You are already logged in</p>';
    print '<form action="login.php" method="post">';
    print '<input type="submit" name="status" value="Logout"/>';
    print '<input type="submit" name="status" value="Remove Account"/>';
    print '</form>';
  }elseif((!$noUser)&&($status=='Logout')){
    session_unset();
    clearMeta();
    header("Location: index.php");
  }elseif((!$noUser)&&($status=='Remove Account')){
    print'<p>Are you sure?</p>';
    print '<form action="login.php" method="post">';
    print '<input type="submit" name="status" value="Im Sure"/>';
    print '</form>';
  }elseif((!$noUser)&&($status=='Im Sure')){
    $query = "DELETE FROM `tblCustomers` WHERE `tblCustomers`.`pmkCustomerEmail` = ?";
    $user = array($_SESSION['user']['pmkCustomerEmail']);
    if ($thisDatabaseWriter->querySecurityOk($query)) {
      $query = $thisDatabaseWriter->sanitizeQuery($query);
      $sucess = $thisDatabaseWriter->delete($query, $user);
    }
    if($sucess){
      session_unset();
      clearMeta();
      print '<p>Your account has been removed</p>';}
    elseif (!$sucess) {
        print '<p>Your account has not been removed</p>';}
  }
    ?>

</main>
<?php include 'footer.php'; ?>
