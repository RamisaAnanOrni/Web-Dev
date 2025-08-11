<?php
require_once "classes/SessionManager.php";
require_once "classes/User.php";

SessionManager::start();

if (SessionManager::isLoggedIn()) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = new User('users.json');
    if ($user->authenticate($username, $password)) {
        SessionManager::login($username);
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<h2>Login</h2>

<?php if ($error): ?>
<p style="color:red;"><?=htmlspecialchars($error)?></p>
<?php endif; ?>

<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>
