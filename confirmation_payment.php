<?php

require_once "config.php";


/* =========================================================
   BOOKING ID
========================================================= */

$booking_id = (int)($_GET['booking_id'] ?? 0);

if ($booking_id <= 0) {
    die("Booking tidak valid.");
}


/* =========================================================
   BOOKING + USER + TRANSACTION
========================================================= */

$sql = "
    SELECT
        b.booking_id,
        b.trip_type,
        b.status,

        u.name AS user_name,
        u.email,
        u.phone,

        t.transaction_id,
        t.total_amount,
        t.payment_status

    FROM bookings b

    LEFT JOIN users u
        ON b.user_id = u.user_id

    LEFT JOIN transactions t
        ON b.booking_id = t.booking_id

    WHERE b.booking_id = ?

    LIMIT 1
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Query booking gagal: " . $conn->error);
}

$stmt->bind_param("i", $booking_id);
$stmt->execute();

$booking = $stmt->get_result()->fetch_assoc();

if (!$booking) {
    die("Booking tidak ditemukan.");
}

$transaction_id = (int)$booking['transaction_id'];
$total = (float)$booking['total_amount'];


/* =========================================================
   PAYMENT STATUS
========================================================= */

$payment_status = $booking['payment_status'] ?? 'Pending';

$is_paid = (
    strtolower(trim($payment_status)) === 'paid'
);


/* =========================================================
   TRIP PERGI
========================================================= */

$sql = "
    SELECT
        tp.trippergi_id,
        tp.travel_date,
        tp.departure_date,

        p1.name AS origin,
        p2.name AS destination

    FROM tripdetailspergi tp

    LEFT JOIN places p1
        ON tp.origin_id = p1.place_id

    LEFT JOIN places p2
        ON tp.destination_id = p2.place_id

    WHERE tp.booking_id = ?

    LIMIT 1
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Query trip pergi gagal: " . $conn->error);
}

$stmt->bind_param("i", $booking_id);
$stmt->execute();

$pergi = $stmt->get_result()->fetch_assoc();


/* =========================================================
   TRIP PULANG
========================================================= */

$sql = "
    SELECT
        tr.trippulang_id,
        tr.travel_date,
        tr.departure_date,

        p1.name AS origin,
        p2.name AS destination

    FROM tripdetailspulang tr

    LEFT JOIN places p1
        ON tr.origin_id = p1.place_id

    LEFT JOIN places p2
        ON tr.destination_id = p2.place_id

    WHERE tr.booking_id = ?

    LIMIT 1
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Query trip pulang gagal: " . $conn->error);
}

$stmt->bind_param("i", $booking_id);
$stmt->execute();

$pulang = $stmt->get_result()->fetch_assoc();


/* =========================================================
   PASSENGER
========================================================= */

$sql = "
    SELECT
        pp.seat_number,
        p.passenger_id,
        p.name,
        p.ID,
        p.birth_date

    FROM passengerpergi pp

    LEFT JOIN passengers p
        ON pp.passenger_id = p.passenger_id

    WHERE pp.trippergi_id = ?

    LIMIT 1
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Query passenger gagal: " . $conn->error);
}

$stmt->bind_param(
    "i",
    $pergi['trippergi_id']
);

$stmt->execute();

$passenger = $stmt->get_result()->fetch_assoc();


/* =========================================================
   PAYMENT
========================================================= */

$sql = "
    SELECT
        payment_id,
        payment_type,
        status
    FROM payments
    WHERE transaction_id = ?
    ORDER BY payment_id DESC
    LIMIT 1
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Query payment gagal: " . $conn->error);
}

$stmt->bind_param("i", $transaction_id);
$stmt->execute();

$payment = $stmt->get_result()->fetch_assoc();
$stmt->close();


$payment_type = $payment['payment_type'] ?? '';

$display_payment_type = ($payment_type === 'Card')
    ? 'Credit / Debit Card'
    : (($payment_type === 'Cash') ? 'Cash' : 'Unknown');


/* =========================================================
   TRANSACTION DETAIL
========================================================= */

