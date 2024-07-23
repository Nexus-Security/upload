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

// File upload code
if (isset($_FILES['fileToUpload'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
