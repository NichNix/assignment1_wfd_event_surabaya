<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-md rounded-lg p-6 max-w-md w-full">
        <h1 class="text-2xl font-bold text-green-600 mb-4">Thank you for your payment!</h1>
        <p class="text-lg mb-2">Hi <span class="font-semibold">{{ $booking->nama }}</span>,</p>
        <p class="text-gray-700 mb-4">
            Your payment for the event <span class="font-semibold">"{{ $booking->event->title }}"</span> has been successfully processed.
        </p>
        <p class="text-lg font-semibold mb-2">Details:</p>
        <ul class="list-disc list-inside bg-gray-50 p-4 rounded-lg shadow-sm">
            <li><strong>Transaction ID:</strong> {{ $booking->id }}</li>
            <li><strong>Amount:</strong> Rp{{ number_format($booking->event->price, 2) }}</li>
            <li><strong>Status:</strong> <span class="text-green-600 font-semibold">{{ $booking->status_bayar }}</span></li>
        </ul>
        <p class="mt-4 text-gray-700">
            We look forward to seeing you at the event!
        </p>

        <!-- go back to events.index!-->
        <a href="{{ route('events.index') }}" class="mt-6 inline-block bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">Back to Events</a>

    </div>
</body>
</html>
