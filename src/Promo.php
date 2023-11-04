<?php

namespace Fintech\Promo;

use Fintech\Promo\Services\PromotionService;

class Promo
{
    public function promotion()
    {
        return app(PromotionService::class);
    }

    //** Crud Service Method Point Do not Remove **//
}
