<?php

use Illuminate\Database\Eloquent\Model as MYSQLDBLEBUPAY;
use Illuminate\Support\Str;
use MongoDB\Laravel\Eloquent\Model as MONGODB;

use function Pest\Laravel\getJson;

function createPromotionEvent(): MYSQLDBLEBUPAY|MONGODB|null
{
    return \Fintech\Promo\Facades\Promo::promotion()->create([
        'present_country_id' => 1,
        'permanent_country_id' => 1,
        'name' => fake()->jobTitle,
        'type' => 'event',
        'content' => fake()->paragraph,
        'link' => fake()->url,
        'promotion_data' => [
            'promotion_image' => fake()->imageUrl,
        ],
        'enabled' => '1',
    ]);
}

test('Promotion Event list', function () {
    createPromotionEvent();
    getJson('/api/promo/promotions', [
        'type' => 'event',
    ])->assertStatus(200);
});

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

function createPromotionAchievement(): MYSQLDBLEBUPAY|MONGODB|null
{
    return \Fintech\Promo\Facades\Promo::promotion()->create([
        'present_country_id' => 1,
        'permanent_country_id' => 1,
        'name' => Str::random(20),
        'type' => 'achievement',
        'content' => Str::random(200),
        'link' => '',
        'promotion_data' => [
        ],
        'enabled' => '1',
    ]);
}

function createPromotionMedia(): MYSQLDBLEBUPAY|MONGODB|null
{
    return \Fintech\Promo\Facades\Promo::promotion()->create([
        'present_country_id' => 1,
        'permanent_country_id' => 1,
        'name' => Str::random(20),
        'type' => 'media',
        'content' => Str::random(200),
        'link' => '',
        'promotion_data' => [
        ],
        'enabled' => '1',
    ]);
}

function createPromotionBanner(): MYSQLDBLEBUPAY|MONGODB|null
{
    return \Fintech\Promo\Facades\Promo::promotion()->create([
        'present_country_id' => 1,
        'permanent_country_id' => 1,
        'name' => Str::random(20),
        'type' => 'banner',
        'content' => Str::random(200),
        'link' => '',
        'promotion_data' => [
        ],
        'enabled' => '1',
    ]);
}
