<?php
include 'top.php';
?>

<main>




    <?php
        $query = "SELECT `pmkProductID`, `fldName`,`fldPrice`,`fldRemainingStock`, `fldImage` FROM `tblInventory` WHERE `pmkProductID` = '$_GET[productID]'";
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
            print '<p> We currently have ' . $record['fldRemainingStock'] . ' left in stock </p>';
        }
    ?>

<!--get quantity of product being bought  -->
    <form method = "get" action = "">
        <label for = 'quantity'>Quantity</label>
        <input type = 'text' name = 'quantity' id = 'quantity' size = '2'>
        <input type = "hidden" name= "productID"  id= "productID" value= <?php echo $_GET["productID"];?> >
        <input type = 'submit' id = 'submit' name = 'submit' value = 'Add to Cart'>
        <?php
        $submit = isset($_GET['submit']);
        if($submit) {
            $insertToCartQuery = "INSERT INTO `tblCarts`  SET `pfkCustomerEmail` = ?, `pfkProductID` = ?, `fldOrderQuantity` = ?";
            //VALUES ( '" . $_SESSION['user']['pmkCustomerEmail'] . "' , " . $_GET["productID"] . " , " . $_GET["quantity"] .")
            //WHERE `pmkCustomerEmail` = ". $_SESSION['user']['pmkCustomerEmail']";
            $email = "' ". $_SESSION['user']['pmkCustomerEmail'] . " ' ";
            $info = [$email, $_GET["productID"], $_GET["quantity"]];
            print_r($info);
            //comment next line to not show security test
            $thisDatabaseReader->testSecurityQuery($insertToCartQuery, 0, 0, 0, 0, 0);

            if ($thisDatabaseReader->querySecurityOk($insertToCartQuery, 0, 0, 0, 0, 0)) {
                $insertToCartQuery = $thisDatabaseReader->sanitizeQuery($insertToCartQuery);
                $success = $thisDatabaseReader->insert($insertToCartQuery, $info);
            }
            if($success)
            {
                print '<p>' . $insertToCartQuery . '</p>';
            }else{
                print_r($info);
                print '<p> Query Failed! </p>';
            }
        }
        ?>
    </form>
</main>



<?php include 'footer.php'; ?>
