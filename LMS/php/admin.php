<?php
include_once 'header.php';
include_once 'db.php';
$result = $conn->query("SELECT * FROM user");
?>

        <p class="nav_logo1">Admin Dashboard</p>

        <ul class="nav_items">
          <li class="nav_item">
            <a href="#" class="nav_link">Home</a> 
            <button class="button2" id="logoutBtn">Logout</button>
          </li>
        </ul>
      </nav>
    </header>
  <main class="body1">
    <main class="table" data-aos="zoom-in">        
    <div class="header_container">
      <h1 class="header_title">User List</h1>
      <button class="button2 add_member_button" onclick="window.location.href='add_user.php'">Add New User</button>
    </div>
        <section class="table_body">
          <table>
              <thead>
                  <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th class="pd">Password</th>
                    <th>Actions</th>
                  </tr>
              </thead>
              <tbody>
                <?php while ($user = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td class="pd" ><?php echo htmlspecialchars($user['password']);?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $user['user_id']; ?>">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="delete_user.php?id=<?php echo $user['user_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
              </tbody>
          </table>
        </section>
    </main>
  <main>
<?php
include_once 'footer.php';
?>
?>
<?php
$conn->close();
?>
