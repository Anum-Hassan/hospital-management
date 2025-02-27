<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            margin: 0;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 850px;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            border-top: 8px solid #1B2C51;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #1B2C51;
            color: white;
            padding: 20px;
            border-radius: 10px 10px 0 0;
        }

        .header img {
            width: 100px;
            background: white;
            padding: 5px;
            border-radius: 5px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            background: #f0f3f7;
            border-radius: 5px;
            margin: 20px 0;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .details th, .details td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        .details th {
            background-color: #1B2C51;
            color: white;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #333;
            font-weight: bold;
            padding-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Hospital Logo">
            <div class="title">Prescription</div>
        </div>

        <div style="text-align: right; font-size: 16px; margin: 20px 0;">
            <strong>Date:</strong> <?php echo date('d M, Y', strtotime($prescription['created_at'])); ?>
        </div>

        <div class="info-section">
            <div><strong>Patient:</strong> <?php echo $prescription['patient_name']; ?></div>
            <div><strong>Doctor:</strong> <?php echo $prescription['doctor_name']; ?></div>
        </div>

        <div class="details">
            <table>
                <tr>
                    <th>Disease</th>
                    <td><?php echo $prescription['diagnosis']; ?></td>
                </tr>
                <tr>
                    <th>Medications</th>
                    <td><?php echo $prescription['medications']; ?></td>
                </tr>
                <tr>
                    <th>Notes</th>
                    <td><?php echo $prescription['notes']; ?></td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>We prioritize your health and well-being. If you have any questions, feel free to contact our hospital administration. Wishing you a speedy recovery!</p>
        </div>
    </div>
</body>
</html>
