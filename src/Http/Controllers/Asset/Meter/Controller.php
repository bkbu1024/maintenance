<?php

namespace Stevebauman\Maintenance\Http\Controllers\Asset\Meter;

use Stevebauman\Maintenance\Http\Controllers\Controller as BaseController;
use Stevebauman\Maintenance\Http\Requests\Asset\MeterRequest;
use Stevebauman\Maintenance\Repositories\Asset\MeterRepository;
use Stevebauman\Maintenance\Repositories\Asset\Repository as AssetRepository;

class Controller extends BaseController
{
    /**
     * @var AssetRepository
     */
    protected $asset;

    /**
     * @var MeterRepository
     */
    protected $meter;

    /**
     * Constructor.
     *
     * @param AssetRepository $asset
     * @param MeterRepository $meter
     */
    public function __construct(AssetRepository $asset, MeterRepository $meter)
    {
        $this->asset = $asset;
        $this->meter = $meter;
    }

    /**
     * Displays all meters for the specified asset.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        $asset = $this->asset->model()->findOrFail($id);

        return view('maintenance::assets.meters.index', compact('asset'));
    }

    /**
     * Displays the form for creating a new meter for the specified asset.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        $asset = $this->asset->model()->findOrFail($id);

        return view('maintenance::assets.meters.create', compact('asset'));
    }

    /**
     * Creates a new meter for the specified asset.
     *
     * @param MeterRequest $request
     * @param int|string   $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MeterRequest $request, $id)
    {
        $meter = $this->meter->create($request, $id);

        if ($meter) {
            $message = 'Successfully created meter.';

            return redirect()->route('maintenance.assets.meters.index', [$id])->withSuccess($message);
        } else {
            $message = 'There was an issue creating a meter. Please try again.';

            return redirect()->route('maintenance.assets.meters.create', [$id])->withErrors($message);
        }
    }

    /**
     * Displays the specified meter for the specified asset.
     *
     * @param int|string $id
     * @param int|string $meterId
     *
     * @return \Illuminate\View\View
     */
    public function show($id, $meterId)
    {
        $asset = $this->asset->model()->findOrFail($id);

        $meter = $asset->meters()->findOrFail($meterId);

        return view('maintenance::assets.meters.show', compact('asset', 'meter'));
    }

    /**
     * Displays the form for editing the
     * specified meter for the specified asset.
     *
     * @param int|string $id
     * @param int|string $meterId
     *
     * @return \Illuminate\View\View
     */
    public function edit($id, $meterId)
    {
        $asset = $this->asset->model()->findOrFail($id);

        $meter = $asset->meters()->findOrFail($meterId);

        $lastReading = $meter->getLastReading();

        return view('maintenance::assets.meters.edit', compact('asset', 'meter', 'lastReading'));
    }

    /**
     * Updates the specified meter attached to the specified asset.
     *
     * @param MeterRequest $request
     * @param int|string   $id
     * @param int|string   $meterId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MeterRequest $request, $id, $meterId)
    {
        $meter = $this->meter->update($request, $id, $meterId);

        if ($meter) {
            $message = 'Successfully updated meter.';

            return redirect()->route('maintenance.assets.meters.show', [$id, $meter->id])->withSuccess($message);
        } else {
            $message = 'There was an issue updating this meter. Please try again.';

            return redirect()->route('maintenance.assets.meters.edit', [$id, $meterId])->withErrors($message);
        }
    }

    /**
     * Deletes the specified meter for the specified asset.
     *
     * @param int|string $id
     * @param int|string $meterId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, $meterId)
    {
        $asset = $this->asset->model()->findOrFail($id);

        $meter = $asset->meters()->findOrFail($meterId);

        if ($meter->delete()) {
            $message = 'Successfully deleted meter.';

            return redirect()->route('maintenance.assets.meters.index', [$id])->withSuccess($message);
        } else {
            $message = 'There was an issue deleting this meter. Please try again.';

            return redirect()->route('maintenance.assets.meters.show', [$id, $meterId])->withErrors($message);
        }
    }
}