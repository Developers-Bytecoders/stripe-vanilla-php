<?php
session_start(); // Inicia la sesión

$informacionPago = $_SESSION['pago'];
//echo "<pre>";
//    print_r($informacionPago);
//echo "</pre>";
use Stripe\Stripe;

require 'vendor/autoload.php';

Stripe::setApiKey('sk_test_51NC5pmE0V2g8pavSgChJSRgS3LCUY8Bl2FLLoLnUCS7EhSYFXjdIZOjw2fbMPDc4NzgYGls1BIV0ce8SjCnadcOJ00couyTAmq');

$transaction_id = NULL;

if (isset($informacionPago['session_id'])) {
    $session_id = $informacionPago['session_id'];

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