$sql = "
    SELECT
        ticket_price,
        quantity,
        subtotal

    FROM transactiondetails

    WHERE transaction_id = ?

    LIMIT 1
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Query transaction detail gagal: " . $conn->error);
}

$stmt->bind_param(
    "i",
    $transaction_id
);

$stmt->execute();

$detail = $stmt->get_result()->fetch_assoc();


/*
   HARGA TRANSACTION DETAILS
   Disamakan dengan total booking.
*/

$ticket_price = $total;
$quantity = 1;
$subtotal = $total;


/* =========================================================
   HELPER
========================================================= */



/* =========================================================
   QR DATA
========================================================= */

$qr_data = [
    "type" => "TRAVEL TICKET",

    "booking_id" => $booking_id,

    "transaction_id" =>
        "TRX-" . str_pad(
            $transaction_id,
            5,
            "0",
            STR_PAD_LEFT
        ),

    "passenger" =>
        $passenger['name'] ?? "-",

    "route" =>
        ($pergi['origin'] ?? "-")
        . " -> "
        . ($pergi['destination'] ?? "-"),

    "departure" =>
        tanggal(
            $pergi['travel_date'] ?? null
        ),

    "time" =>
        waktu(
            $pergi['departure_date'] ?? null
        ),

    "seat" =>
        $passenger['seat_number'] ?? "-",

    "status" =>
        $payment_status
];

?>


<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>Booking Confirmation</title>


<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


<style>

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}


body {

    font-family:
        Arial,
        Helvetica,
        sans-serif;

    background: #f4f7fb;

    color: #17243a;

}


/* =========================================================
   STEPPER
========================================================= */

.stepper {

    width: 900px;

    margin: 30px auto;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 12px;

}

.step {

    display: flex;

    align-items: center;

    gap: 8px;

    color: #20a978;

    font-size: 13px;

    font-weight: bold;

}

.circle {

    width: 30px;

    height: 30px;

    border-radius: 50%;

    background: #20a978;

    color: white;

    display: flex;

    align-items: center;

    justify-content: center;

}

.line {

    width: 60px;

    height: 2px;

    background: #20a978;

}


/* =========================================================
   MAIN
========================================================= */

.container {

    width: 1100px;

    margin: auto;

    display: grid;

    grid-template-columns:
        1fr
        320px;

    gap: 25px;

    padding-bottom: 50px;

}

.card,
.summary {

    background: white;

    border-radius: 18px;

    padding: 25px;

    box-shadow:
        0 8px 30px
        rgba(30, 60, 90, .06);

}


/* =========================================================
   SUCCESS
========================================================= */

.success {

    background: #e8f8f0;

    border-radius: 12px;

    padding: 18px;

    display: flex;

    align-items: center;

    gap: 14px;

    margin-bottom: 28px;

}

.success-icon {

    width: 42px;

    height: 42px;

    background: #20a978;

    border-radius: 50%;

    color: white;

    display: flex;

    justify-content: center;

    align-items: center;

    font-size: 22px;

}

.success h2 {

    font-size: 17px;

}

.success p {

    font-size: 12px;

    color: #65758b;

    margin-top: 4px;

}


/* =========================================================
   PENDING
========================================================= */

.pending {

    background: #fff6df;

    border: 1px solid #f4d58a;

    border-radius: 12px;

    padding: 18px;

    display: flex;

    align-items: center;

    gap: 14px;

    margin-bottom: 28px;

}

.pending-icon {

    width: 42px;

    height: 42px;

    background: #f59e0b;

    border-radius: 50%;

    color: white;

    display: flex;

    justify-content: center;

    align-items: center;

    font-size: 20px;

    flex-shrink: 0;

}

.pending h2 {

    font-size: 17px;

    color: #9a6500;

}

.pending p {

    font-size: 12px;

    color: #8a6a2a;

    margin-top: 4px;

}


/* =========================================================
   TEXT
========================================================= */

.label {

    color: #1688f7;

    font-size: 10px;

    font-weight: bold;

    letter-spacing: 2px;

    margin-bottom: 7px;

}

