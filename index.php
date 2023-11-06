<?php

require_once __DIR__ . '/vendor/autoload.php';

// =====================================================================

// SETUP

$asaasKey = '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNjg2MzM6OiRhYWNoXzkxMDJiY2JiLWFjODktNGQwNS1hNDJjLTY0N2FlMmVlNzcyNg==';

$connector = new \Asaas\AsaasConnector($asaasKey, false);

// =====================================================================

// CUSTOMER

$customer = (new \Asaas\Entities\Customer(
    name: 'Sergio Danilo Jr',
    cpfCnpj: '05506426500',
    phone: '41992885586'
));

$response = $connector->send(new Asaas\Requests\Customer\Create($customer));

$customerId = $response->json('id');

// =====================================================================

// CREDIT CARD

// =====================================================================

// PAYMENT
$dueDate = (new DateTime())
    ->setTimezone((new DateTimeZone("America/Sao_Paulo")))
    ->setTime(0, 0);

$payment = (new \Asaas\Entities\Payment(
    customer: $customerId,
    value: 12.5,
    dueDate: $dueDate,
    billingType: \Asaas\Enums\BillingType::BOLETO,
    description: 'Pagamento Teste no Boleto'
));

$request = new \Asaas\Requests\Payments\Create($payment);
$response = $connector->send($request);

$paymentId = $response->json('id');

//$qrCodeRequest = new \Asaas\Requests\Payments\PixQRCode($paymentId);
//$responsePix = $connector->send($qrCodeRequest);

$slipRequest = new \Asaas\Requests\Payments\SlipBarCode($paymentId);
$responseSlip = $connector->send($slipRequest);

dd(
    // $responsePix->json(),
    $responseSlip->json(),
    $response->status(),
    $response->clientError(),
    $response->json(),
);
