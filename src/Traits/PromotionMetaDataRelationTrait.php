<?php

namespace Fintech\Promo\Traits;

use Fintech\Core\Facades\Core;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

if(Core::packageExists('MetaData')) {
    trait PromotionMetaDataRelationTrait
    {
        public function presentCountry(): BelongsTo
        {
            return $this->belongsTo(config('fintech.metadata.country_model'), 'present_country_id');
        }

        public function permanentCountry(): BelongsTo
        {
            return $this->belongsTo(config('fintech.metadata.country_model'), 'permanent_country_id');
        }

    }
} else {
    trait PromotionMetaDataRelationTrait {

    }
}
