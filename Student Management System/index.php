<?php
require_once "classes/SessionManager.php";
SessionManager::start();

if (SessionManager::isLoggedIn()) {
    header("Location: dashboard.php");
} else {
    header("Location: login.php");
}
exit;
