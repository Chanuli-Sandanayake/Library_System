<?php
include_once 'header.php';
?>
        <a href="#" class="nav_logo1">Dashboard</a>                                       

        <ul class="nav_items">
        <li class="nav_item">
            <a href="dashboard.php" class="nav_link">Home</a>                                               
            <a href="#" class="nav_link">Book Registration</a>
            <a href="display_book.php" class="nav_link">Book management</a>
            <p class="my_account">
              <i class="uil uil-user" style="color: #fff;"></i>
              <span style="color: #fff;"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
            </p>
            <button class="button2" id="logoutBtn">Logout</button>
          </li>
        </ul>
      </nav>
    </header>

    
    <div class="container3">
    <div class="title" style="font-size: 38px; color: white; font-weight: 500;">Book Registration</div><br>
        <form action="book_reg.php" method="post" id="book-form" class="form3">
            <label for="book-id"><b>Book ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  eg : Bxxx</b></label>
            <input class="input3" type="text" placeholder="BXXX" name="book_id" id="book-id" required>
            <br>
            <label for="book-name"><b>Book Name:</b></label>
            <input class="input3" type="text" placeholder="Enter book name" name="book_name" id="book-name" required>
            <br>
            <label for="book-category"><b>Book Category:</b></label>
            <select class="select3" name="book_category" id="book-category" required>
                <option value="">Select Category</option>
                <?php
                require 'db.php';

                // Fetch book categories from database
                $category_query = "SELECT * FROM bookcategory";
                $category_result = $conn->query($category_query);

                // Check if there are categories
                if ($category_result->num_rows > 0) {
                    $categories = array();
                    // Store categories in an array
                    while ($row = $category_result->fetch_assoc()) {
                        $categories[] = $row;
                    }
                } else {
                    // If no categories found, you can handle this case accordingly
                    $categories = array(array('category_id' => '', 'category_Name' => 'No categories found'));
                }
    
                
                $conn->close();
    
                // Loop through categories and generate options
                foreach ($categories as $category) {
                    echo "<option value='{$category['category_id']}'>{$category['category_Name']}</option>";
                }
                ?>
            </select>
            <br>
            <button class="button3" type="submit" id="register-btn">Register Book</button>
        </form>
    </div>
    

        <script src="../js/script2.js"></script>
<?php
include_once 'footer.php';
?>
