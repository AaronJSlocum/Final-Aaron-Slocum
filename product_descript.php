<?php
include 'top.php';
?>

<main>
    <p>Specific product description, link to add to cart</p>

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

    <form method = "get" action = "cart.php">
        <label>Quantity</label>
        <input type = 'text' name = '#' size = '2' >
        <input type = 'submit' value = 'Add to Cart'>
    </form>
</main>
<?php include 'footer.php'; ?>