h1 {

    font-size: 30px;

    margin-bottom: 25px;

}


/* =========================================================
   BOOKING DETAILS
========================================================= */

.details {

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 25px;

    padding-bottom: 25px;

    border-bottom:
        1px solid #e2e7ed;

}

.detail span {

    display: block;

    color: #8994a7;

    font-size: 10px;

    margin-bottom: 7px;

}

.detail strong {

    font-size: 13px;

}

.paid {

    color: #20a978;

}

.pending-status {

    color: #f59e0b;

    font-weight: 700;

}


/* =========================================================
   TRANSACTION
========================================================= */

.transaction {

    margin-top: 25px;

    border:
        1px solid #dce5ef;

    border-radius: 12px;

    overflow: hidden;

}

.transaction-title {

    padding: 18px;

    display: flex;

    justify-content: space-between;

    align-items: center;

}

.transaction-title h2 {

    font-size: 19px;

}

.badge {

    padding: 6px 12px;

    border-radius: 20px;

    font-size: 11px;

    font-weight: bold;

}

.badge-paid {

    background: #e5f8ef;

    color: #20a978;

}

.badge-pending {

    background: #fff1cf;

    color: #d88900;

}


/* =========================================================
   TABLE
========================================================= */

.table {

    display: grid;

    grid-template-columns:
        1.2fr
        1.6fr
        .7fr
        1fr
        .5fr
        1fr;

    padding: 13px 15px;

    font-size: 11px;

    gap: 8px;

}

.table.header {

    background: #f5f8fc;

    color: #738096;

    font-weight: bold;

}

.table.total {

    display: flex;

    justify-content: flex-end;

    gap: 30px;

    border-top:
        1px solid #e2e7ed;

    padding: 17px;

}


/* =========================================================
   TRAVEL TICKET
========================================================= */

.ticket {

    margin-top: 25px;

    background: #f4f9ff;

    border:
        1px solid #d8e9fa;

    border-radius: 13px;

    padding: 20px;

    display: flex;

    justify-content: space-between;

    align-items: center;

    gap: 20px;

}

.ticket h2 {

    margin-bottom: 18px;

    font-size: 18px;

}

.ticket-info {

    display: flex;

    gap: 35px;

}

.ticket-info span {

    display: block;

    color: #8290a3;

    font-size: 10px;

    margin-bottom: 5px;

}

.ticket-info strong {

    font-size: 12px;

}


/* =========================================================
   TICKET PENDING
========================================================= */

.ticket-pending {

    margin-top: 25px;

    background: #f3f6fa;

    border-radius: 13px;

    padding: 20px;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 12px;

    text-align: center;

    color: #718096;

}

.ticket-pending-icon {

    font-size: 24px;

}

.ticket-pending strong {

    display: block;

    color: #68778c;

    font-size: 13px;

}

.ticket-pending p {

    margin-top: 4px;

    font-size: 11px;

    color: #8a96a8;

}


/* =========================================================
   QR
========================================================= */

.qr-wrapper {

    width: 110px;

    height: 110px;

    background: white;

    border:
        1px solid #d6deea;

    display: flex;

    align-items: center;

    justify-content: center;

    padding: 8px;

    flex-shrink: 0;

}

#qrcode {

    width: 90px;

    height: 90px;

    display: flex;

    align-items: center;

    justify-content: center;

}

#qrcode img,
#qrcode canvas {

    width: 90px !important;

    height: 90px !important;

}


/* =========================================================
   DOWNLOAD
========================================================= */

.download {

    width: 100%;

    margin-top: 20px;

    height: 48px;

    border: none;

    border-radius: 9px;

    background: #1688f7;

    color: white;

    font-weight: bold;

    cursor: pointer;

    font-size: 15px;

}

.download:hover {

    background: #0876df;

}


/* =========================================================
   SUMMARY
========================================================= */

.summary h2 {

    margin-bottom: 20px;

}

