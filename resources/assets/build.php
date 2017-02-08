<?php

return [

    'js/app.js' => [
        vendor_path('npm-asset/jquery/dist/jquery.min.js'),
        vendor_path('npm-asset/bootstrap/dist/js/bootstrap.min.js'),
        vendor_path('npm-asset/moment/moment.js'),
        vendor_path('npm-asset/moment/locale/de.js'),
        vendor_path('npm-asset/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'),
        vendor_path('npm-asset/selectize/dist/js/standalone/selectize.min.js'),
        resource_path('assets/js/modal.js'),
        resource_path('assets/js/base.js'),
    ],

    'css/app.css' => [
        vendor_path('npm-asset/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'),
        vendor_path('npm-asset/selectize/dist/css/selectize.bootstrap3.css'),
        resource_path('assets/less/base.less'),
    ],

    'css/error.css' => [
        resource_path('assets/less/error.less'),
    ],

    'fonts' => [
        resource_path('assets/fonts'),
        vendor_path('npm-asset/bootstrap/dist/fonts'),
        vendor_path('npm-asset/font-awesome/fonts'),
    ],

];