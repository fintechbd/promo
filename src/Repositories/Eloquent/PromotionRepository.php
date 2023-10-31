<?php

namespace Fintech\Promo\Repositories\Eloquent;

use Fintech\Core\Repositories\EloquentRepository;
use Fintech\Promo\Interfaces\PromotionRepository as InterfacesPromotionRepository;
use Fintech\Promo\Models\Promotion;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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
     *
     * @return Paginator|Collection
     */
    public function list(array $filters = []): Paginator|Collection
    {
        $query = $this->model->newQuery();

        //Searching
        if (isset($filters['search']) && !empty($filters['search'])) {
            if (is_numeric($filters['search'])) {
                $query->where($this->model->getKeyName(), 'like', "%{$filters['search']}%");
            } else {
                $query->where('name', 'like', "%{$filters['search']}%")
                    ->orWhere('content', 'like', "%{$filters['search']}%")
                    ->orWhere('type', 'like', "%{$filters['search']}%");
            }
        }

        if (isset($filters['type']) && !empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (isset($filters['present_country_id']) && !empty($filters['present_country_id'])) {
            $query->where('present_country_id', $filters['present_country_id']);
        }

        if (isset($filters['permanent_country_id']) && !empty($filters['permanent_country_id'])) {
            $query->where('permanent_country_id', $filters['permanent_country_id']);
        }

        //Display Trashed
        if (isset($filters['trashed']) && !empty($filters['trashed'])) {
            $query->onlyTrashed();
        }

        //Handle Sorting
        $query->orderBy($filters['sort'] ?? $this->model->getKeyName(), $filters['dir'] ?? 'asc');

        //Execute Output
        return $this->executeQuery($query, $filters);

    }
}
