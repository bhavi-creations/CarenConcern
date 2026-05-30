<?php
include './db.connection/db_connection.php';

header('Content-Type: application/json');

$date = $_GET['date'] ?? '';
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
    http_response_code(400);
    echo json_encode([
        'isHoliday' => false,
        'type' => '',
        'reason' => '',
        'slots' => [],
        'error' => 'Invalid date'
    ]);
    exit;
}

$slots_list = [
    "9:00 AM - 10:00 AM",
    "10:00 AM - 11:00 AM",
    "11:00 AM - 12:00 PM",
    "12:00 PM - 01:00 PM",
    "01:00 PM - 02:00 PM",
    "02:00 PM - 03:00 PM",
    "03:00 PM - 04:00 PM",
    "04:00 PM - 05:00 PM",
    "05:00 PM - 06:00 PM",
    "06:00 PM - 07:00 PM",
    "07:00 PM - 08:30 PM"
];

$morningSlots = [
    "9:00 AM - 10:00 AM",
    "10:00 AM - 11:00 AM",
    "11:00 AM - 12:00 PM",
    "12:00 PM - 01:00 PM",
    "01:00 PM - 02:00 PM"
];

$afternoonSlots = [
    "02:00 PM - 03:00 PM",
    "03:00 PM - 04:00 PM",
    "04:00 PM - 05:00 PM",
    "05:00 PM - 06:00 PM",
    "06:00 PM - 07:00 PM",
    "07:00 PM - 08:30 PM"
];

$response = [
    'isHoliday' => false,
    'type' => '',
    'reason' => '',
    'slots' => []
];

$stmt = $conn->prepare("SELECT holiday_type, reason FROM holidays WHERE holiday_date = ? LIMIT 1");
if (!$stmt) {
    http_response_code(500);
    echo json_encode($response + ['error' => 'Unable to load slots']);
    exit;
}

$stmt->bind_param("s", $date);
$stmt->execute();
$holiday = $stmt->get_result()->fetch_assoc();

if ($holiday) {
    $response['isHoliday'] = true;
    $response['type'] = $holiday['holiday_type'];
    $response['reason'] = $holiday['reason'];
}

$countStmt = $conn->prepare(
    "SELECT COUNT(*) as total FROM appointments WHERE appointment_date = ? AND time_slot = ?"
);

if (!$countStmt) {
    http_response_code(500);
    echo json_encode($response + ['error' => 'Unable to load slots']);
    exit;
}

foreach ($slots_list as $slot) {
    if ($holiday) {
        if ($holiday['holiday_type'] === 'fullday') {
            continue;
        }
        if ($holiday['holiday_type'] === 'morning' && in_array($slot, $morningSlots, true)) {
            continue;
        }
        if ($holiday['holiday_type'] === 'afternoon' && in_array($slot, $afternoonSlots, true)) {
            continue;
        }
    }

    $countStmt->bind_param("ss", $date, $slot);
    $countStmt->execute();
    $row = $countStmt->get_result()->fetch_assoc();

    $available = 3 - (int) $row['total'];
    $response['slots'][] = [
        'time' => $slot,
        'available' => max(0, $available)
    ];
}

echo json_encode($response);
