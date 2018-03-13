<?php

if (! function_exists('asset')) {
    function asset($path)
    {
        $path = '/'.ltrim($path, '/');
        $manifestPath = base_path('public/mix-manifest.json');
        if (! file_exists($manifestPath)) {
            throw new \Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException($manifestPath);
        }

        $manifest = json_decode(file_get_contents($manifestPath), true);
        if (array_key_exists($path, $manifest)) {
            return url($manifest[$path]);
        }

        return url($path);
    }
}
