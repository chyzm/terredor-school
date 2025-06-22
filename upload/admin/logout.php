<?php
// Secure session settings
session_start([
    'cookie_lifetime' => 86400,
    'cookie_secure'   => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict'
]);

require_once '../config/db.php';

// Unset all session variables
$_SESSION = array();

// Delete remember token if exists
if (isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];
    $hashedToken = hash('sha256', $token);
    
    try {
        $pdo->prepare("DELETE FROM auth_tokens WHERE token_hash = ?")->execute([$hashedToken]);
    } catch (PDOException $e) {
        error_log("Token deletion error: " . $e->getMessage());
    }
    
    // Delete the cookie
    setcookie('remember_token', '', time() - 3600, '/', '', true, true);
}

// Destroy the session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

session_destroy();

// Redirect to login page
header("Location: login.php");
exit;
?>