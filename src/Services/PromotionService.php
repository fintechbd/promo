<?php

namespace Fintech\Promo\Services;

use Fintech\Promo\Interfaces\PromotionRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class PromotionService
 *
 * @property PromotionRepository $promotionRepository
 */
class PromotionService
{
    /**
     * PromotionService constructor.
     */
    public function __construct(private readonly PromotionRepository $promotionRepository)
    {
    }

    public function list(array $filters = []): Collection|Paginator
    {
        return $this->promotionRepository->list($filters);

    }

    public function create(array $inputs = []): Model|\MongoDB\Laravel\Eloquent\Model|null
    {
        return $this->promotionRepository->create($inputs);
    }

    public function find(int|string $id, bool $onlyTrashed = false): Model|\MongoDB\Laravel\Eloquent\Model|null
    {
        return $this->promotionRepository->find($id, $onlyTrashed);
    }

    public function update(int|string $id, array $inputs = []): Model|\MongoDB\Laravel\Eloquent\Model|null
    {
        return $this->promotionRepository->update($id, $inputs);
    }

    public function destroy(int|string $id): mixed
    {
        return $this->promotionRepository->delete($id);
    }

    public function restore(int|string $id): mixed
    {
        return $this->promotionRepository->restore($id);
    }

    public function export(array $filters): mixed
    {
        return $this->permissionRepository->list($filters);
    }

    public function import(array $filters): mixed
    {
        return $this->permissionRepository->create($filters);
    }
}
