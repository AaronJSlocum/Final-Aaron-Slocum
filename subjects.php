<?php
include 'top.php';


?>

<table>
		<!--
		<caption><strong>Subjects</strong></caption>
		-->
		<tr>
			<th>Subjects</th>
		</tr>
    <?php


    $query = "SELECT DISTINCT `Subj` FROM `tblEnrollments`";

    $records = array();

    if ($thisDatabaseReader->querySecurityOk($query,0,0,0,0,0))
    {
        $query = $thisDatabaseReader->sanitizeQuery($query,1,0,1,0,0);

        $records = $thisDatabaseReader->select($query, '');

    }
    //print_r($records);
    foreach ($records as $record) {
        print '<tr>';

        print '<td> <a href="classes.php?subject=' . $record['Subj'] . '">' . $record['Subj'] . '</a></td>';

        print '</tr>' . PHP_EOL;
    }
    ?>

</table>


<footer>
    <?php
    include 'footer.php';
    ?>
</footer>

</body>
