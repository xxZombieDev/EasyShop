<?php 
/**
 * Archivo de configuració
 * @var URL_SITIO define la ruta de nuestro proyecto para configurar el exito o no de
 * la transacción
 */
define('URL_SITIO', '');

// importación de paquetes de composer
require 'paypal/autoload.php';

// agregamos las llaves del cliente y la secreta para trabajar con la API REST de PAYPAL
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        '',// ClientID
        '' // ClientSecret
    )
);

