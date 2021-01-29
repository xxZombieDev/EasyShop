<?php 
/**
 * Archivo de configuració
 * @var URL_SITIO define la ruta de nuestro proyecto para configurar el exito o no de
 * la transacción
 */
define('URL_SITIO', 'http://localhost/MiTienditaWeb');

// importación de paquetes de composer
require 'paypal/autoload.php';

// agregamos las llaves del cliente y la secreta para trabajar con la API REST de PAYPAL
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AdOx3hnyQxfdS0Ff-wLpLCMvKTI9kEojYASGRQ5pdYBa9ewPjqOfWqKvPHY3usSPCN1-2Tf03a_4Dg97',// ClientID
        'EMget11LoumNRJgrJq_ls3Yt2DYTZD2yOeEwOlhkhKc1QViIi0THDt_FbzXpxJd6B69hCp32ePjNuZ6d' // ClientSecret
    )
);

