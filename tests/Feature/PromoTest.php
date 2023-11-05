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
        'image_png' => 'data:image/jpeg;base64,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
',
        'promotion_data' => [
        ],
        'enabled' => '1',
    ]);
}

test('Promotion Event list', function () {
    createPromotionEvent();
    getJson('/api/promo/promotions')->assertStatus(200);
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
