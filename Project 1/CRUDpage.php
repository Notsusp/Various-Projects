<?php
include_once 'session_check.php';
?>
<link rel="stylesheet" href="style.css">
<div class="sidebyside">
    <div>
        <h4>Add a product</h4>
        <form action="CRUD/Create.php" method="post">
            <div>
                <input type="text"  placeholder=" Name" name="product_name" required>
            </div>
            <div>
                <textarea type= "text" placeholder="Description" name="product_desc" rows="4" cols="50" required></textarea>
            </div>
            <div>
                <p>Always add img/ before the name</p>
                <input type="text" placeholder="Image Name" name="image" required>
            </div>
            <div>
                <input type="text" placeholder="Unique product code" name="code" required>
            </div>

            <div>
                <input type="text" placeholder="Price" name="price" required>
            </div>
            <div>
                <input type="text" placeholder="Number in stock" name="stock" required>
            </div>
            <div>
                <input type="text" placeholder="Category" name="stock" required>
            </div>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
    <div>
        <h4>Delete Product</h4>
        <form action="CRUD/Delete.php" method="post">
            <div>
                <input type="text"  placeholder="Enter the ID of the product" name="id" required>
            </div>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
    <div>
        <h4>Show product</h4>
        <form action="CRUD/Read.php" method="post">
            <div>
                <input type="text"  placeholder="Enter the ID of the product" name="id" required>
            </div>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
    <div>
        <h4>Change a product</h4>
        <h3>Only type what you want to change and the ID</h3>
        <form action="CRUD/Update.php" method="post">
            <div>
                <input type="text" placeholder="Enter the ID of the product" name="id" required>
            </div>
            <div>
                <input type="text"  placeholder="Product Name" name="product_name">
            </div>
            <div>
                <textarea type="text" placeholder="Description" name="product_desc" rows="4" cols="50"></textarea>
            </div>
            <div>
                <p>Always add img/ before the name</p>
                <input type="text" placeholder="Image Name" name="image">
            </div>

            <div>
                <input type="text" placeholder="Price" name="price">
            </div>
            <div>
                <input type="text" placeholder="Current stock" name="stock">
            </div>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
    <div>
    </div>