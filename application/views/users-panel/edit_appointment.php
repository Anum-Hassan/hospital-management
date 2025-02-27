<?php
// edit_appointment.php
include('config.php');

if (isset($_GET['id'])) {
    $appointment_id = $_GET['id'];
    
    $query = "SELECT a.*, d.name AS doctor_name, p.name AS patient_name, dept.name AS department_name 
              FROM appointments a
              JOIN doctors d ON a.doctor_id = d.id
              JOIN patients p ON a.patient_id = p.id
              JOIN departments dept ON a.department_id = dept.id
              WHERE a.id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $appointment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $appointment = $result->fetch_assoc();
    } else {
        echo "Invalid Appointment ID";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointment_id = $_POST['appointment_id'];
    $doctor_id = $_POST['doctor_id'];
    $patient_id = $_POST['patient_id'];
    $department_id = $_POST['department_id'];
    $appointment_date = $_POST['appointment_date'];
    $status = $_POST['status'];
    
    $update_query = "UPDATE appointments SET doctor_id=?, patient_id=?, department_id=?, appointment_date=?, status=? WHERE id=?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("iiissi", $doctor_id, $patient_id, $department_id, $appointment_date, $status, $appointment_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Appointment updated successfully!'); window.location.href='appointment_history.php';</script>";
    } else {
        echo "Error updating appointment: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Appointment</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Edit Appointment</h2>
    <form method="POST" action="">
        <input type="hidden" name="appointment_id" value="<?= $appointment['id'] ?>">
        
        <label>Doctor Name</label>
        <select name="doctor_id">
            <option value="<?= $appointment['doctor_id'] ?>" selected><?= $appointment['doctor_name'] ?></option>
            <!-- Fetch and list other doctors -->
        </select>
        
        <label>Patient Name</label>
        <select name="patient_id">
            <option value="<?= $appointment['patient_id'] ?>" selected><?= $appointment['patient_name'] ?></option>
            <!-- Fetch and list other patients -->
        </select>
        
        <label>Department</label>
        <select name="department_id">
            <option value="<?= $appointment['department_id'] ?>" selected><?= $appointment['department_name'] ?></option>
            <!-- Fetch and list other departments -->
        </select>
        
        <label>Appointment Date</label>
        <input type="date" name="appointment_date" value="<?= $appointment['appointment_date'] ?>" required>
        
        <label>Status</label>
        <select name="status">
            <option value="pending" <?= ($appointment['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
            <option value="canceled" <?= ($appointment['status'] == 'canceled') ? 'selected' : '' ?>>Canceled</option>
            <option value="approved" <?= ($appointment['status'] == 'approved') ? 'selected' : '' ?>>Approved</option>
            <option value="completed" <?= ($appointment['status'] == 'completed') ? 'selected' : '' ?>>Completed</option>
        </select>
        
        <button type="submit">Update</button>
    </form>
</body>
</html>
