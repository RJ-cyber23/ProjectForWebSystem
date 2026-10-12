<?php
require 'includes/config.php';
require 'includes/header.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    echo '<div class="alert alert-danger">Invalid ID</div>';
    require 'includes/footer.php';
    exit;
}
$sql = "SELECT * FROM students WHERE id = $id LIMIT 1";
$res = mysqli_query($conn, $sql);
if ($res && mysqli_num_rows($res) === 1) {
    $row = mysqli_fetch_assoc($res);
    ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Student Details</h5>
            <p><strong>Student Number:</strong> <?= htmlspecialchars($row['student_number']) ?></p>
            <p><strong>Name:</strong> <?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></p>
            <p><strong>Course:</strong> <?= htmlspecialchars($row['course']) ?></p>
            <p><strong>Year Level:</strong> <?= htmlspecialchars($row['year_level']) ?></p>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <?php
} else {
    echo '<div class="alert alert-warning">Record not found.</div>';
}

require 'includes/footer.php';
?>