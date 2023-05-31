<?php
session_start(); // Inicia la sesión
// Primero, necesitamos cargar todas las bibliotecas necesarias.
// 'vendor/autoload.php' es un archivo generado por Composer que carga automáticamente todas las bibliotecas que hemos instalado.
require 'vendor/autoload.php';

// Establecemos la clave de API de Stripe.
// Esta clave se usa para autenticar nuestras solicitudes a la API de Stripe.
// Asegúrate de reemplazar 'sk_test_51NAwioAyrC2HtajDauOjeCDsBgfinxAeO8uEu89WagyOlWqDtg5gNt3vIHhh1LwOZoxprbm6zyDv5yTQ2OBC8yUS006EaEdJ52' con tu propia clave secreta de Stripe.
\Stripe\Stripe::setApiKey('sk_test_51NC5pmE0V2g8pavSgChJSRgS3LCUY8Bl2FLLoLnUCS7EhSYFXjdIZOjw2fbMPDc4NzgYGls1BIV0ce8SjCnadcOJ00couyTAmq');

// A continuación, creamos una nueva sesión de pago para el producto que queremos vender.
// Esta sesión de pago representa una transacción individual que el cliente va a realizar.
try {
    $checkout_session = \Stripe\Checkout\Session::create([
        // Establecemos los métodos de pago que aceptamos. En este caso, solo aceptamos tarjetas de crédito/débito.
        'payment_method_types' => ['card'],
        // Añadimos los productos que el cliente va a comprar en esta transacción.
        // Cada producto tiene un precio, una cantidad y un identificador de producto.
        // En este caso, solo estamos vendiendo un tipo de producto, pero podrías añadir más si quisieras.
        'line_items' => [[
            'price_data' => [
                // Especificamos la moneda en la que estamos vendiendo el producto.
                'currency' => 'mxn',
                // Este es el identificador del producto que estamos vendiendo. 
                // Debes reemplazar 'prod_NwraoU7vM7pvjP' con el identificador del producto que quieres vender.
                'product' => 'prod_Ny2GdudlR9stZA',
                // Especificamos el precio por unidad del producto. 
                // En este caso, el precio es de 2000 centavos, o 20.00 MXN.
                'unit_amount' => 2000,
            ],
            // Establecemos la cantidad del producto que el cliente va a comprar. 
            // En este caso, el cliente va a comprar 1 unidad del producto.
            'quantity' => 1,
        ]],
        // Establecemos el modo de la transacción a 'payment'. 
        // Esto significa que el cliente está realizando un pago único. 
        // Si estuvieras configurando una suscripción, cambiarías esto a 'subscription'.
        'mode' => 'payment',
        // Especificamos las URL a las que el cliente será redirigido después de completar o cancelar la transacción.
        // Debes reemplazar 'http://localhost/success.php' y 'http://localhost:8000/fails.php' con tus propias URL de éxito y cancelación.
        'success_url' => 'http://localhost/stripe/success.php',
        'cancel_url' => 'http://localhost/stripe/fails.php',
    ]);

    // Almacena el session_id en una variable de sesión
    $_SESSION['session_id'] = $checkout_session->id;
} catch (Exception $e) {
    // Si algo sale mal al crear la sesión de pago (por ejemplo, si las claves de API son incorrectas o si el identificador del producto no existe), 
    // se lanzará una excepción. Aquí capturamos esa excepción y mostramos el mensaje de error.
    echo 'Error: ' . $e->getMessage();
    // Después de mostrar el mensaje de error, terminamos la ejecución del script.
    // No queremos continuar si no podemos crear la sesión de pago.
    exit();
}

// Si todo va bien y la sesión de pago se crea correctamente, redirigimos al cliente a la página de pago de Stripe.
// La página de pago de Stripe es donde el cliente proporcionará los detalles de su tarjeta y finalizará la compra.
header('Location: ' . $checkout_session->url);
// Después de redirigir al cliente, terminamos la ejecución del script.
// No hay nada más que hacer aquí.
exit();
