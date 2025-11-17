<?php
include_once 'header.php';
include_once 'db.php';

// Function to validate the borrow ID format
function validateBorrowID($borrow_id) {
    // Regular expression for BXXX format
    $pattern = '/^BR\d{3}$/';
    return preg_match($pattern, $borrow_id);
}

// Function to check if the borrow ID already exists in the database
function isBorrowIDUnique($conn, $borrow_id) {
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM bookborrower WHERE borrow_id = ?");
    $stmt->bind_param("s", $borrow_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return ($row['count'] == 0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['borrow_id'])) {
    // Retrieve data from the form
    $borrow_id = $_POST['borrow_id'];
    $new_borrow_id = $_POST['new_borrow_id'];
    $borrow_status = $_POST['borrow_status'];
    $modified_date = date('Y-m-d');

    // Validate the new book ID format
    if (!validateBorrowID($new_borrow_id)) {
        header('Location:display_borrow_details.php?stat=Invalid_borrow_id_format');
        exit();
    }

    // Check if the new book ID already exists
    if ($borrow_id !== $new_borrow_id && !isBorrowIDUnique($conn, $new_borrow_id)) {
        header('Location:display_borrow_details.php?stat=Borrow_ID_Already_Exists');
        exit();
    }

    // Update book record in the database
    $stmt = $conn->prepare("UPDATE bookborrower SET borrow_id=?, borrow_status=?, borrower_date_modified=? WHERE borrow_id=?");
    $stmt->bind_param("ssss", $new_borrow_id, $borrow_status, $modified_date, $borrow_id);
    $stmt->execute();
    $stmt->close();

    header('Location:display_borrow_details.php?stat=borrow_details_updated_successfully');
    exit();
}

// Fetch book information for display
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $borrow_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM bookborrower WHERE borrow_id = ?");
    $stmt->bind_param("s", $borrow_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $borrow = $result->fetch_assoc();
    $stmt->close();
}
?>
<a href="#" class="nav_logo1">Dashboard</a>                                         

<ul class="nav_items">
    <li class="nav_item">
        <a href="dashboard.php" class="nav_link">Home</a>                                               
        <a href="display_borrow_details.php" class="nav_link">Borrow Details</a>
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
            <h1 class="header_title">Book Details</h1>
            <button class="button2 add_member_button" onclick="window.location.href='book_borrow_details.php'">Add Borrow Details</button>
        </div>
        <section class="table_body">
            <form id="editForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <table>
                    <thead>
                        <tr>
                            <th>Borrow ID</th>
                            <th>Book</th>
                            <th>Borrow Status</th>
                            <th>Modified Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="rounded-input1" name="new_borrow_id" id="new_borrow_id" value="<?php echo isset($borrow['borrow_id']) ? htmlspecialchars($borrow['borrow_id']) : ''; ?>" required></td>
                            <td>
                                <?php
                                // Fetch book name based on book ID
                                $book_query = "SELECT book_name FROM book WHERE book_id=?";
                                $stmt = $conn->prepare($book_query);
                                $stmt->bind_param("s", $borrow['book_id']);
                                $stmt->execute();
                                $stmt->bind_result($book_name);
                                $stmt->fetch();
                                $stmt->close();
                                echo htmlspecialchars($book_name);
                                ?></td>
                            <td>
                                <select type="text" class="rounded-input1" style="height:50px" name="borrow_status" id="borrow_status">
                                    <option value="Available" <?php echo isset($borrow['borrow_status']) && $borrow['borrow_status'] == 'Available' ? 'selected' : ''; ?>>Available</option>
                                    <option value="Borrowed" <?php echo isset($borrow['borrow_status']) && $borrow['borrow_status'] == 'Borrowed' ? 'selected' : ''; ?>>Borrowed</option>
                                </select>
                            </td>
                            <td><input type="text" class="rounded-input1" name="modified_date" id="modified_date" value="<?php echo isset($borrow['borrower_date_modified']) ? htmlspecialchars($borrow['borrower_date_modified']) : ''; ?>"></td>
                            <td><a href="#" id="updateLink">Update</a></td>
                        </tr>
                    </tbody>
                </table>
                
                <input type="hidden" name="borrow_id" value="<?php echo isset($borrow['borrow_id']) ? htmlspecialchars($borrow['borrow_id']) : ''; ?>">
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
