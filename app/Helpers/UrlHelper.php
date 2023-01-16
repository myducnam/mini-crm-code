<?php

if (! function_exists('image_url')) {
    function image_url(string $path)
    {
        if (app()->isLocal()) {
            return sprintf('/storage/%s', $path);
        }

        return config('image.url') . '/' . $path;
    }
}
