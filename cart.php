<?php
include 'top.php';
?>

<main>

    <table>
        <h1>Your Cart</h1>
        <?php

        $query = "SELECT tblCarts.pfkCustomerEmail, tblCarts.pfkProductID, tblCarts.fldOrderQuantity, tblInventory.pmkProductID, tblInventory.fldName, tblInventory.fldPrice, tblInventory.fldImage, tblInventory.fldRemainingStock 
                            FROM `tblCarts` 
                            INNER JOIN `tblInventory` ON tblCarts.pfkProductID = tblInventory.pmkProductID
                            WHERE tblInventory.pmkProductID = tblCarts.pfkProductID AND tblCarts.pfkCustomerEmail = '". $_SESSION['user']['pmkCustomerEmail']. "'";


        if(isset($_SESSION['user'])) {

            $records = array();

            if ($thisDatabaseReader->querySecurityOk($query, 1, 1, 2, 0, 0)) {
                $query = $thisDatabaseReader->sanitizeQuery($query, 1, 0, 1, 0, 0);

                $records = $thisDatabaseReader->select($query, '');
            }
            //print_r($records);
            print '<form method = "get">';
            //print '<tr>';
            //print '<th>Your Cart</th>';
            //print '</tr>';

            print '<tr>';
            print '<td>Remove?</td>';
            print '<td>Quantity</td>';
            print '<td>Name</td>';
            print '<td>Price</td>';
            print '</tr>';


            foreach ($records as $record) {




                print '<tr>';
                //print '<td> <a href="product_descript.php?productID=' . $record['pmkProductID'] . '">' . $record['fldName'] . '</a></td>';
                print '<td><input type="checkbox" name = "items[]" value =' . $record["pfkProductID"] . '> </td>';
                print '<td>' . $record["fldOrderQuantity"] . '</td>';
                print '<td>' . $record["fldName"] . '</td>';
                print '<td>$' . $record["fldPrice"] . '</td>';
                print '</tr>' . PHP_EOL;
            }
            print '</table>';
            $total = 0;
            foreach ($records as $record) {
                $productTotal = $record["fldOrderQuantity"] * $record["fldPrice"];
                $total += $productTotal;
            }
            print '<p> Your order total is $'.$total.'!</p>';
            print '<input type = "submit" name = "remove_submit" value = "Remove Item(s)">';
            $submit = isset($_GET['remove_submit']);
            if($submit)
            {


                foreach($_GET["items"] as $item)
                {
                    print '<p>Removing...</p>';
                    print '<p>'.$item. '</p>';
                    $removeQuery = "DELETE FROM `tblCarts` WHERE `pfkCustomerEmail` = '". $_SESSION['user']['pmkCustomerEmail'] . "' AND `pfkProductID` = " . $item;
                    print '<p>' . $removeQuery . '</p>';
                    $deleteRecords = array();
                    //$thisDatabaseWriter->testSecurityQuery($removeQuery);


                    if ($thisDatabaseWriter->querySecurityOk($removeQuery, 1, 1, 2, 0, 0)) {
                        $removeQuery = $thisDatabaseWriter->sanitizeQuery($removeQuery, 1, 0, 1, 0, 0);

                        $deleteRecords = $thisDatabaseWriter->delete($removeQuery, '');
                    }
                }
                header( "Location: cart.php" );

            }
            //print '<input type = "submit" name = "proceed_checkout" value = "Proceed to Checkout">';
            print '</form>';


            print '<form action="transaction_form.php">';
            print '<input type="submit" value="Proceed to Checkout"/>';
            print '</form>';



        }else{
            print '<p>Please sign in to view your cart</p>';
        }
            ?>


    
</main>
<?php include 'footer.php'; ?>
