<?php

$booking_id = (int)($_GET['booking_id'] ?? 0);
$transaction_id = (int)($_GET['transaction_id'] ?? 0);

if ($booking_id <= 0 || $transaction_id <= 0) {
    die("Data payment tidak valid.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Processing Payment</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: #f8f6f2;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .processing-container {
            width: 90%;
            max-width: 500px;
            background: white;

            padding: 50px 30px;
            border-radius: 20px;

            text-align: center;

            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .loading-image {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 25px;
        }

        h1 {
            margin: 0 0 12px;
            font-size: 26px;
            color: #333;
        }

        p {
            margin: 0;
            color: #777;
            font-size: 15px;
            line-height: 1.6;
        }
    </style>
</head>

<body>

    <div class="processing-container">

        <img
            src="loading.gif"
            alt="Processing payment"
            class="loading-image"
        >

        <h1>Processing Payment...</h1>

        <p>
            Please wait while we process your payment.
        </p>

    </div>


    <script>

        setTimeout(function() {

            window.location.href =
                "confirmation_payment.php"
                + "?booking_id=<?php echo $booking_id; ?>"
                + "&transaction_id=<?php echo $transaction_id; ?>";

        }, 2500);

    </script>

</body>
</html>