.route {

    border:
        1px solid #dce5ef;

    padding: 15px;

    border-radius: 12px;

    display: grid;

    grid-template-columns:
        1fr
        25px
        1fr;

}

.route small {

    color: #8994a7;

    font-size: 9px;

}

.route strong {

    display: block;

    font-size: 11px;

    margin-top: 5px;

}

.summary-row {

    display: flex;

    justify-content: space-between;

    padding: 11px 0;

    font-size: 12px;

}

.summary-row span {

    color: #8490a3;

}

hr {

    border: none;

    border-top:
        1px solid #e2e7ed;

    margin: 15px 0;

}

.total-price {

    background: #eef9f4;

    border-radius: 10px;

    padding: 16px;

    display: flex;

    justify-content: space-between;

}

.total-price strong {

    color: #20a978;

    font-size: 19px;

}


/* =========================================================
   NEXT STEPS
========================================================= */

.next-steps {

    margin-top: 20px;

    background: #fff6df;

    border-radius: 12px;

    padding: 17px 20px;

}

.next-steps-title {

    font-weight: bold;

    color: #9a6500;

    margin-bottom: 9px;

    font-size: 13px;

}

.next-steps ol {

    padding-left: 20px;

    color: #7f682f;

    font-size: 11px;

    line-height: 1.8;

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1150px) {

    .container {
        width: 95%;
    }

    .stepper {
        width: 95%;
    }

}

@media (max-width: 800px) {

    .container {

        grid-template-columns: 1fr;

    }

    .summary {

        order: 2;

    }

    .details {

        grid-template-columns:
            repeat(2, 1fr);

    }

    .ticket-info {

        flex-wrap: wrap;

        gap: 20px;

    }

}


/* =========================================================
   PRINT
========================================================= */

@media print {

    body {
        background: white;
    }

    .stepper,
    .summary,
    .success,
    .pending,
    .next-steps,
    .download {

        display: none !important;

    }

    .container {

        width: 100%;

        display: block;

    }

    .card {

        box-shadow: none;

        padding: 0;

    }

}

</style>

</head>


<body>


<!-- =======================================================
     STEPPER
======================================================= -->

<div class="stepper">

    <div class="step">

        <div class="circle">
            ✓
        </div>

        Passenger

    </div>

    <div class="line"></div>

    <div class="step">

        <div class="circle">
            ✓
        </div>

        Payment

    </div>

    <div class="line"></div>

    <div class="step">

        <div class="circle">
            ✓
        </div>

        Confirmation

    </div>

</div>


<div class="container">


<main class="card">


<!-- =======================================================
     BANNER
======================================================= -->

<?php if ($is_paid): ?>

<div class="success">

    <div class="success-icon">
        ✓
    </div>

    <div>

        <h2>
            Your booking is confirmed!
        </h2>

        <p>
            Your payment has been successfully processed.
        </p>

    </div>

</div>

<?php else: ?>

<div class="pending">

    <div class="pending-icon">
        !
    </div>

    <div>

        <h2>
            Payment Pending
        </h2>

        <p>
            Your booking has been reserved,
            but the payment has not been completed yet.
        </p>

    </div>

</div>

<?php endif; ?>


<!-- =======================================================
     BOOKING INFORMATION
======================================================= -->

<div class="label">
    BOOKING INFORMATION
</div>

<h1>
    Booking Details
</h1>


<div class="details">


    <div class="detail">

        <span>
            Passenger
        </span>

        <strong>
            <?= htmlspecialchars(
                $passenger['name'] ?? '-'
            ) ?>
        </strong>

    </div>


    <div class="detail">

        <span>
            Seat Number
        </span>

        <strong>
            <?= htmlspecialchars(
                $passenger['seat_number'] ?? '-'
            ) ?>
        </strong>

    </div>


    <div class="detail">

        <span>
            Booking Number
        </span>

        <strong>
            #<?= $booking_id ?>
        </strong>

    </div>


    <div class="detail">

        <span>
            Transaction ID
        </span>

        <strong>
            TRX-<?= str_pad(
                $transaction_id,
                5,
                "0",
                STR_PAD_LEFT
            ) ?>
        </strong>

    </div>


    <div class="detail">

        <span>
            Payment Method
        </span>

        <strong>
            <?= htmlspecialchars(
                $display_payment_type
            ) ?>
        </strong>

    </div>


    <div class="detail">

        <span>
            Payment Status
        </span>

        <strong
            class="<?= $is_paid
                ? 'paid'
                : 'pending-status'
            ?>"
        >
            <?= htmlspecialchars(
                $payment_status
            ) ?>
        </strong>

    </div>


