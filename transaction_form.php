<?php
include 'top.php';
?>

<main>
    <body>
    <h2>Confirm your order</h2>
    <table>

        <?php

        //email => session email, cart product id innerjoin inventory productID
        //INSERT INTO `tblCarts` (tblCustomers.pmkCustomerEmail, tblInventory.fldName, tblInventory.fldPrice)
        $query = "SELECT tblCarts.pfkCustomerEmail, tblCarts.pfkProductID, tblCarts.fldOrderQuantity, tblInventory.pmkProductID, tblInventory.fldName, tblInventory.fldPrice, tblInventory.fldImage, tblInventory.fldRemainingStock 
                            FROM `tblCarts` 
                            INNER JOIN `tblInventory` ON tblCarts.pfkProductID = tblInventory.pmkProductID
                            WHERE tblInventory.pmkProductID = tblCarts.pfkProductID AND tblCarts.pfkCustomerEmail = '". $_SESSION['user']['pmkCustomerEmail']. "'";

        //$thisDatabaseReader->testSecurityQuery($query, 1, 1, 2, 0, 0);

        //print '<p>' . $query . '</p>';

//        $fillCartQuery = "INSERT INTO `tbleCarts` ()";
//        $displayQuery = "SELECT * FROM `tblCarts`";
        if(isset($_SESSION['user'])) {

            $records = array();

            if ($thisDatabaseReader->querySecurityOk($query, 1, 1, 2, 0, 0)) {
                $query = $thisDatabaseReader->sanitizeQuery($query, 1, 0, 1, 0, 0);

                $records = $thisDatabaseReader->select($query, '');
            }
            //print_r($records);
            

            print '<tr>';
            print '<td>Quantity</td>';
            print '<td>Name</td>';
            print '<td>Price</td>';
            print '</tr>';
            $cartProcessed = true;
            foreach ($records as $record) {




                print '<tr>';
                //print '<td> <a href="product_descript.php?productID=' . $record['pmkProductID'] . '">' . $record['fldName'] . '</a></td>';
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
            
        print '<form method = "get" action = "transaction_form.php">';
        print '<input type="checkbox" id="orderConfirmation" name="confirm" value="confirm">';
        print'<label for="vehicle1">Confirm my order</label>';
        print"<input type = 'submit' id = 'submit' name = 'submit' value = 'submit'>";
        print'</form>';
        
        $submit = isset($_GET['submit']);
        $confirm = isset($_GET['confirm']);
        if($submit && $confirm) {
            $transactionQuery = "INSERT into tblOrderDetails SET `fldProductID` = ?, pfkCustomerEmail = ?, fldPurchaseDate = ?, pfkOrderedQuantity = ?, fldCompletionStatus = ?";
            $email = $_SESSION['user']['pmkCustomerEmail'];
            
            foreach ($records as $record) {
                $productID = $record['pfkProductID'];
                $purchaseDate = date("m/d/Y");
                $orderQuantity = $record['fldOrderQuantity'];
                $completionStatus = true;
//                print '<p>Product ID:' . $productID . '</p>';
//                print '<p>Email:' . $email . '</p>';
//                print '<p>Purchase Date:' . $purchaseDate . '</p>';
//                print '<p>Order Quantity:' . $orderQuantity . '</p>';
//                print '<p>Completion Status:' . $completionStatus . '</p>';
                
                $values = [$productID,$email,$purchaseDate,$orderQuantity,$completionStatus];
                
                if ($thisDatabaseWriter->querySecurityOk($transactionQuery,0,0,0,0,0)) {
                    $transactionQuery = $thisDatabaseWriter->sanitizeQuery($transactionQuery);
                    $success = $thisDatabaseWriter->insert($transactionQuery, $values);
                }
                else{
                    print 'failed query security';
                }
                if($success){
                    
                }else{
                    print '<p>Order Failed! </p>';
                    $cartProcessed = false;
                }
            }
            if($cartProcessed){
                $subj = 'Your Recent Mead Purchase';
                $msg = 'Thank you for choosing us as your mead vendors! We hope to hear from you again soon!';
                $email_array = [$email];
                $deleteQuery = 'DELETE FROM tblCarts WHERE `pfkCustomerEmail` = ?';
                    if ($thisDatabaseWriter->querySecurityOk($deleteQuery,1,0,0,0,0)) {
                        $deleteQuery = $thisDatabaseWriter->sanitizeQuery($deleteQuery);
                        $success = $thisDatabaseWriter->insert($deleteQuery, $email_array);
                    }
                    else{
                        print 'failed query security';
                    }
                if($success){
                    print '<p>Order Complete! We will contact you for more information.</p>';
                    print '<p>Cart Deleted!</p>';

                    mail($email,$subj,$msg);
                }else{
                    print '<p>Deletion Failed! </p>';
                } 
                
            }
            
                
                
        }
        }else{
            print '<p>Please Sign In to view your order confirmation</p>';
        }
        
        ?>
    </body>
        
</main>
<?php include 'footer.php'; ?>
