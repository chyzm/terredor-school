<?php
// Enhanced security session settings
session_start([
    'cookie_lifetime' => 86400,
    'cookie_secure'   => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict'
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

// Get notice ID securely
$notice_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$notice_id) {
    $_SESSION['error'] = "Invalid notice ID";
    header("Location: notices.php");
    exit;
}

// Generate CSRF token if not exists
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF validation
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = "Invalid security token";
        header("Location: edit_notice.php?id=$notice_id");
        exit;
    }

    // Validate and sanitize inputs
    $date = filter_input(INPUT_POST, 'notice_date', FILTER_SANITIZE_STRING);
    $headline = filter_input(INPUT_POST, 'headline', FILTER_SANITIZE_STRING);
    $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);
    $type = filter_input(INPUT_POST, 'notice_type', FILTER_SANITIZE_STRING);
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    
    if (empty($date) || empty($headline) || empty($body)) {
        $_SESSION['error'] = "All fields are required";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE notices SET notice_date = ?, headline = ?, body = ?, notice_type = ?, is_active = ?, updated_at = NOW() WHERE id = ?");
            $stmt->execute([$date, $headline, $body, $type, $is_active, $notice_id]);
            $_SESSION['message'] = "Notice updated successfully!";
            header("Location: notices.php");
            exit;
        } catch (PDOException $e) {
            error_log("Update error: " . $e->getMessage());
            $_SESSION['error'] = "Error updating notice";
        }
    }
}

// Get notice data
try {
    $stmt = $pdo->prepare("SELECT * FROM notices WHERE id = ?");
    $stmt->execute([$notice_id]);
    $notice = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$notice) {
        $_SESSION['error'] = "Notice not found";
        header("Location: notices.php");
        exit;
    }
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    $_SESSION['error'] = "Error loading notice";
    header("Location: notices.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Notice - Terre d'Or School</title>
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
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Edit Notice</h1>
            <div>
                <span class="text-sm text-gray-600 mr-4">Logged in as: <?= htmlspecialchars($_SESSION['admin_username']) ?></span>
                <a href="notices.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                    Back to Notices
                </a>
            </div>
        </div>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        
        <div class="bg-white p-6 rounded-lg shadow-md">
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="notice_date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" id="notice_date" name="notice_date" required
                               value="<?= htmlspecialchars($notice['notice_date']) ?>"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                    </div>
                    
                    <div>
                        <label for="notice_type" class="block text-sm font-medium text-gray-700 mb-1">Notice Type</label>
                        <select id="notice_type" name="notice_type" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                            <option value="general" <?= $notice['notice_type'] === 'general' ? 'selected' : '' ?>>General</option>
                            <option value="event" <?= $notice['notice_type'] === 'event' ? 'selected' : '' ?>>Event</option>
                            <option value="new" <?= $notice['notice_type'] === 'new' ? 'selected' : '' ?>>New</option>
                            <option value="important" <?= $notice['notice_type'] === 'important' ? 'selected' : '' ?>>Important</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label for="headline" class="block text-sm font-medium text-gray-700 mb-1">Headline</label>
                    <input type="text" id="headline" name="headline" required maxlength="255"
                           value="<?= htmlspecialchars($notice['headline']) ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                </div>
                
                <div class="mb-6">
                    <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Body Content</label>
                    <textarea id="body" name="body" rows="6" required
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"><?= htmlspecialchars($notice['body']) ?></textarea>
                </div>
                
                <div class="mb-6 flex items-center">
                    <input type="checkbox" id="is_active" name="is_active"
                           <?= $notice['is_active'] ? 'checked' : '' ?>
                           class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-700">Active Notice</label>
                </div>
                
                <div class="flex justify-end space-x-4">
                    <a href="notices.php" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">
                        Cancel
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-opacity-90 transition">
                        Update Notice
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>