<?php
include_once 'header.php';
?>
        <a href="#" class="nav_logo1">Dashboard</a>                              <!--TODO ADD -->             

        <ul class="nav_items">
        <li class="nav_item">
            <a href="#" class="nav_link">Home</a>                                               
            <a href="signup_mem.php" class="nav_link">Member Registration</a>
            <a href="display_member.php" class="nav_link">Member Management</a>
            <p class="my_account">
              <i class="uil uil-user" style="color: #fff;"></i>
              <span style="color: #fff;"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
            </p>
            <button class="button2" id="logoutBtn">Logout</button>
          </li>
        </ul>
      </nav>
    </header>

    <div class="header2">
      <div class="side-nav">
        <div>
          <ul>
            <br>
            <li class="li"><a href="display_borrow_details.php" class="Admin">View Book Borrow Details</a></li>
            <li class="li"><a href="book_borrow_details.php" class="Admin">Add Borrow Details</a></li>
            <li class="li"><a href="book_form.php" class="Admin">Book Registration</a></li>
            <li class="li"><a href="display_book.php" class="Admin">Book Management</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container" data-aos="zoom-in">                                  <!--TODO ADD -->



<h1 style="font-size: 50px; font-family: cursive;margin-right: 40%">Welcome to Our Library Management System</h1><br>

<p style="font-size: 20px">Welcome to our Library Management System, your comprehensive solution for managing library
 resources and providing an efficient service to users. Our platform is designed to cater to the needs of librarians to manage resources.</p>

<?php
include_once 'footer.php';
?>
