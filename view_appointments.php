<?php
include __DIR__ . '/db.connection/db_connection.php';

/* ---- Filters ---- */
$from_date = $_GET['from_date'] ?? '';
$to_date   = $_GET['to_date'] ?? '';
$search    = trim($_GET['search'] ?? '');

$sql = "SELECT * FROM appointments WHERE 1";

if (!empty($from_date) && !empty($to_date)) {
    $sql .= " AND appointment_date BETWEEN '$from_date' AND '$to_date'";
}

if (!empty($search)) {
    $sql .= " AND (
        name LIKE '%$search%' OR 
        phone LIKE '%$search%' OR 
        email LIKE '%$search%'
    )";
}

$sql .= " ORDER BY appointment_date DESC, time_slot ASC";
$result = $conn->query($sql);
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Appointments List</title>
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }
        .filter-box, .table-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,.1);
            margin-bottom: 25px;
        }
        table th {
            background: #0d6efd;
            color: #fff;
            white-space: nowrap;
        }
        table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
<div class="container py-5">
    <h2 class="text-center mb-4">📋 Booked Appointments</h2>

    <!-- Filters -->
    <div class="filter-box">
        <form method="GET" class="row g-3">
            <div class="col-md-3">
                <label>From Date</label>
                <input type="date" name="from_date" class="form-control" value="<?= htmlspecialchars($from_date) ?>">
            </div>
            <div class="col-md-3">
                <label>To Date</label>
                <input type="date" name="to_date" class="form-control" value="<?= htmlspecialchars($to_date) ?>">
            </div>
            <div class="col-md-4">
                <label>Name / Phone / Email</label>
                <input type="text" name="search" class="form-control" value="<?= htmlspecialchars($search) ?>">
            </div>
            <div class="col-md-2 d-grid">
                <button class="btn btn-primary">Filter</button>
                <a href="view_appointments.php" class="btn btn-outline-secondary mt-2">Reset</a>
            </div>
        </form>

        <?php
        if (!empty($from_date) && !empty($to_date)) {
            $count = $conn->query("SELECT COUNT(*) total FROM appointments 
                WHERE appointment_date BETWEEN '$from_date' AND '$to_date'")
                ->fetch_assoc()['total'];
            echo "<p class='mt-3'><strong>Total Appointments:</strong> $count</p>";
        }
        ?>
    </div>

    <!-- Table -->
    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Time Slot</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= htmlspecialchars($row['name']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['phone']); ?></td>
                            <td><?= htmlspecialchars($row['appointment_date']); ?></td>
                            <td><?= htmlspecialchars($row['time_slot']); ?></td>
                            <td><?= nl2br(htmlspecialchars($row['message'])); ?></td>
                            <td>
                                <a href="delete_appointment.php?id=<?= $row['id']; ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Delete this appointment?')">
                                   Delete
                                </a>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="8" class="text-center">No Appointments Found</td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

<?php include 'footer.php'; ?>
