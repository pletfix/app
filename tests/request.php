<?php

echo '<hr/>';

$request = request();

dump([
    'fullUrl'   => $request->fullUrl(),
    'url'       => $request->url(),
    'baseUrl'   => $request->baseUrl(),
    'path'      => $request->path(),
    'input'     => $request->input(),
    'file'      => $request->file(),
    'body'      => $request->body(),
    'method'    => $request->method(),
    'ip'        => $request->ip(),
    'isSecure'  => $request->isSecure(),
    'isAjax'    => $request->isAjax(),
    'isJson'    => $request->isJson(),
    'wantsJson' => $request->wantsJson(),
]);

echo '<hr/>';