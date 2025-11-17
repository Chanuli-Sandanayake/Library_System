<?php
include_once 'header.php';
?>
        <a href="#" class="nav_logo1">Dashboard</a>                              <!--TODO ADD -->             

        <ul class="nav_items">
        <li class="nav_item">
            <a href="dashboard.php" class="nav_link">Home</a>                                               
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

   <!--Your code here--> 
    <div class="container2">
        <div class="title2">Library Member Registration</div>
        <form id="form" class="form" action=register_mem.php method="POST">
            <div class="user-details">
                <div class="input-box">
                    <div class="d1" id="d1">Member ID </div>
                    <input type="text" placeholder="Enter member ID" name="member_id" required>
                    <span style="color: red;" id="member_id_error"></span>
                </div>
                <div class="input-box">
                    <div class="d2" id="d2">First Name </div>
                    <input type="text" placeholder="Enter First Name" name="first_name" required>
                </div>
                <div class="input-box">
                    <div class="d3" id="d3">Last Name </div>
                    <input type="text" placeholder="Enter Last Name" name="last_name" required>
                </div>
                <div class="input-box">
                    <div class="d4" id="d4">Birthday</div>
                    <input type="date" placeholder="Enter Birthday" name="birthday" required>
                </div>
                <div class="input-box">
                    <div class="d5" id="d5">Email</div>
                    <input type="email" placeholder="Enter Email" name="email"required>
                    <span style="color: red;" id="email_error"></span>
                </div>
                <div class="button">
                    <input type="submit" name="reg" value="Register">
                </div>
            </div>

        </form> 

    </div>
    <script src="../js/script1.js"></script>

<?php
include_once 'footer.php';
?>