</div>


<!-- =======================================================
     TRANSACTION
======================================================= -->

<div class="transaction">

    <div class="transaction-title">

        <div>

            <div class="label">
                TRANSACTION
            </div>

            <h2>
                Transaction Details
            </h2>

        </div>


        <span
            class="badge
                <?= $is_paid
                    ? 'badge-paid'
                    : 'badge-pending'
                ?>"
        >

            <?= $is_paid
                ? 'Paid'
                : 'Pending'
            ?>

        </span>

    </div>


    <div class="table header">

        <span>
            Passenger
        </span>

        <span>
            Route
        </span>

        <span>
            Seat
        </span>

        <span>
            Price
        </span>

        <span>
            Qty
        </span>

        <span>
            Subtotal
        </span>

    </div>


    <div class="table">

        <span>
            <?= htmlspecialchars(
                $passenger['name'] ?? '-'
            ) ?>
        </span>


        <span>

            <?= htmlspecialchars(
                $pergi['origin'] ?? '-'
            ) ?>

            →

            <?= htmlspecialchars(
                $pergi['destination'] ?? '-'
            ) ?>

        </span>


        <span>
            <?= htmlspecialchars(
                $passenger['seat_number'] ?? '-'
            ) ?>
        </span>


        <span>
            <?= rupiah($ticket_price) ?>
        </span>


        <span>
            <?= $quantity ?>
        </span>


        <span>
            <?= rupiah($subtotal) ?>
        </span>

    </div>


    <div class="table total">

        <span>
            Total
        </span>

        <strong>
            <?= rupiah($total) ?>
        </strong>

    </div>

</div>


<!-- =======================================================
     CARD = PAID
     TICKET + QR + DOWNLOAD
======================================================= -->

<?php if ($is_paid): ?>

<div
    class="ticket"
    id="travelTicket"
>

    <div>

        <div class="label">
            TRAVEL TICKET
        </div>


        <h2>

            <?= htmlspecialchars(
                $pergi['origin'] ?? '-'
            ) ?>

            →

            <?= htmlspecialchars(
                $pergi['destination'] ?? '-'
            ) ?>

        </h2>


        <div class="ticket-info">


            <div>

                <span>
                    Passenger
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $passenger['name'] ?? '-'
                    ) ?>
                </strong>

            </div>


            <div>

                <span>
                    Departure
                </span>

                <strong>
                    <?= tanggal(
                        $pergi['travel_date'] ?? null
                    ) ?>
                </strong>

            </div>


            <div>

                <span>
                    Time
                </span>

                <strong>
                    <?= waktu(
                        $pergi['departure_date'] ?? null
                    ) ?>
                </strong>

            </div>


            <div>

                <span>
                    Seat
                </span>

                <strong>
                    <?= htmlspecialchars(
                        $passenger['seat_number'] ?? '-'
                    ) ?>
                </strong>

            </div>


        </div>

    </div>


    <div class="qr-wrapper">

        <div id="qrcode"></div>

    </div>

</div>


<button
    class="download"
    type="button"
    onclick="downloadTicket()"
>
    Download Ticket
</button>


<?php else: ?>


<!-- =======================================================
     CASH = PENDING
     NO TICKET
======================================================= -->

<div class="next-steps">

    <div class="next-steps-title">
        ⚠ Next Steps
    </div>

    <ol>

        <li>
            Please pay the exact amount at the counter.
        </li>

        <li>
            Show your booking number: #<?= $booking_id ?>.
        </li>

        <li>
            After the payment is confirmed,
            your ticket will be available.
        </li>

    </ol>

