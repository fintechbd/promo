<?php

// config for Fintech/Promo
use Fintech\Promo\Models\Promotion;
use Fintech\Promo\Repositories\Eloquent\PromotionRepository;

return [

    /*
    |--------------------------------------------------------------------------
    | Enable Module APIs
    |--------------------------------------------------------------------------
    | this setting enable the api will be available or not
    */
    'enabled' => env('PROMO_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Promo Group Root Prefix
    |--------------------------------------------------------------------------
    |
    | This value will be added to all your routes from this package
    | Example: APP_URL/{root_prefix}/api/promo/action
    |
    | Note: while adding prefix add closing ending slash '/'
    */

    'root_prefix' => '',

    /*
    |--------------------------------------------------------------------------
    | Promotion Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'promotion_model' => Promotion::class,

    /*
    |--------------------------------------------------------------------------
    | Constant
    |--------------------------------------------------------------------------
    |
    | This value will be used across systems where a constant instance is needed
    */

    'promotion_types' => [
        'event' => 'Event',
        'news' => 'News',
        'partner' => 'Partner',
        'achievement' => 'Achievement',
        'media' => 'Media',
        'banner' => 'Banner',
    ],

    // ** Model Config Point Do not Remove **//

    /*
    |--------------------------------------------------------------------------
    | Repositories
    |--------------------------------------------------------------------------
    |
    | This value will be used across systems where a repository instance is needed
    */

    'repositories' => [
        \Fintech\Promo\Interfaces\PromotionRepository::class => PromotionRepository::class,

        // ** Repository Binding Config Point Do not Remove **//
    ],
];
