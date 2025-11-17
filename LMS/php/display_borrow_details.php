<?php
include_once 'header.php';
include_once 'db.php';

// Fetch all Books and store them in an associative array
$Books = [];
$Book_query = "SELECT book_id, book_name FROM book";
$Book_result = $conn->query($Book_query);
if ($Book_result && $Book_result->num_rows > 0) {
    while ($Book_row = $Book_result->fetch_assoc()) {
        $Books[$Book_row['book_id']] = $Book_row['book_name'];
    }
}
// Fetch all Members and store them in an associative array
$members = [];
$member_query = "SELECT member_id, first_name FROM member";
$member_result = $conn->query($member_query);
if ($member_result && $member_result->num_rows > 0) {
    while ($member_row = $member_result->fetch_assoc()) {
        $members[$member_row['member_id']] = $member_row['first_name'];
    }
}


// Fetch all bookborrower
$result = $conn->query("SELECT * FROM bookborrower");
?>

<a href="#" class="nav_logo1">Dashboard</a>                                         

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
<main class="body1">
  <main class="table" data-aos="zoom-in">
    <div class="header_container">
      <h1 class="header_title">Book Borrow Details</h1>
    </div>
    <section class="table_body">
      <table>
        <thead>
          <tr>
            <th>Borrow ID</th>
            <th>Book ID</th>
            <th>Member Who Borrowed</th>
            <th>Member ID</th>
            <th>Book Name </th>
            <th>Borrow Status</th>
            <th>Date Modified</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['borrow_id']); ?>
            </td>
            <td><?php echo htmlspecialchars($row['book_id']); ?>
            </td>
            <td><?php
              $member_id = $row['member_id'];
              if (isset($members[$member_id])) {
                  echo htmlspecialchars($members[$member_id]);
              } else {
                  echo "member not found";
              }
              ?>
            </td>
            <td><?php echo htmlspecialchars($row['member_id']); ?>
            </td>
            <td><?php
              $book_id = $row['book_id'];
              if (isset($Books[$book_id])) {
                  echo htmlspecialchars($Books[$book_id]);
              } else {
                  echo "Book not found";
              }
              ?>
            </td>
            <td>
              <?php echo htmlspecialchars($row['borrow_status']); ?>
            </td>
            <td>
              <?php echo htmlspecialchars($row['borrower_date_modified']); ?>
            </td>
            <td>
              <a href="edit_book_borrow.php?id=<?php echo htmlspecialchars($row['borrow_id']); ?>">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="delete_book_borrow.php?id=<?php echo htmlspecialchars($row['borrow_id']); ?>" onclick="return confirm('Are you sure?')">Delete</a>
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
