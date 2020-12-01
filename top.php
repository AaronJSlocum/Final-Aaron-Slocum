<?php
	$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");
	 session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Shmead Mead.</title>
        <meta name="author" content="Henry Rice, Aaron Slocum, Emmett O'Connell">
        <meta name="description" content="A site for purchasing delicious meads">
        <link rel='stylesheet' href='custom_css_final.css' type='text/css'>
    </head>


<?php
        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //
        // inlcude all libraries.
        //
        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        print '<!-- begin including libraries -->';

        include 'lib/constants.php';

        include LIB_PATH . '/Connect-With-Database.php';

        print '<!-- libraries complete-->';

				function clearMeta(){
					foreach ($_POST as $key => $value) {
						unset($_POST[$key]);
					}
					foreach ($_GET as $key => $value) {
						unset($_GET[$key]);
					}
				}
?>
 <?php
    //giving each body element an id really helps the css later on
    print '<body class="grid-layout positioning" id="' .$path_parts['filename']. '">';
    include 'header.php';
		if (isset($_SESSION['user'])){
			print'<h3> Hello '. $_SESSION['user']['fldFirstName'] . ' ' .
			$_SESSION['user']['fldLastName'].'</h3>';
		}
    print PHP_EOL;
    include 'nav.php';
    ?>
