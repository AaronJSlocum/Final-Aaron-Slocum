
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
        <style>
            /* basic CSS with a little extra for the figure element */
            body{
                margin: auto;
                padding: 3%;
                width: 90%;
            }

            figure {
                border: thin solid darkslategray;
                border-radius: 3%;
                padding: 3%;
                text-align: center;
            }

            figcaption {
                color: #839e99;
                font-style: italic;
                text-align: center;
            }

            img{
                border-radius: 3%;
                max-width: 100%
            }

            .right{
                float: right;
                margin-left: 3%;
            }

            .small {
                width: 20%;
            }
            /* 
                           advanced css for future labs 
                           you may use this format for lab 1 if you like 
            */
            .header{
                grid-area: header;
                grid-column: 1 / 3;
                padding: .3em;
                margin: .3em;
            }  
            .public-files{
                grid-area: public-files;
                padding: .3em;
                margin: .3em;
            }

            .supporting-files{
                grid-area: supporting-files;
                padding: .3em;
                margin: .3em;
            }
            .grader-notes{
                grid-area: grader-notes;
                padding: .3em;
                margin: .3em;
            }
            .grid-layout{
                border-bottom: thin dashed navy;
                display: inline-grid;
                grid-template-columns: 25% 25% 50%;
                grid-template-areas: "header header header"
                    "public-files supporting-files grader-notes"; 
                padding: .3em;
                margin: .3em;
                width: 100%;    
            }
	
	    tr:nth-child(even){
	        background-color: #B0B7B7;
	    }
	    tr:hover {
		background-color: #338A2E;
	    }
	    table {
		width: 50%;
	    }


        </style>

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

	
    </head>