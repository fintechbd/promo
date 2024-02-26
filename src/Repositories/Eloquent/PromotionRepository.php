<?php

namespace Fintech\Promo\Repositories\Eloquent;

use Fintech\Core\Repositories\EloquentRepository;
use Fintech\Promo\Interfaces\PromotionRepository as InterfacesPromotionRepository;
use Fintech\Promo\Models\Promotion;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use InvalidArgumentException;

/**
 * Class PromotionRepository
 */
class PromotionRepository extends EloquentRepository implements InterfacesPromotionRepository
{
    public function __construct()
    {
        $model = app(config('fintech.promo.promotion_model', Promotion::class));

        if (!$model instanceof Model) {
            throw new InvalidArgumentException("Eloquent repository require model class to be `Illuminate\Database\Eloquent\Model` instance.");
        }

        $this->model = $model;
    }

    /**
     * return a list or pagination of items from
     * filtered options
     */
    public function list(array $filters = []): Paginator|Collection
    {
        $query = $this->model->newQuery();

        //Searching
        if (!empty($filters['search'])) {
            if (is_numeric($filters['search'])) {
                $query->where($this->model->getKeyName(), 'like', "%{$filters['search']}%");
            } else {
                $query->where('name', 'like', "%{$filters['search']}%")
                    ->orWhere('content', 'like', "%{$filters['search']}%")
                    ->orWhere('type', 'like', "%{$filters['search']}%");
            }
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['present_country_id'])) {
            $query->where('present_country_id', $filters['present_country_id']);
        }

        if (!empty($filters['permanent_country_id'])) {
            $query->where('permanent_country_id', $filters['permanent_country_id']);
        }

        //Display Trashed
        if (isset($filters['trashed']) && $filters['trashed'] === true) {
            $query->onlyTrashed();
        }

        //Handle Sorting
        $query->orderBy($filters['sort'] ?? $this->model->getKeyName(), $filters['dir'] ?? 'asc');

        //Execute Output
        return $this->executeQuery($query, $filters);

    }
}
