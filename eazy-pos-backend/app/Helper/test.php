<?php

namespace App\Helper;

use Firebase\JWT\JWT;

class JWTToken {

public function CreateToken(array $payload, string $secretKey): string 
{
    $issuedAt       = time();
    $expirationTime = $issuedAt + 3600*24; 

    $token = [
        'iss'       => 'laravel-token',
        'iat'  => $issuedAt,
        'exp'  => $expirationTime, 
        'data' => $payload, 
    ];

    return JWT::encode($token, $secretKey, 'HS256');
}
}
