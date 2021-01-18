<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 是否开启
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    'enabled' => env('JWT_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Secret
    |--------------------------------------------------------------------------
    |
    | Don't forget to set this in your .env file, as it will be used to sign
    | your tokens. A helper command is provided for this:
    | `php artisan jwt:secret`
    |
    | Note: This will be used for Symmetric algorithms only (HMAC),
    */

    'secret' => env('JWT_SECRET', '75HkSDxkHgDAthb0'),

    // jwt token 的协议头键名
    'header_key' => env('JWT_HEADER_KEY', 'Authorization')
];
