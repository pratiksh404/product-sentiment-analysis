<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Sentimentality extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sentimentality';
    }

    /**
     * Resolve a new instance for the facade.
     *
     * @return mixed
     */
    public static function refresh()
    {
        static::clearResolvedInstance(static::getFacadeAccessor());

        return static::getFacadeRoot();
    }
}
