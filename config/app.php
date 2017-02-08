<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    */

    'name' => 'Stadtkonfetti',

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    | Available Settings: "local", "staging", production", "testing"
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'Europe/Berlin',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'de',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC', // bisherals Constante: MCRYPT_RIJNDAEL_128,

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log settings for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Settings:
    | type:         Can be set to "single", "daily", "syslog" or "errorlog"
    | level:        The minimum PSR-3 logging level at which this handler will be triggered.
    |               Can be set to "debug", "info", "notice", "warning", "error", "critical", "alert" or "emergency"
    | max_files:    Only for daily log: Maximum files to use in the daily logging format (0 means unlimited).
    | permission:   Optional file permissions (null == 0644 are only for owner read/write)
    |
    */

    //'log' => 'daily',
    //'log' => env('APP_LOG', 'single'),
    'log' => [
        'type'       => env('LOG_TYPE',  'daily'),
        'level'      => env('LOG_LEVEL', 'debug'),
        'max_files'  => 5,
        'app_file'   => 'app.log',
        'cli_file'   => 'cli.log',
        'permission' => 0664,
    ],

    /*
    |--------------------------------------------------------------------------
    | Time and date formats
    |--------------------------------------------------------------------------
    |
    | These settings define the date and time formats that are used all over the project.
    |
    */

    'date_formats' => [
        'de' => [
            'date'     => 'd.m.Y',
            'time'     => 'H:i',
            'datetime' => 'd.m.Y H:i',
        ],
        'en' => [
            'date'     => 'Y-m-d',
            'time'     => 'H:i',
            'datetime' => 'Y-m-d H:i',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Adverts
    |--------------------------------------------------------------------------
    |
    | Number of adverts per frame.
    |
    */

    'max_adverts_right' => 5,

    /*
    |--------------------------------------------------------------------------
    | Google Analytics
    |--------------------------------------------------------------------------
    |
    | If you haven't already done so, set up a Google Analtyics property:
    |   https://support.google.com/analytics/answer/1042508
    |
    | View the Google Analytics Dashboard:
    |   https://www.google.com/analytics/web
    |
    */

    'google_analytics_tracking_id' => env('GOOGLE_ANALYTICS_TRACKING_ID'),

    /*
    |--------------------------------------------------------------------------
    | Google API Key for Browser
    |--------------------------------------------------------------------------
    |
    | Order a API Key for Google Maps Javascript API here:
    |   https://developers.google.com/maps
    |
    */

    'google_api_browser_key' => env('GOOGLE_API_BROWSER_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Google API Key for Server
    |--------------------------------------------------------------------------
    |
    | Order a API Key for Google Maps Geocoding API here:
    |   https://developers.google.com/maps
    |
    */

    'google_api_server_key' => env('GOOGLE_API_SERVER_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Google AdSense
    |--------------------------------------------------------------------------
    |
    | See https://www.google.com/adsense/new/u/0/pub-8674118511227553/home
    |
    */

    'google_ad_client' => env('GOOGLE_AD_CLIENT'),

    /*
    |--------------------------------------------------------------------------
    | Blogfoster
    |--------------------------------------------------------------------------
    |
    | See https://app.blogfoster.com/websites/7785/insights/integration-instructions
    |
    */

    'blogfoster_website_id' => env('BLOGFOSTER_WEBSITE_ID'),
    'blogfoster_adslot_id'  => env('BLOGFOSTER_ADSLOT_ID'),

];
