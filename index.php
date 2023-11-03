<?php

require_once __DIR__ . '/vendor/autoload.php';

// =====================================================================

// SETUP

$asaasKey = 'YOUR_KEY_HERE';

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
    billingType: \Asaas\Enums\BillingType::BOLETO
))->when(
        true,
        function (\Asaas\Entities\Payment $payment) {
            $payment->remoteIp('127.0.0.1');
        }
    )->withCardToken('baguá');

$request = new \Asaas\Requests\Payments\Create($payment);
$response = $connector->send($request);

dd(
    $response->status(),
    $response->clientError(),
    $response->json(),
);
