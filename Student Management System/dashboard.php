<?php
require_once "classes/SessionManager.php";
SessionManager::start();

if (!SessionManager::isLoggedIn()) {
    header("Location: login.php");
    exit;
}
?>

<h2>Dashboard</h2>
<p>Welcome, <?=htmlspecialchars($_SESSION['user'])?>!</p>

<p>
    <a href="students.php">Manage Students</a> | 
    <a href="logout.php">Logout</a>
</p>
