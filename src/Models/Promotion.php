<?php

namespace Fintech\Promo\Models;

use Fintech\Core\Traits\AuditableTrait;
use Fintech\Promo\Traits\PromotionMetaDataRelationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Promotion extends Model implements HasMedia
{
    use AuditableTrait;
    use InteractsWithMedia;
    use PromotionMetaDataRelationTrait;
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $appends = ['links'];

    protected $casts = ['promotion_data' => 'array', 'restored_at' => 'datetime', 'enabled' => 'bool'];

    protected $hidden = ['creator_id', 'editor_id', 'destroyer_id', 'restorer_id'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')
            ->singleFile()
            ->useDisk(config('filesystems.default', 'public'));
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getLinksAttribute(): array
    {
        $primaryKey = $this->getKey();

        $links = [
            'show' => action_link(route('promo.promotions.show', $primaryKey), __('core::messages.action.show'), 'get'),
            'update' => action_link(route('promo.promotions.update', $primaryKey), __('core::messages.action.update'), 'put'),
            'destroy' => action_link(route('promo.promotions.destroy', $primaryKey), __('core::messages.action.destroy'), 'delete'),
            'restore' => action_link(route('promo.promotions.restore', $primaryKey), __('core::messages.action.restore'), 'post'),
        ];

        if ($this->getAttribute('deleted_at') == null) {
            unset($links['restore']);
        } else {
            unset($links['destroy']);
        }

        return $links;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
