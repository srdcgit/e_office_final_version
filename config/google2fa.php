<?php

// return [

//     /*
//      * Enable / disable Google2FA.
//      */
//     'enabled' => env('OTP_ENABLED', true),
//     /*
//      * Lifetime in minutes.
//      *
//      * In case you need your users to be asked for a new one time passwords from time to time.
//      */
//     'lifetime' => env('OTP_LIFETIME', 0), // 0 = eternal

//     /*
//      * Renew lifetime at every new request.
//      */
//     'keep_alive' => env('OTP_KEEP_ALIVE', true),

//     /*
//      * Auth container binding.
//      */
//     'auth' => 'auth',

//     /*
//      * Guard.
//      */
//     'guard' => '',

//     /*
//      * 2FA verified session var.
//      */

//     'session_var' => 'google2fa',

//     /*
//      * One Time Password request input name.
//      */
//     'otp_input' => 'one_time_password',

//     /*
//      * One Time Password Window.
//      */
//     'window' => 1,

//     /*
//      * Forbid user to reuse One Time Passwords.
//      */
//     'forbid_old_passwords' => false,

//     /*
//      * User's table column for google2fa secret.
//      */
//     'otp_secret_column' => 'google2fa_secret',

//     /*
//      * One Time Password View.
//      */
//     'view' => 'google2fa.index',
//     /*
//  * One Time Password View.
//  */
// 'view' => 'auth.2fa_verify',

//     /*
//      * One Time Password error message.
//      */
//     'error_messages' => [
//         'wrong_otp'       => "The 'One Time Password' typed was wrong.",
//         'cannot_be_empty' => 'One Time Password cannot be empty.',
//         'unknown'         => 'An unknown error has occurred. Please try again.',
//     ],

//     /*
//      * Throw exceptions or just fire events?
//      */
//     'throw_exceptions' => env('OTP_THROW_EXCEPTION', true),

//     /*
//      * Which image backend to use for generating QR codes?
//      *
//      * Supports imagemagick, svg and eps
//      */
//     'qrcode_image_backend' => \PragmaRX\Google2FALaravel\Support\Constants::QRCODE_IMAGE_BACKEND_IMAGEMAGICK,

// ];

return [
    'application_name' => env('GOOGLE_APPLICATION_NAME', 'Laravel Google Sheets'),
    'client_id'        => env('GOOGLE_CLIENT_ID'),
    'client_secret'    => env('GOOGLE_CLIENT_SECRET'),
    'redirect_uri'     => env('GOOGLE_REDIRECT_URI'),
    'scopes'           => [Google_Service_Sheets::SPREADSHEETS],
    'access_type'      => 'offline',
    'approval_prompt'  => 'force',
    'service'          => [
        'enable' => true,
        'file'   => env('GOOGLE_APPLICATION_CREDENTIALS'),
    ],
    'spreadsheet_id' => env('GOOGLE_SHEETS_ID'),
];
