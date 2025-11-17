<?php
include_once 'header.php';
include 'db.php';

// Function to validate the user ID format
function validateUserID($user_id) {
    // Regular expression for UXXX format
    $pattern = '/^U\d{3}$/';
    return preg_match($pattern, $user_id);
}

// Function to check if the user ID already exists in the database
function isUserIDUnique($conn, $user_id) {
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM user WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return ($row['count'] == 0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    // Retrieve form data
    $user_id = $_POST['user_id'];
    $new_user_id = $_POST['new_user_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Validate the new user ID format
    if (!validateUserID($new_user_id)) {
        // Redirect back with an error message if the user ID format is invalid
        header('Location:admin.php?stat=Invalid_user_id_format');
        exit();
    }

    // Check if the new user ID already exists
    if ($user_id !== $new_user_id && !isUserIDUnique($conn, $new_user_id)) {
        // Redirect back with an error message if the new user ID already exists
        header('Location:admin.php?stat=User_id_already_exists');
        exit();
    }

    // Update user record in the database
    $stmt = $conn->prepare("UPDATE user SET user_id=?, first_name=?, last_name=?, username=?, email=? WHERE user_id=?");
    $stmt->bind_param("ssssss", $new_user_id, $firstname, $lastname, $username, $email, $user_id);
    $stmt->execute();
    $stmt->close();

    header('Location:admin.php?stat=Updated_successfully');
    exit();
}

// Fetch user information for display
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM user WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
}
?>


        <p class="nav_logo1">Admin Dashboard</p>
        <ul class="nav_items">
          <li class="nav_item">
            <a href="admin.php" class="nav_link">Home</a> 
            <button class="button2" id="logoutBtn">Logout</button>
          </li>
        </ul>
      </nav>
    </header>
  <main class="body1">
    <main class="table" data-aos="zoom-in">
        <div class="header_container">
            <h1 class="header_title">User Management</h1>
            <button class="button2 add_member_button" onclick="window.location.href='admin.php'">View User Details</button>
            <button class="button2 add_member_button" onclick="window.location.href='add_user.php'">Add New User</button>
        </div>
        <section class="table_body">
            <form id="editForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="rounded-input1" name="new_user_id" id="new_user_id" value="<?php echo isset($user['user_id']) ? htmlspecialchars($user['user_id']) : ''; ?>" required></td>
                            <td><input type="text" class="rounded-input1" name="firstname" id="firstname" value="<?php echo isset($user['first_name']) ? htmlspecialchars($user['first_name']) : ''; ?>" required></td>
                            <td><input type="text" class="rounded-input1" name="lastname" id="lastname" value="<?php echo isset($user['last_name']) ? htmlspecialchars($user['last_name']) : ''; ?>" required></td>
                            <td><input type="text" class="rounded-input1" name="username" id="username" value="<?php echo isset($user['username']) ? htmlspecialchars($user['username']) : ''; ?>" required></td>
                            <td><input type="email" class="rounded-input1" name="email" id="email" value="<?php echo isset($user['email']) ? htmlspecialchars($user['email']) : ''; ?>" required></td>
                            <td><a href="#" id="updateLink">Update</a></td>
                        </tr>
                    </tbody>
                </table>
                <!-- Include the original user_id for reference -->
                <input type="hidden" name="user_id" value="<?php echo isset($user['user_id']) ? htmlspecialchars($user['user_id']) : ''; ?>">
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
