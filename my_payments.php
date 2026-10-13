<?php
require_once "config.php";

function h($value) {
    return htmlspecialchars((string)($value ?? ""), ENT_QUOTES, "UTF-8");
}

function paymentDisplayStatus($paymentStatus, $transactionStatus) {
    $p = strtolower(trim((string)$paymentStatus));
    $t = strtolower(trim((string)$transactionStatus));

    if (
        in_array($t, ["paid", "success", "completed"], true) ||
        in_array($p, ["success", "paid", "completed"], true)
    ) {
        return "Success";
    }

    if (
        in_array($t, ["cancelled", "canceled"], true) ||
        in_array($p, ["cancelled", "canceled"], true)
    ) {
        return "Cancelled";
    }

    if ($p === "failed" || $t === "failed") {
        return "Failed";
    }

    return "Pending";
}

$sql = "
    SELECT
        p.payment_id,
        p.transaction_id,
        p.payment_type,
        p.payment_date,
        p.status AS payment_status,
        t.booking_id,
        t.total_amount,
        t.payment_status AS transaction_status
    FROM payments p
    LEFT JOIN transactions t
        ON p.transaction_id = t.transaction_id
    ORDER BY p.payment_id DESC
";

$result = $conn->query($sql);

if (!$result) {
    die("Unable to load payments. Please check your database columns.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Payment History</title>

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 40px 24px;
    font-family: Arial, Helvetica, sans-serif;
    background: #f3f7fc;
    color: #102b50;
}

.container {
    max-width: 1450px;
    margin: auto;
}

.eyebrow {
    color: #1685f8;
    font-size: 14px;
    font-weight: bold;
    letter-spacing: 3px;
    margin-bottom: 12px;
}

h1 {
    font-size: 38px;
    margin: 0 0 12px;
}

.subtitle {
    color: #7b8da7;
    font-size: 17px;
    margin-bottom: 40px;
}

.payment-card {
    background: white;
    border-radius: 24px;
    padding: 32px;
    box-shadow: 0 12px 40px rgba(30,65,100,.06);
}

.card-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    margin-bottom: 28px;
}

.card-heading h2 {
    margin: 0;
    font-size: 25px;
}

.count {
    background: #edf5ff;
    color: #1685f8;
    padding: 14px 20px;
    border-radius: 14px;
    font-weight: bold;
    white-space: nowrap;
}

.table-wrap {
    overflow-x: auto;
}

table {
    width: 100%;
    min-width: 1000px;
    border-collapse: collapse;
}

thead {
    background: #f3f7fc;
}

th {
    padding: 18px 14px;
    text-align: left;
    color: #71839e;
    font-size: 14px;
    white-space: nowrap;
}

td {
    padding: 22px 14px;
    border-bottom: 1px solid #e5edf7;
    font-size: 15px;
    vertical-align: middle;
}

.status {
    display: inline-block;
    padding: 9px 14px;
    border-radius: 22px;
    font-size: 13px;
    font-weight: bold;
}

.status-success {
    color: #119c70;
    background: #e5f8ef;
}

.status-pending {
    color: #b77912;
    background: #fff4d8;
}

.status-failed {
    color: #c62828;
    background: #ffebeb;
}

.status-cancelled {
    color: #c62828;
    background: #ffebeb;
}

.actions {
    display: flex;
    gap: 8px;
}

.btn {
    display: inline-block;
    padding: 10px 14px;
    border: 0;
    border-radius: 9px;
    font-size: 13px;
    font-weight: bold;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
}

.btn-edit {
    background: #eaf3ff;
    color: #1685f8;
}

.btn-cancel {
    background: #fff0f0;
    color: #d14343;
}

.btn-disabled {
    background: #f0f2f5;
    color: #8994a3;
}

.empty {
    padding: 50px 20px;
    text-align: center;
    color: #7b8da7;
}

.back {
    display: inline-block;
    margin-top: 24px;
    color: #1685f8;
    font-weight: bold;
    text-decoration: none;
}

@media (max-width: 600px) {
    body {
        padding: 22px 12px;
    }

    .payment-card {
        padding: 20px 14px;
    }

    h1 {
        font-size: 30px;
    }

    .card-heading {
        align-items: flex-start;
        flex-direction: column;
    }
}
</style>
</head>

<body>
<div class="container">

    <div class="eyebrow">YOUR ACCOUNT</div>
    <h1>Payment History</h1>
    <div class="subtitle">
        View and manage your travel booking payments.
    </div>

    <div class="payment-card">

        <div class="card-heading">
            <h2>Payment Transactions</h2>
            <div class="count">
                <?= $result->num_rows ?> Payments
            </div>
        </div>

        <?php if ($result->num_rows > 0): ?>

        <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Booking</th>
                    <th>Transaction</th>
                    <th>Payment Method</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Payment Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            <?php while ($row = $result->fetch_assoc()): ?>

                <?php
                $paymentStatus = strtolower(
                    trim((string)($row["payment_status"] ?? ""))
                );

                $transactionStatus = strtolower(
                    trim((string)($row["transaction_status"] ?? ""))
                );

                $status = paymentDisplayStatus(
                    $paymentStatus,
                    $transactionStatus
                );

                /*
                 * Show Edit and Cancel when:
                 * - payment status is Pending or Failed
                 * - transaction status is still Pending
                 *
                 * A transaction already marked Paid/Success
                 * cannot be edited or cancelled here.
                 */
                $canManage =
                    in_array($paymentStatus, ["pending", "failed"], true)
                    && $transactionStatus === "pending";

                $statusClass = strtolower($status);
                ?>

                <tr>
                    <td>
                        <strong>#<?= h($row["payment_id"]) ?></strong>
                    </td>

                    <td>
                        #<?= h($row["booking_id"] ?? "-") ?>
                    </td>

                    <td>
                        #<?= h($row["transaction_id"]) ?>
                    </td>

                    <td>
                        <?= h($row["payment_type"]) ?>
                    </td>

                    <td>
                        <strong>
                            <?= rupiah($row["total_amount"] ?? 0) ?>
                        </strong>
                    </td>

                    <td>
                        <span class="status status-<?= h($statusClass) ?>">
                            <?= h($status) ?>
                        </span>
                    </td>

                    <td>
                        <?= !empty($row["payment_date"])
                            ? h(tanggal($row["payment_date"]))
                            : "-" ?>
                    </td>

                    <td>
                        <div class="actions">

                        <?php if ($canManage): ?>

                            <a
                                class="btn btn-edit"
                                href="edit_payment.php?payment_id=<?= (int)$row["payment_id"] ?>"
                            >
                                Edit
                            </a>

                            <a
                                class="btn btn-cancel"
                                href="cancel_payment.php?payment_id=<?= (int)$row["payment_id"] ?>"
                                onclick="return confirm('Are you sure you want to cancel this payment?');"
                            >
                                Cancel
                            </a>

                        <?php elseif ($status === "Success"): ?>

                            <span class="btn btn-disabled">
                                Completed
                            </span>

                        <?php else: ?>

                            <span class="btn btn-disabled">
                                Unavailable
                            </span>

                        <?php endif; ?>

                        </div>
                    </td>
                </tr>

            <?php endwhile; ?>

            </tbody>
        </table>
        </div>

        <?php else: ?>

            <div class="empty">
                <h3>No Payments Yet</h3>
                <p>
                    Your payment transactions will appear here after checkout.
                </p>
            </div>

        <?php endif; ?>

    </div>

    <a class="back" href="booking.php">
        ← Back to Booking
    </a>

</div>
</body>
</html>
