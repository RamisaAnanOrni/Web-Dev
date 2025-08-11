<?php
require_once "classes/SessionManager.php";
require_once "classes/Student.php";

SessionManager::start();

if (!SessionManager::isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$id = intval($_GET['id'] ?? 0);

if ($id > 0) {
    $studentObj = new Student('students.json');
    $studentObj->delete($id);
}

header("Location: students.php");
exit;
