<?php
// Enhanced security session settings
session_start([
    'cookie_lifetime' => 86400, // 1 day
    'cookie_secure'   => true,  // Requires HTTPS
    'cookie_httponly' => true,  // Prevent JavaScript access
    'cookie_samesite' => 'Strict' // CSRF protection
]);

require_once '../config/db.php';

// Authentication check with session validation
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Session hijacking protection
if ($_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR'] || 
    $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
    session_destroy();
    header('Location: login.php?error=session_invalid');
    exit;
}

// Generate CSRF token if not exists
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF validation
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = "Invalid security token";
        header("Location: notices.php");
        exit;
    }

    if (isset($_POST['add_notice'])) {
        // Validate and sanitize inputs
        $date = filter_input(INPUT_POST, 'notice_date', FILTER_SANITIZE_STRING);
        $headline = filter_input(INPUT_POST, 'headline', FILTER_SANITIZE_STRING);
        $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);
        $type = filter_input(INPUT_POST, 'notice_type', FILTER_SANITIZE_STRING);
        
        if (empty($date) || empty($headline) || empty($body)) {
            $_SESSION['error'] = "All fields are required";
        } else {
            try {
                $stmt = $pdo->prepare("INSERT INTO notices (notice_date, headline, body, notice_type, created_by) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$date, $headline, $body, $type, $_SESSION['admin_user_id']]);
                $_SESSION['message'] = "Notice added successfully!";
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                $_SESSION['error'] = "Error saving notice";
            }
        }
    } elseif (isset($_POST['update_notice'])) {
        // Similar validation for update...
    }
    
    header("Location: notices.php");
    exit;
}

// Handle delete action
if (isset($_GET['delete'])) {
    $id = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_INT);
    if ($id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM notices WHERE id = ?");
            $stmt->execute([$id]);
            $_SESSION['message'] = "Notice deleted successfully!";
        } catch (PDOException $e) {
            error_log("Delete error: " . $e->getMessage());
            $_SESSION['error'] = "Error deleting notice";
        }
    }
    header("Location: notices.php");
    exit;
}

// Get all notices
// Get all notices with improved error handling
// Get all notices
$notices = $pdo->query("SELECT * FROM notices ORDER BY notice_date DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Notices - Terre d'Or School</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .notice-type-general { background-color: #f3f4f6; color: #374151; }
        .notice-type-event { background-color: #d1fae5; color: #065f46; }
        .notice-type-new { background-color: #dbeafe; color: #1e40af; }
        .notice-type-important { background-color: #fee2e2; color: #b91c1c; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Manage Notice Board</h1>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">Logged in as: <?= htmlspecialchars($_SESSION['admin_username']) ?></span>
                <a href="logout.php" class="text-sm text-red-600 hover:underline">Logout</a>
               
            </div>
        </div>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?= htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Add Notice Form -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h2 class="text-xl font-semibold mb-4">Add New Notice</h2>
            <form method="POST" action="notices.php">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="notice_date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" id="notice_date" name="notice_date" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                    </div>
                    <div>
                        <label for="notice_type" class="block text-sm font-medium text-gray-700 mb-1">Notice Type</label>
                        <select id="notice_type" name="notice_type" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                            <option value="general">General</option>
                            <option value="event">Event</option>
                            <option value="new">New</option>
                            <option value="important">Important</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="headline" class="block text-sm font-medium text-gray-700 mb-1">Headline</label>
                    <input type="text" id="headline" name="headline" required maxlength="255"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                </div>
                
                <div class="mb-4">
                    <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Body</label>
                    <textarea id="body" name="body" rows="4" required
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"></textarea>
                </div>
                
                <button type="submit" name="add_notice" 
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                    Add Notice
                </button>
            </form>
        </div>
        
        <!-- Notices List -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Current Notices</h2>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Headline</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($notices as $notice): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><?= date('M j, Y', strtotime($notice['notice_date'])) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full notice-type-<?= $notice['notice_type'] ?>">
                                    <?= ucfirst($notice['notice_type']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($notice['headline']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($notice['author'] ?? 'System') ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?= $notice['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                    <?= $notice['is_active'] ? 'Active' : 'Inactive' ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="edit_notice.php?id=<?= $notice['id'] ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <a href="notices.php?delete=<?= $notice['id'] ?>" class="text-red-600 hover:text-red-900" 
                                   onclick="return confirm('Are you sure you want to delete this notice?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>