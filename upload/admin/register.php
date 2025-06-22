<?php
// Secure session settings
session_start([
    'cookie_lifetime' => 86400,
    'cookie_secure'   => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict'
]);

require_once '../config/db.php';

// Redirect if already logged in
if (isset($_SESSION['admin_logged_in'])) {
    header('Location: notices.php');
    exit;
}

// Only allow registration if there are no existing admin users (first-time setup)
try {
    $userCount = $pdo->query("SELECT COUNT(*) FROM admin_users")->fetchColumn();
    if ($userCount > 0) {
        header('Location: login.php?error=registration_disabled');
        exit;
    }
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    die("System error. Please try again later.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Input validation
    $errors = [];
    
    if (empty($username)) {
        $errors[] = "Username is required";
    } elseif (strlen($username) < 4) {
        $errors[] = "Username must be at least 4 characters";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $errors[] = "Username can only contain letters, numbers and underscores";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters";
    } elseif ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }
    
    if (empty($errors)) {
        try {
            // Check if username already exists
            $stmt = $pdo->prepare("SELECT id FROM admin_users WHERE username = ?");
            $stmt->execute([$username]);
            
            if ($stmt->fetch()) {
                $errors[] = "Username already exists";
            } else {
                // Hash password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                // Insert new user
                $stmt = $pdo->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?)");
                $stmt->execute([$username, $hashedPassword]);
                
                // Auto-login the new user
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_user_id'] = $pdo->lastInsertId();
                $_SESSION['admin_username'] = $username;
                $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
                
                header('Location: notices.php');
                exit;
            }
        } catch (PDOException $e) {
            error_log("Registration error: " . $e->getMessage());
            $errors[] = "Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration - Terre d'Or School</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .registration-container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 5vh;
        }
        .registration-logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        .registration-logo img {
            height: 80px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="registration-container">
        <div class="registration-logo">
            <img src="../images/logo.png" alt="Terre d'Or Logo">
            <h2 class="text-2xl font-bold mt-2">Admin Registration</h2>
            <p class="text-sm text-gray-600 mt-1">Create the first admin account</p>
        </div>
        
        <div class="bg-white p-8 rounded-lg shadow-md">
            <?php if (!empty($errors)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="register.php">
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" id="username" name="username" required minlength="4"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                           value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>">
                </div>
                
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" required minlength="8"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                    <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
                </div>
                
                <div class="mb-6">
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required minlength="8"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                </div>
                
                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-opacity-90 transition">
                    Register Admin Account
                </button>
            </form>
            
            <div class="mt-4 text-center text-sm text-gray-600">
                Already have an account? <a href="login.php" class="text-blue-500 hover:underline">Login here</a>
            </div>
        </div>
        
        <div class="mt-4 text-center text-sm text-gray-600">
            © <?php echo date('Y'); ?> Terre d'Or School. All rights reserved.
        </div>
    </div>
</body>
</html>