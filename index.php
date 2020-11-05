<?php
	include 'top.php';
?>
	


<figure class="right small">
            <img alt="Henry Rice" src="henry.jpg">
            <figcaption>Doin some laundry.</figcaption>
</figure>

    
	<h1>Henry Rice - Lab 5</h1>
	
	<?php
		$query = "SELECT `fldFirstName`, `fldLastName`, `pmkNetId`
				FROM `tblStudents`";

		$records = "";
	    if ($thisDatabaseReader->querySecurityOk($query, 0,0,0,0,0))
		{
            $query = $thisDatabaseReader->sanitizeQuery($query,0,0,1,0,0);

		    $records = $thisDatabaseReader->select($query, '');
		}

	?>
	<form action="<?php print PHP_SELF; ?>" method="get">
	<label>Which Student would you like to see?</label>
	<select name="studentName" size="3">
		<?php

		foreach($records as $record)
		{
            $name = "";
            $netID = "";
		    $name .= $record['fldFirstName'] . " " . $record['fldLastName'];
		    $netID .= $record['pmkNetId'];
			print "<option value = '$netID' > '$name' </option>";
		}	
		?>
	</select>
	
	<input type="submit" name="submit" value="Submit"/>
	</form>

	

	<table>
		<caption><strong>Select a student to view their enrollments</strong></caption>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Subj</th>
			<th>#</th>
			<th>Title</th>
			<th>Start Time</th>
			<th>End Time</th>
			<th>Days</th>
			<th>Bldg</th>
			<th>Room</th>
			<th>Proffesor</th>
		</tr>

	<?php
		
		$query = "SELECT tblStudents.fldFirstName, tblStudents.fldLastName, tblEnrollments.Subj, tblEnrollments.number, tblEnrollments.Title, tblEnrollments.Days, tblEnrollments.Start_Time, tblEnrollments.End_Time, tblEnrollments.Bldg, tblEnrollments.Room, tblTeachers.pmkNetId
			FROM `tblEnrollments`
			INNER JOIN `tblStudentEnrollments` ON tblEnrollments.pmkEnrollmentId=tblStudentEnrollments.pfkEnrollmentId
			INNER JOIN `tblStudents` ON tblStudentEnrollments.pfkStudentNetId=tblStudents.pmkNetId
			INNER JOIN `tblTeachers` ON tblEnrollments.NetId=tblTeachers.pmkNetId
			WHERE tblStudentEnrollments.pfkStudentNetId = '" . $_GET["studentName"] ."'";

		$records = '';

		$ssquery = 'SELECT * FROM tblStudents';


		//print($query);		

		// NOTE: The full method call would be:
		
		//$thisDatabaseReader->querySecurityOk($query, 0, 0, 0, 0, 0);
		//print("test");


		if ($thisDatabaseReader->querySecurityOk($query)) 
		{
			$query = $thisDatabaseReader->sanitizeQuery($query,1,0,1,0,0);
			
			$records = $thisDatabaseReader->select($query, '');
    
		}
		
		//$statement = $pdo->prepare($sql);
		//$statement->execute();
		//$records = $statement->fetchAll();

		foreach ($records as $record) {
    			print '<tr>';
			print '<td>' . $record['fldFirstName'] . '</td>';
			print '<td>' . $record['fldLastName'] . '</td>';
    			print '<td>' . $record['Subj'] . '</td>';
    			print '<td>' . $record['number'] . '</td>';
    			print '<td>' . $record['Title'] . '</td>';
    			print '<td>' . $record['Start_Time'] . '</td>';
			print '<td>' . $record['End_Time'] . '</td>';
   			print '<td>' . $record['Days'] . '</td>';
    			print '<td>' . $record['Bldg'] . '</td>';
    			print '<td>' . $record['Room'] . '</td>';
			print '<td>' . $record['pmkNetId'] . '</td>';
    			print '</tr>' . PHP_EOL;
		}
	?>

	</table>
    <p><a href="subjects.php">Click here to enroll a student in a course.</a></p>
        

        

        
            

        
   

	<footer>
	<?php
		include 'footer.php';
	?>
	</footer>

 </body>
