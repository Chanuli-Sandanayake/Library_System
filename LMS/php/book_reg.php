<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    $book_category = $_POST['book_category'];

    // Check if book ID exists
    $stmt = $conn->prepare("SELECT * FROM book WHERE book_id = ?");
    $stmt->bind_param("s", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Book ID exists, redirect with an error message
        header("Location: book_form.php?stat=Book_ID_Already_Exists");
    } else {
        // Book ID does not exist, insert new book
        $stmt = $conn->prepare("INSERT INTO book (book_id, book_name, category_id) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $book_id, $book_name, $book_category);
        
        if ($stmt->execute()) {
            // Success, redirect with a success message
            header("Location: book_form.php?stat=Book_Reg_Succsseful");
        } else {
            // Insert failed, redirect with an error message
            header("Location: book_form.php?stat=error");
        }
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect if not a POST request
    header("Location: book_form.php");
}
?>
