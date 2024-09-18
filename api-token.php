<?php
    include "conf.php";

	$timestamp = time();
	$signature = hash_hmac('sha256', $timestamp, $signatureSecret);

    // Header
    $header = array(
        "Authorization: Bearer $apiToken",
		"X-Api-Timestamp: $timestamp",
		"X-Api-Signature: $signature",
		"X-Language-Profile: US"
    );

    // URL
    $url = "https://account.accurate.id/api/api-token.do";

    // Connect API
    $opts = array("http" =>
        array(
            "method" => "GET",
            "header" => $header,
            "ignore_errors" => true,
        )
    );
    $context  = stream_context_create($opts);
    $response = file_get_contents($url, false, $context);

    // Output
    echo $response;
?>