</div>


<div class="ticket-pending">

    <div class="ticket-pending-icon">
        🎟
    </div>

    <div>

        <strong>
            Ticket will be available
        </strong>

        <p>
            after payment is completed.
        </p>

    </div>

</div>


<?php endif; ?>


</main>


<!-- =======================================================
     BOOKING SUMMARY
======================================================= -->

<aside class="summary">

    <h2>
        Booking Summary
    </h2>


    <div class="route">

        <div>

            <small>
                FROM
            </small>

            <strong>
                <?= htmlspecialchars(
                    $pergi['origin'] ?? '-'
                ) ?>
            </strong>

        </div>


        <b>
            →
        </b>


        <div>

            <small>
                TO
            </small>

            <strong>
                <?= htmlspecialchars(
                    $pergi['destination'] ?? '-'
                ) ?>
            </strong>

        </div>

    </div>


    <div class="summary-row">

        <span>
            Departure
        </span>

        <strong>

            <?= tanggal(
                $pergi['travel_date'] ?? null
            ) ?>

            ·

            <?= waktu(
                $pergi['departure_date'] ?? null
            ) ?>

        </strong>

    </div>


    <?php if ($pulang): ?>

    <div class="summary-row">

        <span>
            Return
        </span>

        <strong>

            <?= tanggal(
                $pulang['travel_date'] ?? null
            ) ?>

            ·

            <?= waktu(
                $pulang['departure_date'] ?? null
            ) ?>

        </strong>

    </div>

    <?php endif; ?>


    <div class="summary-row">

        <span>
            Passenger
        </span>

        <strong>
            1 Person
        </strong>

    </div>


    <div class="summary-row">

        <span>
            Payment
        </span>

        <strong>
            <?= htmlspecialchars(
                $display_payment_type
            ) ?>
        </strong>

    </div>


    <hr>


    <div class="summary-row">

        <span>
            Trip Price
        </span>

        <strong>
            <?= rupiah($total) ?>
        </strong>

    </div>


    <div class="summary-row">

        <span>
            Service Fee
        </span>

        <strong>
            Rp 0
        </strong>

    </div>


    <div class="total-price">

        <span>
            Total Price
        </span>

        <strong>
            <?= rupiah($total) ?>
        </strong>

    </div>

</aside>


</div>


<script>

/* =========================================================
   QR — CARD / PAID ONLY
========================================================= */

<?php if ($is_paid): ?>

const qrData = <?= json_encode(
    $qr_data,
    JSON_UNESCAPED_UNICODE |
    JSON_UNESCAPED_SLASHES
) ?>;


document.addEventListener(
    "DOMContentLoaded",
    function () {

        const qrElement =
            document.getElementById("qrcode");

        if (!qrElement) {
            return;
        }

        new QRCode(
            qrElement,
            {

                text:
                    JSON.stringify(qrData),

                width: 90,

                height: 90,

                colorDark: "#17243a",

                colorLight: "#ffffff",

                correctLevel:
                    QRCode.CorrectLevel.H

            }
        );

    }
);

<?php endif; ?>


/* =========================================================
   DOWNLOAD — CARD / PAID ONLY
========================================================= */

<?php if ($is_paid): ?>

function downloadTicket() {

    const ticket =
        document.getElementById(
            "travelTicket"
        );

    if (!ticket) {

        alert(
            "Ticket tidak ditemukan."
        );

        return;

    }


    html2canvas(
        ticket,
        {

            scale: 3,

            backgroundColor: "#ffffff",

            useCORS: true

        }

    )

    .then(
        function (canvas) {

            const link =
                document.createElement("a");


            link.download =
                "Travel_Ticket_Booking_<?= $booking_id ?>.png";


            link.href =
                canvas.toDataURL(
                    "image/png"
                );


            link.click();

        }
    )

    .catch(
        function (error) {

            console.error(error);

            alert(
                "Ticket gagal didownload."
            );

        }
    );

}

<?php endif; ?>

</script>


</body>

</html>