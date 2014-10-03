<?php namespace Stevebauman\Maintenance\Controllers;

use Stevebauman\Maintenance\Validators\AssignmentValidator;
use Stevebauman\Maintenance\Services\WorkOrderService;
use Stevebauman\Maintenance\Services\WorkOrderAssignmentService;
use Stevebauman\Maintenance\Controllers\AbstractController;

class WorkOrderAssignmentController extends AbstractController {
        
        public function __construct(WorkOrderAssignmentService $assignment, WorkOrderService $workOrder, AssignmentValidator $assignmentValidator){
            $this->assignment = $assignment;
            $this->workOrder = $workOrder;
            $this->assignmentValidator = $assignmentValidator;
        }
    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($workOrder_id){
            
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($workOrder_id){
            
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($workOrder_id){
            $validator = new $this->assignmentValidator;
            
            if($validator->passes()){
                    
                $workOrder = $this->workOrder->find($workOrder_id);
                
                $data = $this->inputAll();
                $data['work_order_id'] = $workOrder->id;
                
                if($records = $this->assignment->setInput($data)->create()){
                    $this->message = 'Successfully assigned worker(s)';
                    $this->messageType = 'success';
                    $this->redirect = route('maintenance.work-orders.show', array($workOrder->id));
                } else{
                    $this->message = 'There was an error trying to assign workers to this work order. Please try again.';
                    $this->messageType = 'danger';
                    $this->redirect = route('maintenance.work-orders.show', array($workOrder->id));
                }
                    
            } else{
                $this->errors = $validator->getErrors();
                $this->redirect = route('maintenance.work-orders.show', array($workOrder_id));
            }
            
            return $this->response();
	}
        

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($workOrder_id, $assignment_id)
	{
            if($this->assignment->destroy($assignment_id)){
                $this->message = 'Successfully removed worker from this work order.';
                $this->messageType = 'success';
                $this->redirect = route('maintenance.work-orders.show', array($workOrder_id));
            } else{
                $this->message = 'There was an error trying to remove this worker from this work order. Please try again later.';
                $this->messageType = 'danger';
                $this->redirect = route('maintenance.work-orders.show', array($workOrder_id));
            }
            
            return $this->response();
	}


}