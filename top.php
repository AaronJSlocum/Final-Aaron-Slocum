
<?php
	// include "../../bin/Database.php";
	
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>CS 148 ROCKS.</title>
        <meta name="author" content="Henry Rice">
        <meta name="description" content="A site map to all my groovy assignments for the best course at UVM.">
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
?>	
 <?php
    //giving each body element an id really helps the css later on
    print '<body class="grid-layout positioning" id="' .$path_parts['filename']. '">';
    include 'header.php';
    print PHP_EOL;
    include 'nav.php';
    ?>
	
