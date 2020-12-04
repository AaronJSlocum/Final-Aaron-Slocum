<?php
include 'top.php';
?>

<main>


    <h1>Our Fine Selection</h1>



    <table class="productTable">
    		<!--

    		-->

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
            print '<pre>';
            print '<a href="product_descript.php?productID=' . $record['pmkProductID'] . '">' . $record['fldName'] .'';
            print '</pre>';
            print '<pre>';
            print '<img src="'. $record['fldImage'] .  '" alt="ProductImage" style="width:128px;height:128px;">';
            print  '</a>';
            print '</pre>';
//            print '<tr>';
//
//            print '<td> <img src="'. $record['fldImage'] .  '" alt="ProductImage" style="width:128px;height:128px;"> </td>';
//
//            print '</tr>' . PHP_EOL;
//
//            print '<tr>';
//
//            print '<td> <a href="product_descript.php?productID=' . $record['pmkProductID'] . '">' . $record['fldName'] . '</a></td>';
//
//            print '</tr>' . PHP_EOL;
        }
        ?>

    </table>
</main>
<?php include 'footer.php'; ?>
