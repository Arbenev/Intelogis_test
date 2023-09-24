<?php

// Для эмуляции транспортных компаний
$fprotocol = filter_input(INPUT_SERVER, 'SERVER_PROTOCOL');
$fport = filter_input(INPUT_SERVER, 'SERVER_PORT');
$fhttps = filter_input(INPUT_SERVER, 'HTTPS');
$fproto = filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED_PROTO');
$fssl = filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED_SSL');
$protocol = strtolower(substr($fprotocol, 0, 5)) == 'https' ? 'https' : 'http';
if ($fport == 443) {
    $protocol = 'https';
} elseif (isset($fhttps) && (($fhttps == 'on') || ($fhttps == '1'))) {
    $protocol = 'https';
} elseif (!empty($fproto) && $fproto == 'https' || !empty($fssl) && $fssl == 'on') {
    $protocol = 'https';
}
$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$companyUrlPrefix = $protocol . '://' . $host;

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'delivers' => [
        'banat' => [
            'name' => 'Banat trans',
            'url' => $companyUrlPrefix . '/trans/banat',
        ],
        'dhl' => [
            'name' => 'DHL',
            'url' => $companyUrlPrefix . '/trans/dhl',
        ],
        'rpost' => [
            'name' => 'Russian post',
            'url' => $companyUrlPrefix . '/trans/rpost',
        ],
    ],
    'deliveryBasePrice' => 150,
];
