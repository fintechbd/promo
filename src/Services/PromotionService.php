<?php

namespace Fintech\Promo\Services;

use Fintech\Core\Abstracts\BaseModel;
use Fintech\Promo\Interfaces\PromotionRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

/**
 * Class PromotionService
 *
 * @property PromotionRepository $promotionRepository
 */
class PromotionService
{
    use \Fintech\Core\Traits\HasFindWhereSearch;

    /**
     * PromotionService constructor.
     */
    public function __construct(private readonly PromotionRepository $promotionRepository) {}

    public function find(int|string $id, bool $onlyTrashed = false): ?BaseModel
    {
        return $this->promotionRepository->find($id, $onlyTrashed);
    }

    public function update(int|string $id, array $inputs = []): ?BaseModel
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
        return $this->promotionRepository->list($filters);
    }

    public function list(array $filters = []): Collection|Paginator
    {
        return $this->promotionRepository->list($filters);

    }

    public function import(array $filters): mixed
    {
        return $this->promotionRepository->create($filters);
    }

    public function create(array $inputs = []): ?BaseModel
    {
        return $this->promotionRepository->create($inputs);
    }
}
