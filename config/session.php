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
     * Session Cookie Lifetime
     * ----------------------------------------------------------------
     *
     * The lifetime of the session cookie is defined in minutes.
     *
     * The value 0 means "until the browser is closed."
     *
     * The upper limit, which is still useful, depends on the setting of
     * session.gc_maxlifetime in php.ini.
     */

    'lifetime' => 120, // minutes

    /**
     * ----------------------------------------------------------------
     * Session Cookie Path
     * ----------------------------------------------------------------
     *
     * Path on the domain where the cookie will work.
     *
     * Use a single slash ('/') for all paths on the domain.
     * The base directory of the application is used if omit this setting.
     */

    //'path' => null,

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

    //'domain' => null,

    /**
     * ----------------------------------------------------------------
     * HTTPS Only Cookies
     * ----------------------------------------------------------------
     *
     * If TRUE cookie will only be sent over secure connections.
     */

    //'secure' => false,

    /**
     * ----------------------------------------------------------------
     * HTTP Access Only
     * ----------------------------------------------------------------
     *
     * If set to TRUE then PHP will attempt to send the httponly flag
     * when setting the session cookie.
     */

    //'http_only' => true,

];