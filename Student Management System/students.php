<?php
require_once "classes/SessionManager.php";
require_once "classes/Student.php";

SessionManager::start();

if (!SessionManager::isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$studentObj = new Student('students.json');
$students = $studentObj->getAll();
?>

<h2>Students List</h2>
<p><a href="add_student.php">Add New Student</a> | <a href="dashboard.php">Dashboard</a> | <a href="logout.php">Logout</a></p>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th><th>Name</th><th>Age</th><th>Email</th><th>Course</th><th>Actions</th>
    </tr>
    <?php foreach ($students as $s): ?>
    <tr>
        <td><?=htmlspecialchars($s['id'])?></td>
        <td><?=htmlspecialchars($s['name'])?></td>
        <td><?=htmlspecialchars($s['age'])?></td>
        <td><?=htmlspecialchars($s['email'])?></td>
        <td><?=htmlspecialchars($s['course'])?></td>
        <td>
            <a href="edit_student.php?id=<?=urlencode($s['id'])?>">Edit</a> | 
            <a href="delete_student.php?id=<?=urlencode($s['id'])?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
