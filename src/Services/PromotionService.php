<?php

namespace Fintech\Promo\Services;


use Fintech\Promo\Interfaces\PromotionRepository;

/**
 * Class PromotionService
 * @package Fintech\Promo\Services
 *
 */
class PromotionService
{
    /**
     * PromotionService constructor.
     * @param PromotionRepository $promotionRepository
     */
    public function __construct(PromotionRepository $promotionRepository) {
        $this->promotionRepository = $promotionRepository;
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->promotionRepository->list($filters);

    }

    public function create(array $inputs = [])
    {
        return $this->promotionRepository->create($inputs);
    }

    public function find($id, $onlyTrashed = false)
    {
        return $this->promotionRepository->find($id, $onlyTrashed);
    }

    public function update($id, array $inputs = [])
    {
        return $this->promotionRepository->update($id, $inputs);
    }

    public function destroy($id)
    {
        return $this->promotionRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->promotionRepository->restore($id);
    }

    public function export(array $filters)
    {
        return $this->permissionRepository->list($filters);
    }

    public function import(array $filters)
    {
        return $this->permissionRepository->create($filters);
    }
}
