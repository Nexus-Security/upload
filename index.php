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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Page</title>
</head>
<body>
    <h1>Upload File</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload File" name="submit">
    </form>
</body>
</html>
