<?php

namespace EtoileFilante\Wikipediaravel;

use Illuminate\Support\Facades\Facade;

class WikipediaravelFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'wikipediaravel';
    }
}