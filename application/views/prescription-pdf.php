<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; font-size: 20px; font-weight: bold; }
        .date { text-align: right; font-size: 14px; margin-bottom: 10px; }
        .content { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="date"><strong>Date:</strong> <?= date('d-m-Y'); ?></div>
    <div class="header">Prescription Details</div>
    <div class="content">
        <p><strong>Patient Name:</strong> <?= isset($prescription['patient_name']) ? $prescription['patient_name'] : 'N/A'; ?></p>
        <p><strong>Doctor Name:</strong> <?= isset($prescription['doctor_name']) ? $prescription['doctor_name'] : 'N/A'; ?></p>
        <p><strong>Diagnosis:</strong> <?= isset($prescription['diagnosis']) ? $prescription['diagnosis'] : 'N/A'; ?></p>
        <p><strong>Medications:</strong> <?= isset($prescription['medications']) ? $prescription['medications'] : 'N/A'; ?></p>
        <p><strong>Notes:</strong> <?= isset($prescription['notes']) ? $prescription['notes'] : 'N/A'; ?></p>
    </div>
</body>
</html>
