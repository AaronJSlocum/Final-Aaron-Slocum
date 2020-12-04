<?php
include 'top.php';
?>

<main>

    <table>
        <tr>
            <th>Your Cart</th>
        </tr>
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

        $records = array();

        if ($thisDatabaseReader->querySecurityOk($query,1,1,2,0,0))
        {
            $query = $thisDatabaseReader->sanitizeQuery($query,1,0,1,0,0);

            $records = $thisDatabaseReader->select($query, '');
        }
        //print_r($records);
        foreach ($records as $record) {

        print '<tr>';

            //print '<td> <a href="product_descript.php?productID=' . $record['pmkProductID'] . '">' . $record['fldName'] . '</a></td>';
            print '<td>' . $record["fldOrderQuantity"] . '</td>';
            print '<td>' . $record["fldName"] . '</td>';
            print '<td>$' . $record["fldPrice"] . '</td>';
            print '</tr>' . PHP_EOL;
        }
        ?>


    </table>
</main>
<?php include 'footer.php'; ?>
