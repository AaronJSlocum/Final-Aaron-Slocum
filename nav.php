
<!-- ######################     Main Navigation   ########################## -->
<nav>
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
