<?php

namespace Fintech\Promo\Repositories\Mongodb;

use Fintech\Core\Repositories\MongodbRepository;
use Fintech\Promo\Interfaces\PromotionRepository as InterfacesPromotionRepository;
use Fintech\Promo\Models\Promotion;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use InvalidArgumentException;
use MongoDB\Laravel\Eloquent\Model;

/**
 * Class PromotionRepository
 */
class PromotionRepository extends MongodbRepository implements InterfacesPromotionRepository
{
    public function __construct()
    {
        $model = app(config('fintech.promo.promotion_model', Promotion::class));

        if (! $model instanceof Model) {
            throw new InvalidArgumentException("Mongodb repository require model class to be `MongoDB\Laravel\Eloquent\Model` instance.");
        }

        $this->model = $model;
    }

    /**
     * return a list or pagination of items from
     * filtered options
     *
     * @return Paginator|Collection
     */
    public function list(array $filters = [])
    {
        $query = $this->model->newQuery();

        //Searching
        if (isset($filters['search']) && ! empty($filters['search'])) {
            if (is_numeric($filters['search'])) {
                $query->where($this->model->getKeyName(), 'like', "%{$filters['search']}%");
            } else {
                $query->where('promotion_title', 'like', "%{$filters['search']}%");
            }
        }

        if (isset($filters['promotion_type']) && ! empty($filters['promotion_type'])) {
            $query->where('promotion_type', $filters['promotion_type']);
        }

        //Display Trashed
        if (isset($filters['trashed']) && ! empty($filters['trashed'])) {
            $query->onlyTrashed();
        }

        //Handle Sorting
        $query->orderBy($filters['sort'] ?? $this->model->getKeyName(), $filters['dir'] ?? 'asc');

        //Execute Output
        return $this->executeQuery($query, $filters);

    }
}
