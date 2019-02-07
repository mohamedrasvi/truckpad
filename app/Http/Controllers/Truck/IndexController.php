<?php

namespace App\Http\Controllers\Truck;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Truck\Repositories\TruckRepository;
use App\Http\Controllers\Truck\Requests\TruckRequest;
use App\Http\Controllers\Truck\Requests\TruckFilterRequest;


class IndexController extends Controller
{
    /**
     * The TruckRepository repository instance.
     *
     * @var TruckRepository
     */

    protected $truckRepository;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TruckRepository $truckRepository)
    {
        $this->truckRepository = $truckRepository;
    }


    /**
     * Display a list of all truckers.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->truckRepository->getAll();
    }

    /**
     * Register trucker.
     * @param TruckRequest $request
     * @return \Illuminate\Http\Response
     */
    public function registerTrucker(TruckRequest $request)
    {
        return $this->truckRepository->registerTrucker($request);
    }

    /**
     * Get all unloaded truckers.
     * @return \Illuminate\Http\Response
     */
    public function truckNotLoaded()
    {
        return $this->truckRepository->truckNotLoaded();
    }

    /**
     * Filter truckers.
     * @param TruckFilterRequest $requestFilter
     * @return \Illuminate\Http\Response
     */
    public function filter(TruckFilterRequest $requestFilter)
    {
        return $this->truckRepository->filter($requestFilter);
    }



    //
}
