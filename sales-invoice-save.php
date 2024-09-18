<?php
    include "conf.php";

	$timestamp = time();
	$signature = hash_hmac('sha256', $timestamp, $signatureSecret);

    // Header
    $header = array(
        "Authorization: Bearer $apiToken",
		"X-Api-Timestamp: $timestamp",
		"X-Api-Signature: $signature",
		"X-Language-Profile: US",
        "Content-Type: application/json"
    );

    // Content
    $content = array(
        "customerNo" => "C.00001",
        "transDate" => date("d/m/yy"),
        "detailItem" => array(
            array(
                "itemNo" => "100001",
                "quantity" => 15,
                "unitPrice" => 8000
            ),
            array(
                "itemNo" => "100002",
                "quantity" => 8,
                "unitPrice" => 8500
            )
        )
    );

    // URL
    $url = "$host/accurate/api/sales-invoice/save.do";

    // Connect API
    $opts = array("http" =>
        array(
            "method"  => "POST",
            "header"  => $header,
            "content" => json_encode($content),
            "ignore_errors" => true,
        )
    );
    $context  = stream_context_create($opts);
    $response = file_get_contents($url, false, $context);

    // Output
	echo $response;
?>