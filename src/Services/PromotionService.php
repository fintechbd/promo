<?php

namespace Fintech\Promo\Services;

use Fintech\Promo\Interfaces\PromotionRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class PromotionService
 * @property PromotionRepository $promotionRepository
 */
class PromotionService
{
    /**
     * PromotionService constructor.
     */
    public function __construct(PromotionRepository $promotionRepository)
    {
        $this->promotionRepository = $promotionRepository;
    }

    /**
     * @param array $filters
     * @return Collection|Paginator
     */
    public function list(array $filters = []): Collection|Paginator
    {
        return $this->promotionRepository->list($filters);

    }

    /**
     * @param array $inputs
     * @return Model|\MongoDB\Laravel\Eloquent\Model|null
     */
    public function create(array $inputs = []): Model|\MongoDB\Laravel\Eloquent\Model|null
    {
        return $this->promotionRepository->create($inputs);
    }

    /**
     * @param int | string $id
     * @param bool $onlyTrashed
     * @return Model|\MongoDB\Laravel\Eloquent\Model|null
     */
    public function find(int | string $id, bool $onlyTrashed = false): Model|\MongoDB\Laravel\Eloquent\Model|null
    {
        return $this->promotionRepository->find($id, $onlyTrashed);
    }

    /**
     * @param int | string $id
     * @param array $inputs
     * @return Model|\MongoDB\Laravel\Eloquent\Model|null
     */
    public function update(int | string $id, array $inputs = []): Model|\MongoDB\Laravel\Eloquent\Model|null
    {
        return $this->promotionRepository->update($id, $inputs);
    }

    /**
     * @param int | string $id
     * @return mixed
     */
    public function destroy(int | string $id): mixed
    {
        return $this->promotionRepository->delete($id);
    }

    /**
     * @param int | string $id
     * @return mixed
     */
    public function restore(int | string $id): mixed
    {
        return $this->promotionRepository->restore($id);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function export(array $filters): mixed
    {
        return $this->permissionRepository->list($filters);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function import(array $filters): mixed
    {
        return $this->permissionRepository->create($filters);
    }
}
