<?php

namespace Fintech\Promo;

use Fintech\Promo\Services\PromotionService;

class Promo
{
    public function promotion($filters = null)
    {
        return \singleton(PromotionService::class, $filters);
    }

    //** Crud Service Method Point Do not Remove **//
}
