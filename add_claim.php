<?php
include 'db.php';
include 'header.php';

$message = '';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST['employee_id'];
    $claim_type = $_POST['claim_type'];
    $claim_amount = $_POST['claim_amount'];
    $claim_date = $_POST['claim_date'];

    try {
        $stmt = $conn->prepare("INSERT INTO claims (employee_id, claim_type, claim_amount, claim_date) VALUES (?, ?, ?, ?)");
        $stmt->execute([$employee_id, $claim_type, $claim_amount, $claim_date]);
        $message = "<span class='badge badge-success'>Claim entry added successfully.</span>";
    } catch (Exception $e) {
        $message = "<span class='badge badge-danger'>Error: " . $e->getMessage() . "</span>";
    }
}

// Fetch employees for dropdown
$employees = $conn->query("SELECT id, name FROM employees")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h1 class="mt-4">Add Claim Entry</h1>
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
            <label>Claim Type</label>
            <input type="text" name="claim_type" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Claim Amount</label>
            <input type="number" name="claim_amount" class="form-control" required step="0.01">
        </div>
        <div class="form-group">
            <label>Claim Date</label>
            <input type="date" name="claim_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Claim</button>
    </form>
</div>

<?php include 'footer.php'; ?>
