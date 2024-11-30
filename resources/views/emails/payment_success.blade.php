<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #4CAF50;
            margin-bottom: 10px;
        }
        p {
            margin: 10px 0;
            color: #333333;
        }
        .details {
            margin: 20px 0;
            background: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777777;
            text-align: center;
        }
        a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Payment Confirmation</h2>
        <p>Dear <strong>{{ $booking->nama }}</strong>,</p>
        <p>Thank you for your payment for the event <strong>{{ $booking->event->title }}</strong>.</p>
        <p>Your payment has been successfully processed. Below are the details of your transaction:</p>
        
        <div class="details">
            <p><strong>Transaction ID:</strong> {{ $booking->id }}</p>
            <p><strong>Event Name:</strong> {{ $booking->event->title }}</p>
            <p><strong>Amount Paid:</strong> Rp{{ number_format($booking->event->price, 2) }}</p>
            <p><strong>Status:</strong> Paid</p>
        </div>
        
        <p>We look forward to seeing you at the event! If you have any questions, feel free to contact us at <a href="mailto:support@example.com">support@example.com</a>.</p>
        
        <div class="footer">
            <p>This is an automated email. Please do not reply to this email.</p>
            <p>&copy; 2024 Eventku. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
