<?php
include_once 'db.php'; // Ensure this file includes your database connection setup

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $borrow_id = $_POST['borrowid'];
    $book_id = $_POST['bookid'];
    $member_id = $_POST['memberid'];
    $borrow_status = $_POST['borrow-status'];
    $modified_date = $_POST['currentDate'];

    // Validate form data on the server side
    $borrowIDPattern = '/^BR\d{3}$/';
    $bookIDPattern = '/^B\d{3}$/';
    $memberIDPattern = '/^M\d{3}$/';

    if (!preg_match($borrowIDPattern, $borrow_id)) {
        header("Location: book_borrow_details.php?stat=Invalid_Borrow_ID_format.");
        exit();
    }

    if (!preg_match($bookIDPattern, $book_id)) {
        header("Location: book_borrow_details.php?stat=Invalid_Book_ID_format.");
        exit();
    }

    if (!preg_match($memberIDPattern, $member_id)) {
        header("Location: book_borrow_details.php?stat=Invalid_Member_ID_format.");
        exit();
    }

    // Step 1: Check if Borrow ID exists in the bookborrower table
    $borrowIDCheckStmt = $conn->prepare("SELECT borrow_status FROM bookborrower WHERE borrow_id = ?");
    $borrowIDCheckStmt->bind_param("s", $borrow_id);
    $borrowIDCheckStmt->execute();
    $borrowIDCheckStmt->store_result();

    if ($borrowIDCheckStmt->num_rows > 0) {
        header("Location: book_borrow_details.php?stat=Borrow_ID_Already_Exists");

    } else {
        // Step 2: Borrow ID does not exist, check Member ID and Book ID
        $borrowIDCheckStmt->close();

        // Check if Book ID exists in the book table
        $bookExistsStmt = $conn->prepare("SELECT book_id FROM book WHERE book_id = ?");
        $bookExistsStmt->bind_param("s", $book_id);
        $bookExistsStmt->execute();
        $bookExistsStmt->store_result();

        if ($bookExistsStmt->num_rows == 0) {
            header("Location: book_borrow_details.php?stat=Book_ID_does_not_exist");
            exit();
        }
        $bookExistsStmt->close();

        // Check if Book is already borrowed
        $bookBorrowedStmt = $conn->prepare("SELECT borrow_status FROM bookborrower WHERE book_id = ? AND borrow_status = 'borrowed'");
        $bookBorrowedStmt->bind_param("s", $book_id);
        $bookBorrowedStmt->execute();
        $bookBorrowedStmt->store_result();

        if ($bookBorrowedStmt->num_rows > 0) {
            header("Location: book_borrow_details.php?stat=Book_already_borrowed");
            exit();
        }
        $bookBorrowedStmt->close();

        // Check if Member ID exists in the member table
        $memberExistsStmt = $conn->prepare("SELECT member_id FROM member WHERE member_id = ?");
        $memberExistsStmt->bind_param("s", $member_id);
        $memberExistsStmt->execute();
        $memberExistsStmt->store_result();

        if ($memberExistsStmt->num_rows == 0) {
            header("Location: book_borrow_details.php?stat=Member_ID_does_not_exist");
            exit();
        }
        $memberExistsStmt->close();

        // Insert new borrow record
        $stmt = $conn->prepare("INSERT INTO bookborrower (borrow_id, book_id, member_id, borrow_status, borrower_date_modified) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $borrow_id, $book_id, $member_id, $borrow_status, $modified_date);

        if ($stmt->execute()) {
            header("Location: book_borrow_details.php?stat=Record_added_successfully");
        } else {
            header("Location: book_borrow_details.php?stat=Error_adding_record" . $stmt->error);
        }

        $stmt->close();
    }

    $conn->close();
} else {
    echo "Invalid request method";
}
?>
