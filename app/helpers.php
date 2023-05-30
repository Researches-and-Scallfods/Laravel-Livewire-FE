<?php

if (!function_exists('cms_asset')) {
    function cms_asset($path)
    {
        return config('app.cms_url') . '/storage/' . $path;
    }
}
