<head>
<style>
.topBanner {
  background-color: #333;
  overflow: hidden;
}

/* Style the links inside the navigation bar */
.topBanner a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topBanner a:hover {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
</style>
</head>
<!-- ######################     Main Navigation   ########################## -->
<nav class = "topBanner">
    <a class="<?php
    if ($path_parts['filename'] == "index") {
        print 'activePage';
    }
    ?>" href="index.php">Home</a>
    
    <a class="<?php
    if ($path_parts['filename'] == "products") {
        print 'activePage';
    }
    ?>" href="products.php">Products</a>
    
    <a class="<?php
    if ($path_parts['filename'] == "cart") {
        print 'activePage';
    }
    ?>" href="cart.php">Cart</a>
    
    <a class="<?php
    if ($path_parts['filename'] == "login") {
        print 'activePage';
    }
    ?>" href="login.php">Login/Sign Up</a>
</nav>
<!-- #################### Ends Main Navigation    ########################## -->
