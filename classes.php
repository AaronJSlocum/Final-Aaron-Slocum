<?php
include 'top.php';


?>

<form action="" method="get">
		<!--
		<caption><strong>Subjects</strong></caption>
		-->
    <label>Classes</label>
<!--    <select name="studentName" size="3">-->
    <?php
    //print PHP_EOL;

    $query = "SELECT `Title`,`number`,`pmkEnrollmentId` FROM `tblEnrollments` WHERE `Subj` = '$_GET[subject]'";
    $studentQuery = "SELECT `fldFirstName`, `fldLastName`, `pmkNetId` FROM `tblStudents`";
    //print_r($query);
    $records = array();
    $studentRecords = array();
    if ($thisDatabaseReader->querySecurityOk($studentQuery,0,0,0,0,0))
    {
        $studentQuery = $thisDatabaseReader->sanitizeQuery($studentQuery,0,0,1,0,0);

        $studentRecords = $thisDatabaseReader->select($studentQuery, '');

    }
    if ($thisDatabaseReader->querySecurityOk($query,1,0,2,0,0))
    {
        $query = $thisDatabaseReader->sanitizeQuery($query,1,0,1,0,0);

        $records = $thisDatabaseReader->select($query, '');

    }
    ?>

        <label>Which Student would you like to ENROLL for?</label>
        <select name="studentNetId" size="3">
            <?php
            foreach($studentRecords as $studentRecord)
            {
                $name = "";
                $netID = "";
                $name .= $studentRecord['fldFirstName'] . " " . $studentRecord['fldLastName'];
                //$netID .= ;
                print "<option value = '".$studentRecord['pmkNetId']. "'> '$name' </option>";
            }
            //print $_GET['pmkNetId'];
            ?>
        </select>



    <?php
    //print_r($records);
    foreach ($records as $record) {
        print '<p>';
        print '<input type="checkbox" id="' . $record['pmkEnrollmentId'] . '" value="' .$record['pmkEnrollmentId'].'" name ="class[]">';
        print '<label for="' . $record["pmkEnrollmentId"] . '">' . $record["number"] . " " . $record["Title"] . '</label>';
        //echo "/r/n";
        print '</p>';
    }
    ?>
<!--    </select>-->
    <input type="submit" name="submit" value="Submit" />

    <?php
        $insertQuery = "INSERT INTO `tblStudentEnrollments` (`pfkStudentNetId`,`pfkEnrollmentId`) VALUES ";
        //$insertRecords = array();
        //print $_GET['class'];
        $itemCount = count($_GET['class']);

        $index = 0;
        foreach($_GET['class'] as $insertRecord)
        {
            //print $insertRecord;
            $index++;
            if($index == $itemCount)
            {
                $insertQuery .= "('" . $_GET['studentNetId'] . "', '" . $insertRecord . "')";
            }else{
                $insertQuery .= "('" . $_GET['studentNetId'] . "', '" . $insertRecord . "'),";
            }

        }

        if ($thisDatabaseWriter->querySecurityOk($insertQuery,0,0,($itemCount*4),0,0))
        {
            $insertQuery = $thisDatabaseWriter->sanitizeQuery($insertQuery,0,0,1,0,0);
            $insertRecords = $thisDatabaseWriter->insert($insertQuery, '');
        }
        //print $insertQuery;
    ?>
</form>


<?php
    include 'footer.php';
    ?>



