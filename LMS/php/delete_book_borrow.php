<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    header("Location:../index.html");
    exit;
}

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $borrow_id = $_GET['id']; 

    // Prepare the SQL DELETE statement
    if ($stmt = $conn->prepare("DELETE FROM bookborrower WHERE borrow_id = ?")) {
        $stmt->bind_param("s", $borrow_id); 

        // Execute the prepared statement
        if ($stmt->execute()) {
            $stmt->close();
            
            // Redirect to the display_borrow_details.php page with a success message
            header("Location:display_borrow_details.php?stat=Borrow_record_Deleted");
            exit();
        } else {
            echo "Error executing query: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
