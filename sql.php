//CREATE TABLE IF NOT EXISTS `HMRICE_Registrar_Data_2020`.`tblEnrollments` (` Subj` varchar(4), `#` varchar(3), `Title` varchar(30), `Comp Numb` int(5), `Sec` varchar(3), `Ptrm` varchar(1), `Lec Lab` varchar(4), `Attr` varchar(4), `Camp Code` varchar(1), `Coll Code` varchar(4), `Max Enrollment` int(3), `Current Enrollment` int(3), `True Max` varchar(3), `Start Time` varchar(5), `End Time` varchar(5), `Days` varchar(10), `Credits` varchar(9), `Bldg` varchar(6), `Room` varchar(9), `GP Ind` varchar(1), `Instructor` varchar(30), `NetId` varchar(8), `Email` varchar(35), `Fees` varchar(26), `XListings` varchar(114)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


<?php
include "top.php";
?>

<h2>Create Table Statement</h2>

<pre>
CREATE TABLE `tblEnrollments` (
  ` Subj` varchar(4) DEFAULT NULL,
  `#` varchar(3) DEFAULT NULL,
  `Title` varchar(30) DEFAULT NULL,
  `Comp Numb` int(5) DEFAULT NULL,
  `Sec` varchar(3) DEFAULT NULL,
  `Ptrm` varchar(1) DEFAULT NULL,
  `Lec Lab` varchar(4) DEFAULT NULL,
  `Attr` varchar(4) DEFAULT NULL,
  `Camp Code` varchar(1) DEFAULT NULL,
  `Coll Code` varchar(4) DEFAULT NULL,
  `Max Enrollment` int(3) DEFAULT NULL,
  `Current Enrollment` int(3) DEFAULT NULL,
  `True Max` varchar(3) DEFAULT NULL,
  `Start Time` varchar(5) DEFAULT NULL,
  `End Time` varchar(5) DEFAULT NULL,
  `Days` varchar(10) DEFAULT NULL,
  `Credits` varchar(9) DEFAULT NULL,
  `Bldg` varchar(6) DEFAULT NULL,
  `Room` varchar(9) DEFAULT NULL,
  `GP Ind` varchar(1) DEFAULT NULL,
  `Instructor` varchar(30) DEFAULT NULL,
  `NetId` varchar(8) DEFAULT NULL,
  `Email` varchar(35) DEFAULT NULL,
  `Fees` varchar(26) DEFAULT NULL,
  `XListings` varchar(114) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
</pre>

<h2>Insert sql example</h2>
<p>
INSERT INTO `tblEnrollments` (` Subj`, `#`, `Title`, `Comp Numb`, `Sec`, `Ptrm`, `Lec Lab`, `Attr`, `Camp Code`, `Coll Code`, `Max Enrollment`, `Current Enrollment`, `True Max`, `Start Time`, `End Time`, `Days`, `Credits`, `Bldg`, `Room`, `GP Ind`, `Instructor`, `NetId`, `Email`, `Fees`, `XListings`) VALUES
('ANFS', '491', 'Doctoral Dissertation Research', 90005, 'A', '1', 'TD', '', 'M', 'CALS', 20, 0, '', 'TBA', '', '       ', '1 to 18', '', '', 'N', 'Harvey, Jean Ruth', 'jharvey', 'Jean.Harvey@uvm.edu', '', ' ');
</p>

<h2>Select sql statement</h2>
<p>
SELECT * FROM `tblEnrollments` WHERE `Days` LIKE '%m%' AND `Bldg` = 'VOTEY' AND `Room` = '303' ORDER BY `End Time` ASC
</p>

<?php
include "footer.php";
?>