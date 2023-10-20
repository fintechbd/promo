<?php

namespace Fintech\Promo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fintech\Promo\Promo
 */
class Promo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Fintech\Promo\Promo::class;
    }
}
