<?php

namespace App\Http\Apis\v1\WorkOrder;

use App\Http\Apis\v1\Controller as BaseController;
use App\Models\Status;
use App\Repositories\WorkOrder\StatusRepository;

class StatusController extends BaseController
{
    /**
     * @var StatusRepository
     */
    protected $status;

    /**
     * @param StatusRepository $status
     */
    public function __construct(StatusRepository $status)
    {
        $this->status = $status;
    }

    /**
     * Returns a new work order status grid.
     *
     * @return \Cartalyst\DataGrid\DataGrid
     */
    public function grid()
    {
        $columns = [
            'id',
            'created_at',
            'user_id',
            'name',
            'color',
        ];

        $settings = [
            'sort'      => 'created_at',
            'direction' => 'desc',
            'threshold' => 10,
            'throttle'  => 11,
        ];

        $transformer = function (Status $status) {
            return [
                'id'         => $status->id,
                'created_at' => $status->created_at,
                'created_by' => ($status->user ? $status->user->full_name : '<em>System</em>'),
                'name'       => $status->name,
                'color'      => $status->color,
                'view_url'   => route('maintenance.work-orders.statuses.edit', [$status->id]),
            ];
        };

        return $this->status->grid($columns, $settings, $transformer);
    }
}