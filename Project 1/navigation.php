<nav>
    <div class="dropdown">
        <button class="dropbtn">Categories</button>
        <div class="dropdown-content">
            <a href="./category.php?code=Misc">Misc</a>
            <a href="./category.php?code=Entertainment">Entertainment</a>
            <a href="./category.php?code=Hygiene">Hygiene</a>
            <a href="./category.php?code=Phones">Phones</a>
            <a href="./category.php?code=Ballistic-Missiles">Ballistic-Missiles</a>
            <a href="./category.php?code=Landscaping">Landscaping</a>
        </div>
    </div>
    <a href="./index.php">Home</a>
    <a href="./orders.php">Orders made</a>
    <a href="./LoginPage.php">Login</a>
    <a href="./RegisterPage.php">Register</a>
    <a href="./signout.php">Signout</a>
    <a href="./CRUDpage.php">CRUD Operations</a>
    <p style="text-align: right">Hello <?php echo $_SESSION['id'] ?></p>
</nav>