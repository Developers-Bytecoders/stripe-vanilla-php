<?php
session_start(); // Inicia la sesión

use Stripe\Stripe;

require 'vendor/autoload.php';

Stripe::setApiKey('sk_test_51NC5pmE0V2g8pavSgChJSRgS3LCUY8Bl2FLLoLnUCS7EhSYFXjdIZOjw2fbMPDc4NzgYGls1BIV0ce8SjCnadcOJ00couyTAmq');

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
        //unset($_SESSION['session_id']);
    } else {
        echo "<p>Transacción no válida.</p>";
    }
    ?>
</body>

</html>