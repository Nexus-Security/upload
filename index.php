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

// Handle file deletion
if (isset($_POST['delete_file'])) {
    $file_to_delete = $_POST['file_to_delete'];
    $file_path = "uploads/" . $file_to_delete;

    if (file_exists($file_path)) {
        unlink($file_path);
        echo "<p>File '$file_to_delete' has been deleted.</p>";
    } else {
        echo "<p>File '$file_to_delete' does not exist.</p>";
    }
}

// Function to format file size
function formatSize($bytes) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $power = $bytes > 0 ? floor(log($bytes, 1024)) : 0;
    return number_format($bytes / (1 << (10 * $power)), 2) . ' ' . $units[$power];
}

// Function to get drive size
function getDriveSize() {
    $totalSpace = disk_total_space("/");
    $freeSpace = disk_free_space("/");
    $usedSpace = $totalSpace - $freeSpace;

    return [
        'total' => formatSize($totalSpace),
        'free' => formatSize($freeSpace),
        'used' => formatSize($usedSpace)
    ];
}

// Get drive size
$driveSize = getDriveSize();

// List files in the uploads directory
$files = array_diff(scandir('uploads'), array('.', '..'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        form {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h1>File Dashboard</h1>

    <h2>Drive Information</h2>
    <p>Total Drive Size: <?php echo $driveSize['total']; ?></p>
    <p>Used Space: <?php echo $driveSize['used']; ?></p>
    <p>Free Space: <?php echo $driveSize['free']; ?></p>

    <h2>File List</h2>
    <table>
        <thead>
            <tr>
                <th>File Name</th>
                <th>Size</th>
                <th>Date Modified</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as $file): ?>
                <?php $filePath = "uploads/" . $file; ?>
                <tr>
                    <td><?php echo htmlspecialchars($file); ?></td>
                    <td><?php echo formatSize(filesize($filePath)); ?></td>
                    <td><?php echo date("Y-m-d H:i:s", filemtime($filePath)); ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="file_to_delete" value="<?php echo htmlspecialchars($file); ?>">
                            <input type="submit" name="delete_file" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
