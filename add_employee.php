<?php
include 'db.php';
include 'header.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];

    try {
        $stmt = $conn->prepare("INSERT INTO employees (name, email, department) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $department]);
        $message = "<span class='badge badge-success'>Employee added successfully.</span>";
    } catch (Exception $e) {
        $message = "<span class='badge badge-danger'>Error: " . $e->getMessage() . "</span>";
    }
}

// Fetch departments for dropdown
$departments = $conn->query("SELECT name FROM departments")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h1 class="mt-4">Add Employee</h1>
    <?php if ($message): ?>
        <div class="mt-2"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="POST" class="mt-4">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Department</label>
            <select name="department" class="form-control">
                <?php foreach ($departments as $department): ?>
                    <option value="<?php echo $department['name']; ?>"><?php echo $department['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Employee</button>
    </form>
</div>

<?php include 'footer.php'; ?>
