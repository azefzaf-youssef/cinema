<?php



function atouts($path, $version = false)
{
    if ($version) {

        return app('url')->asset($path, config('app.https')) . '?v=' . config('app.version');
    }

    return app('url')->asset($path, config('app.https'));
}
