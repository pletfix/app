<?php

(new Core\Bootstraps\LoadConfiguration)->boot();
(new Core\Bootstraps\HandleExceptions)->boot();
(new Core\Bootstraps\HandleShutdown)->boot();
