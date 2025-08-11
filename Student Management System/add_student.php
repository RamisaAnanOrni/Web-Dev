<?php
require_once "classes/SessionManager.php";
require_once "classes/Student.php";

SessionManager::start();

if (!SessionManager::isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$studentObj = new Student('students.json');
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $age = intval($_POST['age'] ?? 0);
    $email = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');

    if ($name && $age && $email && $course) {
        $studentObj->add([
            'name' => $name,
            'age' => $age,
            'email' => $email,
            'course' => $course
        ]);
        header("Location: students.php");
        exit;
    } else {
        $error = "All fields are required.";
    }
}
?>

<h2>Add Student</h2>

<?php if ($error): ?>
<p style="color:red;"><?=htmlspecialchars($error)?></p>
<?php endif; ?>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Age: <input type="number" name="age" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Course: <input type="text" name="course" required><br><br>
    <button type="submit">Add Student</button>
</form>

<p><a href="students.php">Back to List</a></p>
