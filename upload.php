<?php
session_start();

$correct_password = 'hog63h'; // Set your desired password here

if (isset($_POST['password']) && $_POST['password'] === $correct_password) {
    $_SESSION['authenticated'] = true;
}

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    echo '<form method="post">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" value="Submit">
          </form>';
    exit;
}

// Ensure the uploads directory exists
$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    if (!mkdir($target_dir, 0755, true)) {
        die("Failed to create directories.");
    }
}

// File upload code
if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == UPLOAD_ERR_OK) {
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    if (isset($_FILES['fileToUpload'])) {
        echo "Error uploading file: " . $_FILES['fileToUpload']['error'];
    }
}
?>
