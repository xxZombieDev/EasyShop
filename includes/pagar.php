<?php
/**
 * @author Ray Garcia Gonzalez
 */
#Importacion de Paquetes de el SDK de Paypal mediante namespaces (use) 
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

//importamos las keys para trabajar con Paypal
require 'config.php';
 
//Llamado mediante POST a los elementos del formulario
$producto = $_POST['descripcion'];
$precio = $_POST['total'];
$envio = 0; // requerido por paypal
$total = $precio + $envio; /// requerido por paypal

// Establecemos el metodo de pago
$compra = new Payer();
$compra->setPaymentMethod('paypal');

// establecemos el producto a comprar
$articulo = new Item();
$articulo->setName($producto)
      ->setCurrency('MXN') // tipo moneda
      ->setQuantity(1) // cantidad, solo 1 para prueba
      ->setPrice($precio); // Precio del producto
      
// Preparamos la lista de articulos a pagar      
$listaArticulos = new ItemList();
$listaArticulos->setItems(array($articulo));
  
// Preparamos los detalles de la venta, subtotal y envio
$detalles = new Details();
$detalles->setShipping($envio)
          ->setSubtotal($precio); 
          
//enviamos el monto a pagar
$cantidad = new Amount();
$cantidad->setCurrency('MXN')
          ->setTotal($total)
          ->setDetails($detalles);
 
 //Preparamos la transacción final para hacer el envio a paypal         
$transaccion = new Transaction();
$transaccion->setAmount($cantidad)
               ->setItemList($listaArticulos)
               ->setDescription('Pago ')
               ->setInvoiceNumber(uniqid());
               

 // Preparamos el direccionamiento en caso de que el cliente decida aceptar
 // o cancelar la compra              
$redireccionar = new RedirectUrls();
// Si decida pagar y fue exitosa la transacción enviamos a este link
$redireccionar->setReturnUrl(URL_SITIO . "/includes/pago_finalizado.php?exito=true")
              ->setCancelUrl(URL_SITIO . "/includes/pago_finalizado.php?exito=false");
              // en caso contrario lo enviamos por este
              
//enviamos a la plataforma de paypal  a realizar el pago              
$pago = new Payment();
$pago->setIntent("sale")
     ->setPayer($compra)
     ->setRedirectUrls($redireccionar)
     ->setTransactions(array($transaccion));
     //revisamos la conexion al servidor de paypal y enviamos las apis
     try {
       $pago->create($apiContext);
     } catch (PayPal\Exception\PayPalConnectionException $pce) {
       // Don't spit out errors or use "exit" like this in production code
       echo '<pre>';print_r(json_decode($pce->getData()));exit;
   }

$aprobado = $pago->getApprovalLink();

header("Location: {$aprobado}");