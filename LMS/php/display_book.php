<?php
include_once 'header.php';
include_once 'db.php';

// Fetch all categories and store them in an associative array
$categories = [];
$category_query = "SELECT category_id, category_Name FROM bookcategory";
$category_result = $conn->query($category_query);
if ($category_result && $category_result->num_rows > 0) {
    while ($category_row = $category_result->fetch_assoc()) {
        $categories[$category_row['category_id']] = $category_row['category_Name'];
    }
}

// Fetch all books
$result = $conn->query("SELECT * FROM book");
?>

<a href="#" class="nav_logo1">Dashboard</a>                                         

<ul class="nav_items">
<li class="nav_item">
    <a href="dashboard.php" class="nav_link">Home</a>                                               
    <a href="book_form.php" class="nav_link">Book Registration</a>
    <a href="display_book.php" class="nav_link">Book Management</a>
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
      <h1 class="header_title">Book Details</h1>
      <button class="button2 add_book_button" onclick="window.location.href='book_form.php'">Add New Book</button>
    </div>
    <section class="table_body">
      <table>
        <thead>
          <tr>
            <th>Book ID</th>
            <th>Book Title</th>
            <th>Book Category </th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['book_id']); ?></td>
            <td><?php echo htmlspecialchars($row['book_name']); ?></td>
            <td>
              <?php
              $category_id = $row['category_id'];
              if (isset($categories[$category_id])) {
                  echo htmlspecialchars($categories[$category_id]);
              } else {
                  echo "Category not found";
              }
              ?>
            </td>
            <td>
              <a href="update_book.php?id=<?php echo htmlspecialchars($row['book_id']); ?>">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="delete_book.php?id=<?php echo htmlspecialchars($row['book_id']); ?>" onclick="return confirm('Are you sure?')">Delete</a>
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
