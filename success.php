<?php
session_start(); // Inicia la sesión

use Stripe\Stripe;

require 'vendor/autoload.php';

Stripe::setApiKey('sk_test_51NAwioAyrC2HtajDauOjeCDsBgfinxAeO8uEu89WagyOlWqDtg5gNt3vIHhh1LwOZoxprbm6zyDv5yTQ2OBC8yUS006EaEdJ52');

$transaction_id = NULL;

if (isset($_SESSION['session_id'])) {
    $session_id = $_SESSION['session_id'];

    try {
        $session = \Stripe\Checkout\Session::retrieve($session_id);

        if ($session->payment_status == 'paid') {
            $transaction_id = $session->payment_intent;
        } else {
            echo 'La transacción no fue exitosa.';
            exit();
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
        exit();
    }
} else {
    echo 'Transacción no válida.';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprado</title>
</head>

<body>
    <h1>Vientos, lo compraste</h1>
    <?php
    if (isset($transaction_id)) {
        echo "<p>ID de la transacción: " . $transaction_id . "</p>";
    } else {
        echo "<p>Transacción no válida.</p>";
    }
    ?>
</body>

</html>