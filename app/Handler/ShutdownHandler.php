<?php

namespace App\Handler;

use Core\Handler\Contracts\Handler as HandlerContract;

class ShutdownHandler implements HandlerContract
{
    /**
     * Handle the PHP shutdown event.
     *
     * @return void
     */
    public function handle()
    {
//        echo 'Shutdown...';
    }
}
