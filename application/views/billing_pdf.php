<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($billing->payment_status == 'Paid') ? 'Bill' : 'Billing Invoice'; ?></title>
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

        .invoice-title {
            text-align: right;
            font-size: 24px;
            font-weight: bold;
        }

        .contact-us {
            text-align: right;
            font-size: 14px;
            color: #1B2C51;
            margin-top: 10px;
            font-weight: bold;
        }

        .contact-us i {
            margin-right: 5px;
            color: white;
            background-color: #1B2C51;
            width: 20px;
            border-radius: 50%;
        }

        .date-section,
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

        .details th,
        .details td {
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
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Hospital Logo">
            <div class="invoice-title">
                <?php echo ($billing->payment_status == 'Paid') ? 'Bill' : 'Billing Invoice'; ?>
            </div>
        </div>

        <div class="contact-us">
            <p>
                +92 347 6705437 | medcarehospital@email.com | 123 Main Street, Lahore, Pakistan
            </p>
        </div>

        <div class="date-section">
            <span><?php echo ($billing->payment_status == 'Paid') ? '<strong>Date:</strong>': '<strong>Invoice Date:</strong>'; ?> <?php echo date('d M, Y', strtotime($billing->created_at)); ?></span>

            <?php if ($billing->payment_status !== 'Paid'): ?>
                <span class="ml-5"><strong>Due Date:</strong> <?php echo date('d M, Y', strtotime($billing->created_at . ' +5 days')); ?></span>
            <?php endif; ?>
        </div>


        <div class="info-section">
            <div>
                <p><strong>Patient:</strong> <?php echo $billing->patient_name; ?></p>
            </div>
            <div>
                <p><strong>Doctor:</strong> <?php echo $billing->doctor_name; ?></p>
            </div>
        </div>

        <div class="details">
            <table>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
                <tr>
                    <td>Room Charges</td>
                    <td>Rs. <?php echo number_format($billing->room_charges, 2); ?></td>
                </tr>
                <tr>
                    <td>Doctor Fee</td>
                    <td>Rs. <?php echo number_format($billing->doctor_fee, 2); ?></td>
                </tr>
                <tr>
                    <td><strong>Total Amount</strong></td>
                    <td><strong>Rs. <?php echo number_format($billing->total_amount, 2); ?></strong></td>
                </tr>
                <tr>
                    <td>Paid Amount</td>
                    <td>Rs. <?php echo number_format($billing->paid_amount, 2); ?></td>
                </tr>
                <?php if ($billing->pending_amount > 0): ?>
                    <tr>
                        <td>Pending Amount</td>
                        <td>Rs. <?php echo number_format($billing->pending_amount, 2); ?></td>
                    </tr>
                <?php endif; ?>

                <tr>
                    <td>Status</td>
                    <td style="color: <?php echo ($billing->payment_status == 'Paid') ? 'green' : 'red'; ?>; font-weight:bold;">
                        <?php echo strtoupper($billing->payment_status); ?>
                    </td>
                </tr>

            </table>
        </div>

        <div class="footer">
            <?php if ($billing->payment_status == 'Paid') { ?>
                <p>Thank You for Your Payment! We appreciate your trust in our hospital.</p>
            <?php } else { ?>
                <p>Please complete the payment by the due date to avoid any inconvenience.</p>
            <?php } ?>
        </div>
    </div>
</body>

</html>