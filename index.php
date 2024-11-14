<?php
include 'db.php';
include 'header.php';

// Fetch data for display
$employees = $conn->query("SELECT * FROM employees")->fetchAll(PDO::FETCH_ASSOC);
$departments = $conn->query("SELECT * FROM departments")->fetchAll(PDO::FETCH_ASSOC);
$payrolls = $conn->query("SELECT p.*, e.name AS employee_name FROM payroll p JOIN employees e ON p.employee_id = e.id ORDER BY date DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h1 class="mt-4">HR Payroll Dashboard</h1>

    <!-- Employees Section -->
    <h2 class="mt-4">Employees</h2>
    <?php if (count($employees) > 0): ?>
        <table class="table table-bordered table-striped mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?php echo $employee['name']; ?></td>
                        <td><?php echo $employee['email']; ?></td>
                        <td><?php echo $employee['department']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="badge badge-warning">No employees found.</p>
    <?php endif; ?>

    <!-- Departments Section -->
    <h2 class="mt-4">Departments</h2>
    <?php if (count($departments) > 0): ?>
        <ul class="list-group mt-3">
            <?php foreach ($departments as $department): ?>
                <li class="list-group-item"><?php echo $department['name']; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="badge badge-warning">No departments found.</p>
    <?php endif; ?>

    <!-- Recent Payroll Entries Section -->
    <h2 class="mt-4">Recent Payroll Entries</h2>
    <?php if (count($payrolls) > 0): ?>
        <table class="table table-bordered table-striped mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Employee</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payrolls as $payroll): ?>
                    <tr>
                        <td><?php echo $payroll['employee_name']; ?></td>
                        <td><?php echo "$" . number_format($payroll['amount'], 2); ?></td>
                        <td><?php echo $payroll['date']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="badge badge-warning">No recent payroll entries found.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
