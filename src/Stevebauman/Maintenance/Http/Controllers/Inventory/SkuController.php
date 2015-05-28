<?php

namespace Stevebauman\Maintenance\Http\Controllers\Inventory;

use Stevebauman\Maintenance\Services\Inventory\InventoryService;
use Stevebauman\Maintenance\Http\Controllers\Controller;

/**
 * Class SkuController.
 */
class SkuController extends Controller
{
    /**
     * @var InventoryService
     */
    protected $inventory;

    /**
     * @param InventoryService $inventory
     */
    public function __construct(InventoryService $inventory)
    {
        $this->inventory = $inventory;
    }

    /**
     * Regenerates the SKU for the specified item.
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function regenerate($id)
    {
        $item = $this->inventory->find($id);

        if ($item->regenerateSku()) {
            $this->message = 'Successfully regenerated SKU for this item.';
            $this->messageType = 'success';
            $this->redirect = route('maintenance.inventory.show', [$item->id]);
        } else {
            $this->message = 'There was an issue regenerating an SKU. Please try again.';
            $this->messageType = 'danger';
            $this->redirect = route('maintenance.inventory.show', [$item->id]);
        }

        return $this->response();
    }
}