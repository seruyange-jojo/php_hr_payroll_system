<?php
include 'db.php';
include 'header.php';

$message = '';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST['employee_id'];
    $tax_amount = $_POST['tax_amount'];
    $tax_date = $_POST['tax_date'];

    try {
        $stmt = $conn->prepare("INSERT INTO tax (employee_id, tax_amount, tax_date) VALUES (?, ?, ?)");
        $stmt->execute([$employee_id, $tax_amount, $tax_date]);
        $message = "<span class='badge badge-success'>Tax entry added successfully.</span>";
    } catch (Exception $e) {
        $message = "<span class='badge badge-danger'>Error: " . $e->getMessage() . "</span>";
    }
}

// Fetch employees for dropdown
$employees = $conn->query("SELECT id, name FROM employees")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h1 class="mt-4">Add Tax Entry</h1>
    <?php if ($message): ?>
        <div class="mt-2"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="POST" class="mt-4">
        <div class="form-group">
            <label>Employee</label>
            <select name="employee_id" class="form-control" required>
                <?php foreach ($employees as $employee): ?>
                    <option value="<?php echo $employee['id']; ?>"><?php echo $employee['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Tax Amount</label>
            <input type="number" name="tax_amount" class="form-control" required step="0.01">
        </div>
        <div class="form-group">
            <label>Tax Date</label>
            <input type="date" name="tax_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Tax</button>
    </form>
</div>

<?php include 'footer.php'; ?>
