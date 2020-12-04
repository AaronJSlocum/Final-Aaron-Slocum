<?php include 'top.php'; ?>
<main>
  <?php
  $submit = isset($_POST['submit']);
  $repeat = false;
  $noUser = empty($_SESSION);
  $status = $_POST['status'];
  $currUser = $_SESSION['user']['pmkCustomerEmail'];
  $query = "SELECT `pfkCustomerEmail` FROM `tblReview`";
  if ($thisDatabaseReader->querySecurityOk($query, 0)){
      $query = $thisDatabaseReader->sanitizeQuery($query);
      $submittedUsers = $thisDatabaseReader->select($query, '');}
  foreach ($submittedUsers as &$user) {
    if (in_array($currUser,$user,true)) {
      $repeat = true;
    }
  }
  if($status == "Login/Sign Up"){
    clearMeta();
    header("Location: login.php");
  }
  if(!$noUser){
    if($submit){
      if($repeat){
        $query = "UPDATE `tblReview` SET `fldStars` = ?, `fldReview` = ?
        WHERE `tblReview`.`pfkCustomerEmail` = ?";
        $info = [intval($_POST['stars']),$_POST['review'],$_SESSION['user']['pmkCustomerEmail']];
        if ($thisDatabaseWriter->querySecurityOk($query, 1)){
            $query = $thisDatabaseWriter->sanitizeQuery($query);
            $sucess = $thisDatabaseWriter->update($query, $info);}
        if($sucess){
          print'<p>Your review has been updated</p>';
        }else{
          print'<p>Your review has not been posted</p>';}
        clearMeta();
      }else{
      $query = "INSERT INTO `tblReview` SET `pfkCustomerEmail` = ?, `fldStars` = ?,
      `fldReview` = ?";
      $info = [$_SESSION['user']['pmkCustomerEmail'], intval($_POST['stars']),$_POST['review']];
      if ($thisDatabaseWriter->querySecurityOk($query, 0)){
          $query = $thisDatabaseWriter->sanitizeQuery($query);
          $sucess = $thisDatabaseWriter->insert($query, $info);}
      if($sucess){
        print'<p>Thank you for your review</p>';
      }else{
        print'<p>Your review has not been posted</p>';}
      clearMeta();
    }}else {
      print'<h3>What did you think of Shmead Meads?</h3><br></br>';
      print'<form action="review.php" method="post">';
      print'<label for="stars">Pick 1-5 stars:</label>';
      print'<select name="stars" id="stars">';
      print'<option value="1">&#9733 &#9734 &#9734 &#9734 &#9734</option>';
      print'<option value="2">&#9733 &#9733 &#9734 &#9734 &#9734</option>';
      print'<option value="3">&#9733 &#9733 &#9733 &#9734 &#9734</option>';
      print'<option value="4">&#9733 &#9733 &#9733 &#9733 &#9734</option>';
      print'<option value="5">&#9733 &#9733 &#9733 &#9733 &#9733</option>';
      print'</select><br></br>';
      print'<label for="review">Give us your review:</label><br></br>
      <textarea id="review" name="review" rows="4" cols="50"></textarea><br></br>';
      print'<input type="submit" name="submit" value="Submit"/>';
      print'</form>';
    }
  }else{
    print'<h3>Only users may leave reviews</h3>';
    print'<form action="review.php" method="post">';
    print '<input type="submit" name="status" value="Login/Sign Up"/>';
    print '</form>';
  }
  ?>
</main>
<?php include 'footer.php'; ?>
