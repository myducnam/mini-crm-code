<?php

return [
    'display_count_per_page' => env('PAGINATION_DISPLAY_COUNT_PER_PAGE', 10),
    'count_options' => [15, 30, 60, 100],
    'default_page' => env('PAGINATION_DEFAULT_PAGE', 1)
];
