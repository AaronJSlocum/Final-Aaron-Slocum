<?php
include 'top.php';
?>

<main>




    <?php
        $query = "SELECT `pmkProductID`, `fldName`,`fldPrice`,`fldRemainingStock`, `fldImage`,  `fldDescription` FROM `tblInventory` WHERE `pmkProductID` = '$_GET[productID]'";
        //print '<h1>' . $query . '</h1>';
        if ($thisDatabaseReader->querySecurityOk($query,1,0,2,0,0))
            {
                $query = $thisDatabaseReader->sanitizeQuery($query,1,0,1,0,0);

                $records = $thisDatabaseReader->select($query, '');

            }

        foreach($records as $record)
        {
            print '<h1>' . $record['fldName'] . '</h1>';
            print '<h2>$' . $record['fldPrice'] . '</h2>';
            print '<img src="'. $record['fldImage'] .  '" alt="ProductImage" style="width:128px;height:128px;">';
            print '<p>' . $record['fldDescription'] . '</p>';
            if ($record['fldRemainingStock'] == 0)
            {
                print '<p>This item is currently out of stock, sorry.</p>';
            }else {
                print '<p> We currently have ' . $record['fldRemainingStock'] . ' left in stock </p>';
            }
        }
    ?>

<!--get quantity of product being bought  -->
    <form method = "get" >
        <label for = 'quantity'>Quantity</label>
        <select name = 'quantity' id = 'quantity'>
            <?php
                for ($x = 0; $x <= $record['fldRemainingStock']; $x++) {
                    print '<option value = "'.$x.'">' . $x . '</option>';
                }
            ?>
        </select>
        <input type = "hidden" name= "productID"  id= "productID" value= <?php echo $_GET["productID"];?> >
        <input type = 'submit' id = 'submit' name = 'submit' value = 'Add to Cart'>
    </form>
        <?php
        $submit = isset($_GET['submit']);
        if($submit) {
          $query = "INSERT INTO `tblCarts` SET `pfkCustomerEmail` = ?, `pfkProductID` = ?,
          `fldOrderQuantity` = ?";

            $email = $_SESSION['user']['pmkCustomerEmail'];
            //print '<p>'. $_GET['quantity'] .'</p>';
            $info = [$email, $_GET["productID"], $_GET["quantity"]];

            if ($thisDatabaseWriter->querySecurityOk($query, 0)) {
                $insertToCartQuery = $thisDatabaseWriter->sanitizeQuery($query);
                $success = $thisDatabaseWriter->insert($query, $info);
            }

            if($success){
                print '<p>Order added to your cart!</p>';
            }else{
                print '<p>Order Failed! </p>';
            }
        }
        ?>
</main>



<?php include 'footer.php'; ?>
