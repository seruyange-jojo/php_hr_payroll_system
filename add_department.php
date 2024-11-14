<?php
include 'db.php';
include 'header.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];

    try {
        $stmt = $conn->prepare("INSERT INTO departments (name) VALUES (?)");
        $stmt->execute([$name]);
        $message = "<span class='badge badge-success'>Department added successfully.</span>";
    } catch (Exception $e) {
        $message = "<span class='badge badge-danger'>Error: " . $e->getMessage() . "</span>";
    }
}
?>

<div class="container">
    <h1 class="mt-4">Add Department</h1>
    <?php if ($message): ?>
        <div class="mt-2"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="POST" class="mt-4">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Department</button>
    </form>
</div>

<?php include 'footer.php'; ?>
