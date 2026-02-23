<?php
include './db.connection/db_connection.php';

if (isset($_POST['submit'])) {
    $date   = $_POST['holiday_date'];
    $type   = $_POST['holiday_type'];
    $reason = $_POST['reason'];

    $conn->query("INSERT INTO holidays (holiday_date, holiday_type, reason) 
                   VALUES ('$date','$type','$reason')");

    echo "<script>alert('Holiday Added');</script>";
}
?>
<?php include 'header.php' ?>



    <div class="container appointment_slot_leave my-5">
        <h3 class="appointment_slot_leave_h3">Add Holiday</h3>
        <form method="POST">
            <div class="mb-3">
                <label>Date</label>
                <input type="date" name="holiday_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Type</label>
                <select name="holiday_type" class="form-control" required>
                    <option value="">Select The Leave</option>
                    <option value="morning">Morning (8AM–1PM)</option>
                    <option value="afternoon">Afternoon (2PM–9PM)</option>
                    <option value="fullday">Full Day</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Reason</label>
                <input type="text" name="reason" class="form-control" required>
            </div>


              <!-- <div class="dental-feature-item">
                    <div class="dental-feature-icon-wrapper">
                        <i class="fas fa-align-justify"></i>
                    </div> 
                    <div class="dental-feature-text " name="submit"> Save Holiday</div>
                </div> -->
            <button name="submit" class=" save_holiday text-center" >Save Holiday</button>
        </form>
    </div>

<?php include 'footer.php'; ?>