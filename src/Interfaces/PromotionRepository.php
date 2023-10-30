<?php

namespace Fintech\Promo\Interfaces;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use MongoDB\Laravel\Eloquent\Model as MongodbModel;

/**
 * Interface PromotionRepository
 */
interface PromotionRepository
{
    /**
     * return a list or pagination of items from
     * filtered options
     */
    public function list(array $filters = []): Paginator|Collection;

    /**
     * Create a new entry resource
     */
    public function create(array $attributes = []): EloquentModel|MongodbModel|null;

    /**
     * find and update a resource attributes
     */
    public function update(int|string $id, array $attributes = []): EloquentModel|MongodbModel|null;

    /**
     * find and delete an entry from records
     */
    public function find(int|string $id, bool $onlyTrashed = false): EloquentModel|MongodbModel|null;

    /**
     * find and delete an entry from records
     */
    public function delete(int|string $id);

    /**
     * find and restore an entry from records
     *
     * @throws InvalidArgumentException
     */
    public function restore(int|string $id);
}
