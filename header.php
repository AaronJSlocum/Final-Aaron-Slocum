<!-- ###################   Page header #################### -->
<header class = "headerBanner">
    <h1>Shmead Meads</h1>
    <?php
    if (isset($_SESSION['user'])){
			print'<h3>  Hello '. $_SESSION['user']['fldFirstName'] . ' ' .
			$_SESSION['user']['fldLastName'].'</h3>';
		}?>
    <!--<h3>Final Project - Aaron Slocum, Henry Rice, Emmett O'Connell</h3> -->

</header>
