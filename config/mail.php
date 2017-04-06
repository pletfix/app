<?php

return [

    /**
     * ----------------------------------------------------------------
     * Default Sender Address
     * ----------------------------------------------------------------
     *
     * Here you can specify a default sender address.
     *
     * The formatting of the address must comply with RFC 2822, e.g.:
     *      "user@example.com"
     *      "User <user@example.com>"
     */

    'from' => env('MAIL_FROM'),

    /**
     * ----------------------------------------------------------------
     * Default Reply-To Address
     * ----------------------------------------------------------------
     *
     * Here you can specify the default reply-to address.
     *
     * If you omit this address, "from" will be used.
     *
     * The formatting of the address must comply with RFC 2822, e.g.:
     *      "user@example.com"
     *      "user@example.com, anotheruser@example.com"
     *      "User <user@example.com>"
     *      "User <user@example.com>, Another User <anotheruser@example.com>"
     */

    'reply_to' => env('MAIL_REPLY_TO'),

    /**
     * ----------------------------------------------------------------
     * Pretended Mail
     * ----------------------------------------------------------------
     *
     * When this option is enabled, the mail will not be sent over the
     * web and will instead be written to your application's logs files
     * so you may inspect the message.
     */

    'pretend' => false,

];
