<?php
include_once 'header.php';
include_once 'db.php';

// Function to validate the book ID format
function validateBookID($book_id) {
    // Regular expression for BXXX format
    $pattern = '/^B\d{3}$/';
    return preg_match($pattern, $book_id);
}

// Function to check if the book ID already exists in the database
function isBookIDUnique($conn, $book_id) {
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM book WHERE book_id = ?");
    $stmt->bind_param("s", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return ($row['count'] == 0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
    $book_id = $_POST['book_id'];
    $new_book_id = $_POST['new_book_id']; 
    $book_name = $_POST['book_name'];
    $category_id = $_POST['category_id'];

    // Validate the new book ID format
    if (!validateBookID($new_book_id)) {
        header('Location:display_book.php?stat=Invalid_book_id_format');
        exit();
    }

    // Check if the new book ID already exists
    if ($book_id !== $new_book_id && !isBookIDUnique($conn, $new_book_id)) {
        header('Location:display_book.php?stat=Book_ID_Already_Exists');
        exit();
    }

    // Update book record in the database
    $stmt = $conn->prepare("UPDATE book SET book_id=?, book_name=?, category_id=? WHERE book_id=?");
    $stmt->bind_param("ssss", $new_book_id, $book_name, $category_id, $book_id);
    $stmt->execute();
    $stmt->close();

    header('Location:display_book.php?stat=Updated_successfully');
    exit();
}

// Fetch book information for display
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM book WHERE book_id = ?");
    $stmt->bind_param("s", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();
    $stmt->close();
}
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
            <button class="button2 add_member_button" onclick="window.location.href='book_form.php'">Add New Book</button>
        </div>
        <section class="table_body">
            <form id="editForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <table>
                    <thead>
                        <tr>
                            <th>Book ID</th>
                            <th>Book Name</th>
                            <th>Book Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="rounded-input1" style="width: 100px;" name="new_book_id" id="new_book_id" value="<?php echo isset($book['book_id']) ? htmlspecialchars($book['book_id']) : ''; ?>" required></td>
                            <td><input type="text" class="rounded-input1" style="width: 350px;" name="book_name" id="book_name" value="<?php echo isset($book['book_name']) ? htmlspecialchars($book['book_name']) : ''; ?>" required></td>
                            <td>
                                <select name="category_id" id="category_id" required class="rounded-select">
                                    <option value="">Select Category</option>
                                    <?php
                                    $category_query = "SELECT category_id, category_Name FROM bookcategory";
                                    $category_result = $conn->query($category_query);
                                    if ($category_result && $category_result->num_rows > 0) {
                                        while ($category_row = $category_result->fetch_assoc()) {
                                            $selected = ($category_row['category_id'] == $book['category_id']) ? 'selected' : '';
                                            echo "<option value='{$category_row['category_id']}' $selected>{$category_row['category_Name']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><a href="#" id="updateLink">Update</a></td>
                        </tr>
                    </tbody>
                </table>
                
                <input type="hidden" name="book_id" value="<?php echo isset($book['book_id']) ? htmlspecialchars($book['book_id']) : ''; ?>">
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
