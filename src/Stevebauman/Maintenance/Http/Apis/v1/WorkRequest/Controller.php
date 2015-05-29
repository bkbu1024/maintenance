<?php

namespace Stevebauman\Maintenance\Http\Apis\v1\WorkRequest;

use Stevebauman\Maintenance\Repositories\WorkRequest\Repository;
use Stevebauman\Maintenance\Http\Apis\v1\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @var Repository
     */
    protected $workRequest;

    /**
     * Constructor.
     *
     * @param Repository $workRequest
     */
    public function __construct(Repository $workRequest)
    {
        $this->workRequest = $workRequest;
    }

    /**
     * Returns a new work request grid.
     *
     * @return \Cartalyst\DataGrid\DataGrid
     */
    public function grid()
    {
        $columns = [
            'id',
            'subject',
            'best_time',
            'created_at',
        ];

        $settings = [
            'sort'      => 'created_at',
            'direction' => 'desc',
        ];

        $transformer = function($element)
        {
            return [
                'id' => $element->id,
                'subject' => $element->subject,
                'best_time' => $element->best_time,
                'created_at' => $element->created_at,
                'view_url' => route('maintenance.work-requests.show', [$element->id]),
            ];
        };

        return $this->workRequest->grid($columns, $settings, $transformer);
    }
}
