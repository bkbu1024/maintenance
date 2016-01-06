<?php

namespace App\Jobs\WorkOrder\Session;

use App\Models\WorkOrderSession;
use App\Models\WorkOrder;
use App\Jobs\Job;

class Start extends Job
{
    /**
     * @var WorkOrder
     */
    protected $workOrder;

    /**
     * Constructor.
     *
     * @param WorkOrder $workOrder
     */
    public function __construct(WorkOrder $workOrder)
    {
        $this->workOrder = $workOrder;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $session = new WorkOrderSession();

        $session->user_id = auth()->id();
        $session->work_order_id = $this->workOrder->id;
        $session->in = $session->freshTimestamp();

        if ($this->workOrder->sessions->count() === 0) {
            $this->workOrder->update(['started_at' => $this->workOrder->freshTimestamp()]);
        }

        return $session->save();
    }
}
