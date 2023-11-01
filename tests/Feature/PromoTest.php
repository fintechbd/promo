<?php

use Illuminate\Database\Eloquent\Model as MYSQLDBLEBUPAY;
use Illuminate\Support\Str;
use MongoDB\Laravel\Eloquent\Model as MONGODB;

use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;

/**
 * @return MYSQLDBLEBUPAY|MONGODB|null
 */
function createPromotionEvent(): MYSQLDBLEBUPAY|MONGODB|null
{
    return \Fintech\Promo\Facades\Promo::promotion()->create([
        'present_country_id' => 1,
        'permanent_country_id' => 1,
        'name' => Str::random(20),
        'type' => 'event',
        'content' => Str::random(200),
        'link' => '',
        'promotion_data' => [
        ],
        'enabled' => '1',
    ]);
}

/**
 * @return MYSQLDBLEBUPAY|MONGODB|null
 */
function createPromotionNews(): MYSQLDBLEBUPAY|MONGODB|null
{
    return \Fintech\Promo\Facades\Promo::promotion()->create([
        'present_country_id' => 1,
        'permanent_country_id' => 1,
        'name' => Str::random(20),
        'type' => 'news',
        'content' => Str::random(200),
        'link' => '',
        'promotion_data' => [
        ],
        'enabled' => '1',
    ]);
}

/**
 * @return MYSQLDBLEBUPAY|MONGODB|null
 */
function createPromotionPartner(): MYSQLDBLEBUPAY|MONGODB|null
{
    return \Fintech\Promo\Facades\Promo::promotion()->create([
        'present_country_id' => 1,
        'permanent_country_id' => 1,
        'name' => Str::random(20),
        'type' => 'partner',
        'content' => Str::random(200),
        'link' => '',
        'promotion_data' => [
        ],
        'enabled' => '1',
    ]);
}
