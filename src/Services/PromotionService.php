<?php

namespace Fintech\Promo\Services;

use Fintech\Promo\Interfaces\PromotionRepository;
use Illuminate\Database\Eloquent\Model;

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
     * @return mixed
     */
    public function list(array $filters = []): mixed
    {
        return $this->promotionRepository->list($filters);

    }

    /**
     * @param array $inputs
     * @return Model|\MongoDB\Laravel\Eloquent\Model|null
     */
    public function create(array $inputs = []): \Illuminate\Database\Eloquent\Model|\MongoDB\Laravel\Eloquent\Model|null
    {
        return $this->promotionRepository->create($inputs);
    }

    /**
     * @param $id
     * @param $onlyTrashed
     * @return Model|\MongoDB\Laravel\Eloquent\Model|null
     */
    public function find($id, $onlyTrashed = false): Model|\MongoDB\Laravel\Eloquent\Model|null
    {
        return $this->promotionRepository->find($id, $onlyTrashed);
    }

    /**
     * @param $id
     * @param array $inputs
     * @return Model|\MongoDB\Laravel\Eloquent\Model|null
     */
    public function update($id, array $inputs = []): Model|\MongoDB\Laravel\Eloquent\Model|null
    {
        return $this->promotionRepository->update($id, $inputs);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id): mixed
    {
        return $this->promotionRepository->delete($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function restore($id): mixed
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
