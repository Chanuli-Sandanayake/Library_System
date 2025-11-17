<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_name'])) {
    header("Location:../index.html");
    exit;
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM user WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);

    if ($stmt->execute()) {
        header("Location:admin.php?stat=Deleted");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}arlet
?>
<script src="../js/alert.js"></script>
<?php
$conn->close();
?>

