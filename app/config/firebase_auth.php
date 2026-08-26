<?php

function base64UrlEncode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

/** The service account this project sends notifications as. */
function getFirebaseServiceAccount() {
    static $serviceAccount = null;
    if ($serviceAccount === null) {
        $serviceAccount = json_decode(
            file_get_contents(__DIR__ . '/firebase-service-account.json'),
            true
        );
    }
    return $serviceAccount;
}

/**
 * The Firebase project id, taken from the service account rather than repeated as a
 * literal in every controller that sends a notification.
 */
function getFirebaseProjectId() {
    $serviceAccount = getFirebaseServiceAccount();
    return isset($serviceAccount['project_id']) ? $serviceAccount['project_id'] : null;
}

function getFirebaseAccessToken() {
    // Google issues these for an hour. Minting a new one for every notification meant
    // an extra round trip to oauth2.googleapis.com before each send, so it is kept
    // until shortly before it expires.
    static $cached = null;
    static $cachedUntil = 0;
    if ($cached !== null && time() < $cachedUntil) {
        return $cached;
    }

    $serviceAccount = getFirebaseServiceAccount();

    $now = time();

    $header = [
        'alg' => 'RS256',
        'typ' => 'JWT'
    ];

    $payload = [
        'iss'   => $serviceAccount['client_email'],
        'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
        'aud'   => 'https://oauth2.googleapis.com/token',
        'iat'   => $now,
        'exp'   => $now + 3600
    ];

    $base64Header  = base64UrlEncode(json_encode($header));
    $base64Payload = base64UrlEncode(json_encode($payload));

    $signatureInput = $base64Header . "." . $base64Payload;

    openssl_sign(
        $signatureInput,
        $signature,
        $serviceAccount['private_key'],
        'SHA256'
    );

    $jwt = $signatureInput . "." . base64UrlEncode($signature);

    // Exchange JWT for Access Token
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://oauth2.googleapis.com/token');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
        'assertion'  => $jwt
    ]));

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    if (!isset($data['access_token'])) {
        return null;
    }

    $expiresIn = isset($data['expires_in']) ? (int) $data['expires_in'] : 3600;
    $cached = $data['access_token'];
    // A minute of slack so a token cannot expire mid send.
    $cachedUntil = time() + max(60, $expiresIn - 60);

    return $cached;
}
