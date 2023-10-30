<?php

namespace Fintech\Promo\Http\Controllers;
use Exception;
use Fintech\Core\Exceptions\StoreOperationException;
use Fintech\Core\Exceptions\UpdateOperationException;
use Fintech\Core\Exceptions\DeleteOperationException;
use Fintech\Core\Exceptions\RestoreOperationException;
use Fintech\Core\Traits\ApiResponseTrait;
use Fintech\Promo\Facades\Promo;
use Fintech\Promo\Http\Resources\PromotionResource;
use Fintech\Promo\Http\Resources\PromotionCollection;
use Fintech\Promo\Http\Requests\ImportPromotionRequest;
use Fintech\Promo\Http\Requests\StorePromotionRequest;
use Fintech\Promo\Http\Requests\UpdatePromotionRequest;
use Fintech\Promo\Http\Requests\IndexPromotionRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Class PromotionController
 * @package Fintech\Promo\Http\Controllers
 *
 * @lrd:start
 * This class handle create, display, update, delete & restore
 * operation related to Promotion
 * @lrd:end
 *
 */

class PromotionController extends Controller
{
    use ApiResponseTrait;

    /**
     * @lrd:start
     * Return a listing of the *Promotion* resource as collection.
     *
     * *```paginate=false``` returns all resource as list not pagination*
     * @lrd:end
     *
     * @param IndexPromotionRequest $request
     * @return PromotionCollection|JsonResponse
     */
    public function index(IndexPromotionRequest $request): PromotionCollection|JsonResponse
    {
        try {
            $inputs = $request->validated();

            $promotionPaginate = Promo::promotion()->list($inputs);

            return new PromotionCollection($promotionPaginate);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a new *Promotion* resource in storage.
     * @lrd:end
     *
     * @param StorePromotionRequest $request
     * @return JsonResponse
     * @throws StoreOperationException
     */
    public function store(StorePromotionRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $promotion = Promo::promotion()->create($inputs);

            if (!$promotion) {
                throw (new StoreOperationException)->setModel(config('fintech.promo.promotion_model'));
            }

            return $this->created([
                'message' => __('core::messages.resource.created', ['model' => 'Promotion']),
                'id' => $promotion->id
             ]);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Return a specified *Promotion* resource found by id.
     * @lrd:end
     *
     * @param string|int $id
     * @return PromotionResource|JsonResponse
     * @throws ModelNotFoundException
     */
    public function show(string|int $id): PromotionResource|JsonResponse
    {
        try {

            $promotion = Promo::promotion()->find($id);

            if (!$promotion) {
                throw (new ModelNotFoundException)->setModel(config('fintech.promo.promotion_model'), $id);
            }

            return new PromotionResource($promotion);

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Update a specified *Promotion* resource using id.
     * @lrd:end
     *
     * @param UpdatePromotionRequest $request
     * @param string|int $id
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function update(UpdatePromotionRequest $request, string|int $id): JsonResponse
    {
        try {

            $promotion = Promo::promotion()->find($id);

            if (!$promotion) {
                throw (new ModelNotFoundException)->setModel(config('fintech.promo.promotion_model'), $id);
            }

            $inputs = $request->validated();

            if (!Promo::promotion()->update($id, $inputs)) {

                throw (new UpdateOperationException)->setModel(config('fintech.promo.promotion_model'), $id);
            }

            return $this->updated(__('core::messages.resource.updated', ['model' => 'Promotion']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Soft delete a specified *Promotion* resource using id.
     * @lrd:end
     *
     * @param string|int $id
     * @return JsonResponse
     */
    public function destroy(string|int $id): JsonResponse
    {
        try {

            $promotion = Promo::promotion()->find($id);

            if (!$promotion) {
                throw (new ModelNotFoundException)->setModel(config('fintech.promo.promotion_model'), $id);
            }

            if (!Promo::promotion()->destroy($id)) {

                throw (new DeleteOperationException())->setModel(config('fintech.promo.promotion_model'), $id);
            }

            return $this->deleted(__('core::messages.resource.deleted', ['model' => 'Promotion']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Restore the specified *Promotion* resource from trash.
     * ** ```Soft Delete``` needs to enabled to use this feature**
     * @lrd:end
     *
     * @param string|int $id
     * @return JsonResponse
     */
    public function restore(string|int $id): JsonResponse
    {
        try {

            $promotion = Promo::promotion()->find($id, true);

            if (!$promotion) {
                throw (new ModelNotFoundException)->setModel(config('fintech.promo.promotion_model'), $id);
            }

            if (!Promo::promotion()->restore($id)) {

                throw (new RestoreOperationException())->setModel(config('fintech.promo.promotion_model'), $id);
            }

            return $this->restored(__('core::messages.resource.restored', ['model' => 'Promotion']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create an exportable list of the *Promotion* resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @param IndexPromotionRequest $request
     * @return JsonResponse
     */
    public function export(IndexPromotionRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $promotionPaginate = Promo::promotion()->export($inputs);

            return $this->exported(__('core::messages.resource.exported', ['model' => 'Promotion']));

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create an exportable list of the *Promotion* resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @param ImportPromotionRequest $request
     * @return PromotionCollection|JsonResponse
     */
    public function import(ImportPromotionRequest $request): PromotionCollection|JsonResponse
    {
        try {
            $inputs = $request->validated();

            $promotionPaginate = Promo::promotion()->list($inputs);

            return new PromotionCollection($promotionPaginate);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }
}
