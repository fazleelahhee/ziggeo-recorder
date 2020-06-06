<?php

namespace ZiggeoRecorder\Facades;

use Illuminate\Support\Facades\Facade;

class Ziggeo extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Ziggeo';
    }
}