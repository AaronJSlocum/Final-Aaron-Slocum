<?php
include 'top.php';
?>

<main>
        <figure class="right small">
            <img alt="Logo" src="images/logo.png">
        </figure>
        <h1>Who we are</h1>
        <p>We here at Shmead Meads are committed to producing only the most delicious mead possible. We will stop at nothing to procure the finest honey and transform it into artisanal, world-class mead. We are a small, independent start-up dedicated to the brewing craft. Please do not hesitate to browse out fine selection of beverages available for sale.  </p>
        <h2>Testimonials</h2>
        <p>"Wow, thank you so much to the guys at Shmead Meads, without them I could never have become this handsome and talented. I owe it all to the hard work these fine brewers are putting in." - Danny DeVito</p>
        <p>"It was ok" - Aaron Slocum's mother</p>
        <p>"My god, this is the betht mead I've ever had" - 10 time heavyweight champion, Mike Tyson </p>

    <?php
    $query = "SELECT tblReview.pfkCustomerEmail, tblReview.fldStars, tblReview.fldReview, tblCustomers.pmkCustomerEmail, tblCustomers.fldFirstName, tblCustomers.fldLastName 
                            FROM `tblReview` 
                            INNER JOIN `tblCustomers` ON tblReview.pfkCustomerEmail = tblCustomers.pmkCustomerEmail
                            WHERE tblReview.pfkCustomerEmail = tblCustomers.pmkCustomerEmail";

    //print '<p>' . $query . '</p>';

    //$thisDatabaseReader->testSecurityQuery($query);
    //print '<h1>' . $query . '</h1>';
    if ($thisDatabaseReader->querySecurityOk($query,1,0,0,0,0))
    {
        $query = $thisDatabaseReader->sanitizeQuery($query,0,0,0,0,0);

        $records = $thisDatabaseReader->select($query, '');

    }

    foreach ($records as $record) {
        print '<p>"'. $record['fldReview'] .'"   - '.$record['fldFirstName'] . ' ' .$record['fldLastName'].'</p>';
    }

    ?>
</main>
<?php include 'footer.php'; ?>