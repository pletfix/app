<?php

return [

    /**
     * ----------------------------------------------------------------
     * Session Name
     * ----------------------------------------------------------------
     *
     * Here you may change the name of the PHP session.
     */

    'name' => 'pletfix_session',

    /**
     * ----------------------------------------------------------------
     * Session Lifetime
     * ----------------------------------------------------------------
     *
     * Lifetime of the session cookie, defined in minutes.
     * The value 0 means "until the browser is closed."
     */

    'lifetime' => 120,

    /**
     * ----------------------------------------------------------------
     * Session Cookie Path
     * ----------------------------------------------------------------
     *
     * Path on the domain where the cookie will work.
     * Use a single slash ('/') for all paths on the domain.
     */

    'path' => '/',

    /**
     * ----------------------------------------------------------------
     * Session Cookie Domain
     * ----------------------------------------------------------------
     *
     * Cookie domain, for example 'www.php.net'. To make cookies visible
     * on all subdomains then the domain must be prefixed with a dot
     * like '.php.net'.
     * Default is none at all meaning the host name of the server which
     * generated the cookie according to cookies specification.
     */

    'domain' => env('SESSION_DOMAIN', null),

    /**
     * ----------------------------------------------------------------
     * HTTPS Only Cookies
     * ----------------------------------------------------------------
     *
     * If TRUE cookie will only be sent over secure connections.
     */

    'secure' => false,

    /**
     * ----------------------------------------------------------------
     * HTTP Access Only
     * ----------------------------------------------------------------
     *
     * If set to TRUE then PHP will attempt to send the httponly flag
     * when setting the session cookie.
     */

    'http_only' => true,

];
