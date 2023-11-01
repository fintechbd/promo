<?php

namespace Fintech\Promo\Interfaces;

use InvalidArgumentException;

/**
 * Interface PromotionRepository
 */
interface PromotionRepository
{
    /**
     * return a list or pagination of items from
     * filtered options
     */
    public function list(array $filters = []);

    /**
     * Create a new entry resource
     */
    public function create(array $attributes = []);

    /**
     * find and update a resource attributes
     */
    public function update(int|string $id, array $attributes = []);

    /**
     * find and delete an entry from records
     */
    public function find(int|string $id, bool $onlyTrashed = false);

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
