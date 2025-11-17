<?php
include_once 'header.php';
?>


      <a href="#" class="nav_logo1">Dashboard</a>                              <!--TODO ADD -->             

        <ul class="nav_items">
        <li class="nav_item">
            <a href="dashboard.php" class="nav_link">Home</a>                                               
            <a href="display_borrow_details.php" class="nav_link">View Borrow Details</a>
            <a href="book_borrow_details.php" class="nav_link">ADD Borrow Details</a>
            <p class="my_account">
              <i class="uil uil-user" style="color: #fff;"></i>
              <span style="color: #fff;"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
            </p>
            <button class="button2" id="logoutBtn">Logout</button>
          </li>
        </ul>
      </nav>
    </header>
<body>

   
<div style="text-align: center" class="form4">
    <form action="update_borrow_details.php" method="POST">
        <h1 class="heading4"> Borrow books</h1>
        <div class="input-box4">
          <label class="label4">Borrow ID</label>
          <input type="text" name="borrowid" id="borrowid" class="input-box4" placeholder="Enter the Borrow ID eg:BRxxx" required>

          <label class="label4">Book ID</label>
          <input type="text" name="bookid" id="bookid" class="input-box4" placeholder="Enter the Book ID eg:BXXX" required>

          <label class="label4">Member ID</label>
          <input type="text" name="memberid" id="memberid" class="input-box4" placeholder="Enter the Member ID eg:MXXX" required>
        
          <label class="label4">Borrow Status</label>
            <div style="text-align: center" class="container4">
              <select name="borrow-status" class="borrow-status" id="borrow-status">
              <option value="Borrowed" selected="selected">Borrowed</option>
              <option value="Available">Available</option>
              </select>
            </div>
          </div>

          <div class="date2">
          <label class="label4">Modified Date</label> 
          <input type="date" name="currentDate" id="currentDate" class="input-box4" required>
          </div>
          <br>
        
          <div class="borrowBtn">
          <button type="submit" id="borrowButton">Borrow Book</button>
          </div>
      </form>
</div>

  </section>
  <link rel="stylesheet" href="../css/style1.css">
  <script src="../js/script3.js"></script>
  <script>
    document.getElementById("logoutBtn").addEventListener("click", function () {
      alert("You have been logged out!");
      window.location.href = "logout.php";
    });
  </script>
  <script src="../js/alert.js"></script>
  <script>
        AOS.init();
  </script>
</body>

</html>