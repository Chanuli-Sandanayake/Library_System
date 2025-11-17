<?php
include_once 'header.php';
include_once 'db.php';

$result = $conn->query("SELECT * FROM member");
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
      <button class="button2 add_member_button" onclick="window.location.href='signup_mem.php'">Add New Member</button>
    </div>
    <section class="table_body">
      <table>
        <thead>
          <tr>
            <th>Member ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Birthday</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($member = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo htmlspecialchars($member['member_id']); ?></td>
            <td><?php echo htmlspecialchars($member['first_name']); ?></td>
            <td><?php echo htmlspecialchars($member['last_name']); ?></td>
            <td><?php echo htmlspecialchars($member['birthday']); ?></td>
            <td><?php echo htmlspecialchars($member['email']); ?></td>
            <td>
            <a href="update_member.php?id=<?php echo $member['member_id']; ?>">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="delete_member.php?id=<?php echo $member['member_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
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
$conn->close();
?>


