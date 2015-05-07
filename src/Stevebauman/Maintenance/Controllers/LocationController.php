<?php

namespace Stevebauman\Maintenance\Controllers;

use Stevebauman\Maintenance\Services\LocationService;
use Stevebauman\Maintenance\Validators\LocationValidator;

class LocationController extends BaseNestedSetController
{
    /**
     * Constructor.
     *
     * @param LocationService   $location
     * @param LocationValidator $locationValidator
     */
    public function __construct(LocationService $location, LocationValidator $locationValidator)
    {
        $this->service = $location;
        $this->serviceValidator = $locationValidator;

        $this->resource = 'Location';
    }
}
