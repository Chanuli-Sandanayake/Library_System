<?php
include_once 'header.php';
include 'db.php';

// Function to validate the member ID format
function validateMemberID($member_id) {
    // Regular expression for MXXX format
    $pattern = '/^M\d{3}$/';
    return preg_match($pattern, $member_id);
}

// Function to check if the member ID already exists in the database
function isMemberIDUnique($conn, $member_id) {
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM member WHERE member_id = ?");
    $stmt->bind_param("s", $member_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return ($row['count'] == 0);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['member_id'])) {
    // Retrieve form data
    $member_id = $_POST['member_id'];
    $new_member_id = $_POST['new_member_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];

    // Validate the new member ID format
    if (!validateMemberID($new_member_id)) {
        // Redirect back with an error message if the member ID format is invalid
        header('Location:display_member.php?stat=Invalid_member_id_format');
        exit();
    }

    // Check if the new member ID already exists
    if ($member_id !== $new_member_id && !isMemberIDUnique($conn, $new_member_id)) {
        // Redirect back with an error message if the new member ID already exists
        header('Location:display_member.php?stat=Member_id_already_exists');
        exit();
    }
    
    // Update user record in the database
    $stmt = $conn->prepare("UPDATE member SET member_id=?, first_name=?, last_name=?, birthday=?, email=? WHERE member_id=?");
    $stmt->bind_param("ssssss", $new_member_id, $first_name, $last_name, $birthday, $email, $member_id);
    $stmt->execute();
    $stmt->close();

    header('Location:display_member.php?stat=Updated_member_successfully');
    exit();
}

// Fetch user information for display
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $member_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM member WHERE member_id = ?");
    $stmt->bind_param("s", $member_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $member = $result->fetch_assoc();
    $stmt->close();
}
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
<main class="body1">
    <main class="table" data-aos="zoom-in">
        <div class="header_container">
            <h1 class="header_title">Library Members</h1>
            <button class="button2 add_member_button" onclick="window.location.href='display_member.php'">View Member List</button>
            <button class="button2 add_member_button" onclick="window.location.href='signup_mem.php'">Add New Member</button>
        </div>
        <section class="table_body">
            <form id="editForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <table>
                    <thead>
                        <tr>
                            <th>Member ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Birthday</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="rounded-input1" name="new_member_id" id="new_member_id" value="<?php echo isset($member['member_id']) ? htmlspecialchars($member['member_id']) : ''; ?>" required></td>
                            <td><input type="text" class="rounded-input1" name="first_name" id="first_name" value="<?php echo isset($member['first_name']) ? htmlspecialchars($member['first_name']) : ''; ?>" required></td>
                            <td><input type="text" class="rounded-input1" name="last_name" id="last_name" value="<?php echo isset($member['last_name']) ? htmlspecialchars($member['last_name']) : ''; ?>" required></td>
                            <td><input type="date" class="rounded-input1" name="birthday" id="birthday" value="<?php echo isset($member['birthday']) ? htmlspecialchars($member['birthday']) : ''; ?>" required></td>
                            <td><input type="email" class="rounded-input1" name="email" id="email" value="<?php echo isset($member['email']) ? htmlspecialchars($member['email']) : ''; ?>" required></td>
                            <td><a href="#" id="updateLink">Update</a></td>
                        </tr>
                    </tbody>
                </table>
                <!-- Include the original member_id for reference -->
                <input type="hidden" name="member_id" value="<?php echo isset($member['member_id']) ? htmlspecialchars($member['member_id']) : ''; ?>">
            </form>
        </section>
    </main>
</main>
  
  <script>
    document.getElementById("updateLink").addEventListener("click", function(event) {
        event.preventDefault();
        document.getElementById('editForm').submit();
    });
  </script>


<?php
include_once 'footer.php';
$conn->close();
?>
