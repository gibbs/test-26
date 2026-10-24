<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Resend, Postmark, AWS, and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'rick_and_morty' => [
        'url' => env('RICK_AND_MORTY_URL', 'https://rickandmortyapi.com/api'),
        'timeout' => (int) env('RICK_AND_MORTY_TIMEOUT', 5),
        'attempts' => (int) env('RICK_AND_MORTY_ATTEMPTS', 2),
        'cache' => [
            (int) env('RICK_AND_MORTY_CACHE_FRESH', 86400),
            (int) env('RICK_AND_MORTY_CACHE_EXPIRE', 604800),
        ],
    ],

    'imgproxy' => [
        'url' => env('IMGPROXY_URL'),
        'key' => env('IMGPROXY_KEY'),
        'salt' => env('IMGPROXY_SALT'),
    ],

];
