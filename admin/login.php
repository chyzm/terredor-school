<?php
// Security Note 1: Always start sessions securely
session_start([
    'cookie_lifetime' => 86400, // 1 day
    'cookie_secure'   => true,  // Requires HTTPS
    'cookie_httponly' => true,  // Prevent JavaScript access
    'cookie_samesite' => 'Strict' // CSRF protection
]);

require_once '../config/db.php';

// Security Note 2: Redirect if already logged in
if (isset($_SESSION['admin_logged_in'])) {
    header('Location: notices.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    // Input validation
    if (empty($username) || empty($password)) {
        $error = "Please enter both username and password";
    } else {
        // Prepared statement with parameterized queries
        $stmt = $pdo->prepare("SELECT id, username, password FROM admin_users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            // Regenerate session ID
            session_regenerate_id(true);
            
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
            
            // Remember me functionality
            if ($remember) {
                $token = bin2hex(random_bytes(32));
                $hashedToken = hash('sha256', $token);
                $expiry = time() + 86400 * 30; // 30 days
                
                setcookie('remember_token', $token, $expiry, '/', '', true, true);
                
                $pdo->prepare("INSERT INTO auth_tokens (user_id, token_hash, expires_at) VALUES (?, ?, ?)")
                    ->execute([$user['id'], $hashedToken, date('Y-m-d H:i:s', $expiry)]);
            }
            
            header('Location: notices.php');
            exit;
        } else {
            $error = "Invalid username or password";
            error_log("Failed login attempt for username: $username from IP: " . $_SERVER['REMOTE_ADDR']);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Terre d'Or School</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 5vh;
        }
        .login-logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-logo img {
            height: 80px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="login-container">
        <div class="login-logo">
            <img src="../images/logo.png" alt="Terre d'Or Logo">
            <h2 class="text-2xl font-bold mt-2">Admin Portal</h2>
        </div>
        
        <div class="bg-white p-8 rounded-lg shadow-md">
            <?php if (isset($error)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="login.php">
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" id="username" name="username" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                </div>
                
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                </div>
                
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember"
                               class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>
                    
                    <!--<a href="forgot_password.php" class="text-sm text-primary hover:underline">Forgot password?</a>-->
                </div>
                
                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-opacity-90 transition">
                    Sign In
                </button>
            </form>
        </div>
        
        <div class="mt-4 text-center text-sm text-gray-600">
            © <?php echo date('Y'); ?> Terre d'Or School. All rights reserved.
        </div>
    </div>
</body>
</html>