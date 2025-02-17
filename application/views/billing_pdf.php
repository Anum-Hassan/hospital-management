<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo ($billing->payment_status == 'Paid') ? 'Bill' : 'Billing Invoice'; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
            background-color: #f8f9fa;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #2a1c5a;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            color: #2a1c5a;
            font-size: 22px;
            text-transform: uppercase;
        }

        .date-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 15px;
            padding: 5px 0;
        }

        .date-section span {
            flex: 1;
        }

        .date-section .due-date {
            text-align: right;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 10px;
            background: #f1f1f1;
            border-radius: 5px;
        }

        .info-section div {
            width: 48%;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .details th,
        .details td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .payment-status {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: <?php echo ($billing->payment_status == 'Paid') ? 'green' : 'red'; ?>;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: gray;
            font-style: italic;
        }

        .highlight {
            font-weight: bold;
            color: #2a1c5a;
        }

        .invoice-dates {
            display: flex;
            justify-content: space-between;
            width: 100%;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 15px;
            white-space: nowrap;
            /* Ab koi bhi line break nahi karega */
        }

        .due {
            text-align: right;
        }
        
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2><?php echo ($billing->payment_status == 'Paid') ? 'Bill' : 'Billing Invoice'; ?></h2>
        </div>

        <!-- Invoice Date & Due Date -->
        <?php
        $invoiceDate = date('d M, Y', strtotime($billing->created_at));
        $dueDate = date('d M, Y', strtotime($billing->created_at . ' +5 days'));
        ?>
        <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; margin-bottom: 10px; font-size: 16px; white-space: nowrap;">
    <div style="flex: 1; text-align: left;"><strong>Invoice Date:</strong> <?php echo $invoiceDate; ?></div>
    <div style="flex: 1; text-align: right;"><strong>Due Date:</strong> <?php echo $dueDate; ?></div>
</div>


        <!-- Patient & Doctor Info -->
        <div class="info-section">
            <div>
                <h3>Patient Details</h3>
                <p><span class="highlight">Name:</span> <?php echo $billing->patient_name; ?></p>
            </div>
            <div>
                <h3>Doctor Details</h3>
                <p><span class="highlight">Name:</span> <?php echo $billing->doctor_name; ?></p>
            </div>
        </div>

        <!-- Billing Details -->
        <div class="details">
            <table>
                <tr>
                    <th>Room Charges</th>
                    <td>Rs. <?php echo number_format($billing->room_charges, 2); ?></td>
                </tr>
                <tr>
                    <th>Doctor Fee</th>
                    <td>Rs. <?php echo number_format($billing->doctor_fee, 2); ?></td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <td>Rs. <?php echo number_format($billing->total_amount, 2); ?></td>
                </tr>
                <tr>
                    <th>Paid Amount</th>
                    <td>Rs. <?php echo number_format($billing->paid_amount, 2); ?></td>
                </tr>
                <tr>
                    <th>Pending Amount</th>
                    <td>Rs. <?php echo number_format($billing->pending_amount, 2); ?></td>
                </tr>
            </table>
        </div>

        <!-- Payment Status -->
        <p class="payment-status">Payment Status: <?php echo strtoupper($billing->payment_status); ?></p>

        <!-- Footer Message -->
        <div class="footer">
            <?php if ($billing->payment_status == 'Paid') { ?>
                <p>Your payment has been successfully processed. Thank you for choosing our hospital.</p>
            <?php } else { ?>
                <p>Please complete the payment by the due date to avoid any inconvenience. Contact the hospital administration for further details.</p>
            <?php } ?>
        </div>
    </div>
</body>

</html>