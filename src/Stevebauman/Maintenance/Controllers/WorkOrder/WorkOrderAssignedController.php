<?php

namespace Stevebauman\Maintenance\Controllers;

use Stevebauman\Maintenance\Services\WorkOrderService;
use Stevebauman\Maintenance\Controllers\BaseController;

class WorkOrderAssignedController extends BaseController {
    
    public function __construct(WorkOrderService $workOrder)
    {
        $this->workOrder = $workOrder;
    }
    
    public function index()
    {
        $workOrders  = $this->workOrder->getUserAssignedWorkOrders();
         
        return $this->view('maintenance::work-orders.assigned.index', array(
            'title' => 'Assigned Work Orders',
            'workOrders' => $workOrders
        ));
    }
    
}