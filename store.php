<?php
require 'includes/config.php';

$student_number = trim($_POST['student_number'] ?? '');
$first_name = trim($_POST['first_name'] ?? '');
$last_name = trim($_POST['last_name'] ?? '');
$course = trim($_POST['course'] ?? '');
$year_level = trim($_POST['year_level'] ?? '');

$error=[];
if ($student_number === '') $error[] = 'Student number is required';
if ($first_name === '') $error[] = 'First name is required';
if ($last_name === '') $error[] = 'Last name is required';
if ($course === '') $error[] = 'Course is required';
if ($year_level === '') $error[] = 'Year level is required';

if (!empty($error)) {
    foreach ($error as $err) {
        echo '<div class="alert alert-danger">'.$err.'</div>';
    }
    echo '<a href="create.php">Go Back</a>';
    exit;
}

$stmt = mysqli_prepare($conn, "INSERT INTO students (student_number, first_name, last_name, course, year_level) VALUES (?, ?, ?, ?, ?)");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ssssi", $student_number, $first_name, $last_name, $course, $year_level);
    $exec = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($exec) {
        header("Location: index.php?msg=created");
        exit;
    } else {
        die("Insert failed: " . mysqli_error($conn));
    }
} else {
    die("Prepare failed: " . mysqli_error($conn));
}

?>