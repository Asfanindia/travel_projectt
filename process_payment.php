<?php

require_once "config.php";

/* =========================================================
   GET DATA FROM PAYMENT FORM
========================================================= */

$booking_id = (int)($_POST['booking_id'] ?? 0);
$transaction_id = (int)($_POST['transaction_id'] ?? 0);
$payment_type = trim($_POST['payment_type'] ?? '');


/* =========================================================
   VALIDATION
========================================================= */

if ($booking_id <= 0) {
    die("Booking tidak valid.");
}

if ($transaction_id <= 0) {
    die("Transaction tidak valid.");
}

if ($payment_type !== 'Card' && $payment_type !== 'Cash') {
    die("Payment method tidak valid.");
}


/* =========================================================
   CARD PAYMENT
========================================================= */

if ($payment_type === 'Card') {

    /*
       Card data hanya digunakan untuk validasi.
       Tidak disimpan ke database.
    */

    $card_holder_name = trim($_POST['card_holder_name'] ?? '');
    $card_type = trim($_POST['card_type'] ?? '');
    $card_number = trim($_POST['card_number'] ?? '');
    $expired_date = trim($_POST['expired_date'] ?? '');

    if ($card_holder_name === '') {
        die("Card Holder Name belum diisi.");
    }

    if ($card_type === '') {
        die("Card Type belum dipilih.");
    }

    if ($card_number === '') {
        die("Card Number belum diisi.");
    }

    if ($expired_date === '') {
        die("Expiry Date belum diisi.");
    }


    /* -----------------------------------------------------
       TRANSACTION → PAID
    ----------------------------------------------------- */

    $sql = "
        UPDATE transactions
        SET payment_status = 'Paid'
        WHERE transaction_id = ?
          AND booking_id = ?
    ";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Transaction error: " . $conn->error);
    }

    $stmt->bind_param(
        "ii",
        $transaction_id,
        $booking_id
    );

    $stmt->execute();
    $stmt->close();


    /* -----------------------------------------------------
       BOOKING → APPROVED
    ----------------------------------------------------- */

    $sql = "
        UPDATE bookings
        SET status = 'Approved'
        WHERE booking_id = ?
    ";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Booking error: " . $conn->error);
    }

    $stmt->bind_param(
        "i",
        $booking_id
    );

    $stmt->execute();
    $stmt->close();


    /* -----------------------------------------------------
       CARD → PROCESSING PAGE
    ----------------------------------------------------- */

    header(
        "Location: processing_payment.php"
        . "?booking_id=" . $booking_id
        . "&transaction_id=" . $transaction_id
    );

    exit;
}


/* =========================================================
   CASH PAYMENT
========================================================= */

if ($payment_type === 'Cash') {

    /* -----------------------------------------------------
       TRANSACTION → PENDING
    ----------------------------------------------------- */

    $sql = "
        UPDATE transactions
        SET payment_status = 'Pending'
        WHERE transaction_id = ?
          AND booking_id = ?
    ";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Transaction error: " . $conn->error);
    }

    $stmt->bind_param(
        "ii",
        $transaction_id,
        $booking_id
    );

    $stmt->execute();
    $stmt->close();


    /* -----------------------------------------------------
       BOOKING → PENDING
    ----------------------------------------------------- */

    $sql = "
        UPDATE bookings
        SET status = 'Pending'
        WHERE booking_id = ?
    ";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Booking error: " . $conn->error);
    }

    $stmt->bind_param(
        "i",
        $booking_id
    );

    $stmt->execute();
    $stmt->close();


    /* -----------------------------------------------------
       CASH → DIRECTLY TO CONFIRMATION
    ----------------------------------------------------- */

    header(
        "Location: confirmation_payment.php"
        . "?booking_id=" . $booking_id
        . "&transaction_id=" . $transaction_id
    );

    exit;
}

?>