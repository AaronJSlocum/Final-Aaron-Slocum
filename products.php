<?php
include 'top.php';
?>

<main>
    <p>Pictures of products with descriptions, links to purchase/view more</p>





    <table>
    		<!--

    		-->
    		<tr>
    			<th>Our Selection</th>
    		</tr>
        <?php


        $query = "SELECT * FROM `tblInventory`";

        $records = array();

        if ($thisDatabaseReader->querySecurityOk($query,0,0,0,0,0))
        {
            $query = $thisDatabaseReader->sanitizeQuery($query,0,0,1,0,0);

            $records = $thisDatabaseReader->select($query, '');

        }
        //print_r($records);
        foreach ($records as $record) {
            print '<tr>';

            print '<td> <a href="product_descript.php?productID=' . $record['pmkProductID'] . '">' . $record['fldName'] . '</a></td>';

            print '</tr>' . PHP_EOL;
        }
        ?>

    </table>
</main>
<?php include 'footer.php'; ?>
