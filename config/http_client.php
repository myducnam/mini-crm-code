<?php

return [
    'retry' => env('HTTP_CLIENT_RETRY', 3),
    'delay' => env('HTTP_CLIENT_DELAY', 5000)
];
