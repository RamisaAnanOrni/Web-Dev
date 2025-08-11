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
$id = intval($_GET['id'] ?? 0);
$students = $studentObj->getAll();
$student = null;

foreach ($students as $s) {
    if ($s['id'] === $id) {
        $student = $s;
        break;
    }
}

if (!$student) {
    echo "Student not found.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $age = intval($_POST['age'] ?? 0);
    $email = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');

    if ($name && $age && $email && $course) {
        $studentObj->update($id, [
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

<h2>Edit Student</h2>

<?php if ($error): ?>
<p style="color:red;"><?=htmlspecialchars($error)?></p>
<?php endif; ?>

<form method="POST">
    Name: <input type="text" name="name" required value="<?=htmlspecialchars($student['name'])?>"><br><br>
    Age: <input type="number" name="age" required value="<?=htmlspecialchars($student['age'])?>"><br><br>
    Email: <input type="email" name="email" required value="<?=htmlspecialchars($student['email'])?>"><br><br>
    Course: <input type="text" name="course" required value="<?=htmlspecialchars($student['course'])?>"><br><br>
    <button type="submit">Update Student</button>
</form>

<p><a href="students.php">Back to List</a></p>
