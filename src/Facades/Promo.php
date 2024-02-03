<?php

namespace Fintech\Promo\Facades;

use Fintech\Promo\Services\PromotionService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static PromotionService promotion()
 *                                             // Crud Service Method Point Do not Remove //
 *
 * @see \Fintech\Promo\Promo
 */
class Promo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Fintech\Promo\Promo::class;
    }
}
